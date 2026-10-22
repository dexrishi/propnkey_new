<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Support\AdminPermissions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Traits\LogsActivity;

class UserController extends AdminBaseController
{
    use LogsActivity;

    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        $query = User::with('permissions')->orderBy('name', 'asc');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(20);
        return $this->viewWithRoute('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $permissionCatalog = AdminPermissions::catalog();
        $defaultPermissions = AdminPermissions::defaultsForRole('admin');

        return $this->viewWithRoute('admin.users.create', compact('permissionCatalog', 'defaultPermissions'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['super_admin', 'admin', 'seo'])],
            'permissions' => 'nullable|array',
            'permissions.*' => ['string', Rule::in(AdminPermissions::assignableKeys())],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role !== 'super_admin') {
            $permissions = $request->input('permissions', []);
            if (empty($permissions)) {
                $permissions = AdminPermissions::defaultsForRole($request->role);
            }
            $user->syncPermissions($permissions);
        }

        $this->logCreate($user);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load('permissions');
        $permissionCatalog = AdminPermissions::catalog();

        return $this->viewWithRoute('admin.users.show', compact('user', 'permissionCatalog'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $user->load('permissions');
        $permissionCatalog = AdminPermissions::catalog();
        $userPermissions = $user->isSuperAdmin()
            ? AdminPermissions::assignableKeys()
            : $user->permissionKeys();

        return $this->viewWithRoute('admin.users.edit', compact('user', 'permissionCatalog', 'userPermissions'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in(['super_admin', 'admin', 'seo'])],
            'permissions' => 'nullable|array',
            'permissions.*' => ['string', Rule::in(AdminPermissions::assignableKeys())],
        ]);

        $oldAttributes = $this->getOldAttributes($user);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        if ($request->role === 'super_admin') {
            $user->permissions()->delete();
        } else {
            $permissions = $request->input('permissions', []);
            $user->syncPermissions($permissions);
        }

        $this->logUpdate($user, $oldAttributes);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $this->logDelete($user);

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
