<?php

namespace App\Http\Controllers;

use App\Models\BlogAuthor;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogAuthorController extends AdminBaseController
{
    use LogsActivity;

    public function index(Request $request)
    {
        $query = BlogAuthor::query()->withCount('posts')->orderBy('name');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('designation', 'like', "%{$search}%");
            });
        }

        $authors = $query->paginate(20)->withQueryString();

        return $this->viewWithRoute('admin.blog-authors.index', compact('authors'));
    }

    public function create()
    {
        return $this->viewWithRoute('admin.blog-authors.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['photo'] = $this->storePhoto($request);
        $data['is_active'] = $request->boolean('is_active');

        $author = BlogAuthor::create($data);
        $this->logCreate($author);

        return redirect()->route('blog-authors.index')
            ->with('success', 'Blog author created successfully.');
    }

    public function show(BlogAuthor $blogAuthor)
    {
        $blogAuthor->loadCount('posts');

        return $this->viewWithRoute('admin.blog-authors.show', compact('blogAuthor'));
    }

    public function edit(BlogAuthor $blogAuthor)
    {
        return $this->viewWithRoute('admin.blog-authors.edit', compact('blogAuthor'));
    }

    public function update(Request $request, BlogAuthor $blogAuthor)
    {
        $data = $this->validated($request, $blogAuthor);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $this->deletePhoto($blogAuthor->photo);
            $data['photo'] = $this->storePhoto($request);
        }

        $oldAttributes = $this->getOldAttributes($blogAuthor);
        $blogAuthor->update($data);
        $this->logUpdate($blogAuthor, $oldAttributes);

        return redirect()->route('blog-authors.index')
            ->with('success', 'Blog author updated successfully.');
    }

    public function destroy(BlogAuthor $blogAuthor)
    {
        $this->logDelete($blogAuthor);
        $this->deletePhoto($blogAuthor->photo);
        $blogAuthor->delete();

        return redirect()->route('blog-authors.index')
            ->with('success', 'Blog author deleted successfully.');
    }

    public function toggle(BlogAuthor $blogAuthor)
    {
        $oldAttributes = $this->getOldAttributes($blogAuthor);
        $blogAuthor->update(['is_active' => !$blogAuthor->is_active]);
        $this->logUpdate($blogAuthor, $oldAttributes);

        return redirect()->back()
            ->with('success', 'Blog author status updated.');
    }

    private function validated(Request $request, ?BlogAuthor $author = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:120',
            'designation' => 'required|string|max:160',
            'bio' => 'required|string|max:2000',
            'photo' => [$author ? 'nullable' : 'required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_active' => 'nullable|boolean',
        ]);
    }

    private function storePhoto(Request $request): ?string
    {
        if (!$request->hasFile('photo')) {
            return null;
        }

        $image = $request->file('photo');
        $filename = time() . '_' . Str::slug($request->input('name', 'author')) . '.' . $image->getClientOriginalExtension();

        return $image->storeAs('blog-authors', $filename, 'public');
    }

    private function deletePhoto(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
