<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteConfig;
use App\Helpers\ConfigHelper;
use App\Traits\LogsActivity;

class ConfigController extends AdminBaseController
{
    use LogsActivity;
    /**
     * Display a listing of configurations
     */
    public function index(Request $request)
    {
        $query = SiteConfig::query();
        
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('label', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }
        
        $configs = $query->orderBy('label')->paginate(20);
        
        // Preserve search parameter in pagination links
        $configs->appends($request->query());
        
        return $this->viewWithRoute('admin.configs.index', compact('configs'));
    }

    /**
     * Show the form for creating a new configuration
     */
    public function create()
    {
        return $this->viewWithRoute('admin.configs.create');
    }

    /**
     * Store a newly created configuration
     */
    public function store(Request $request)
    {
        $validationRules = [
            'label' => 'nullable|string|max:255|unique:site_configs,label',
            'type' => 'nullable|string|in:text,textarea,file',
            'description' => 'nullable|string',
        ];

        // Add file validation if type is file
        if ($request->type === 'file') {
            $validationRules['content'] = 'required|file|mimes:jpg,jpeg,png,gif,webp,avif,pdf,doc,docx,txt,mp4|max:10240'; // 10MB = 10240KB
        } else {
            $validationRules['content'] = 'nullable';
        }

        $request->validate($validationRules, [
            'content.required' => 'Please select a file to upload.',
            'content.file' => 'The uploaded file is not valid.',
            'content.mimes' => 'The file must be of type: jpg, jpeg, png, gif, webp, avif, pdf, doc, docx, txt, mp4.',
            'content.max' => 'The file size must not exceed 10MB.',
        ]);

        $data = $request->only(['label', 'type', 'description']);
        
        // Handle file upload
        if ($request->type === 'file' && $request->hasFile('content')) {
            $file = $request->file('content');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('configs', $filename, 'public');
            $data['content'] = $path;
        } else {
            $data['content'] = $request->content;
        }

        $config = SiteConfig::create($data);
        
        // Log the activity
        $this->logCreate($config);

        return redirect()->route('configs.index')
            ->with('success', 'Configuration created successfully.');
    }

    /**
     * Display the specified configuration
     */
    public function show(SiteConfig $config)
    {
        return $this->viewWithRoute('admin.configs.show', compact('config'));
    }

    /**
     * Show the form for editing the specified configuration
     */
    public function edit(SiteConfig $config)
    {
        return $this->viewWithRoute('admin.configs.edit', compact('config'));
    }

    /**
     * Update the specified configuration
     */
    public function update(Request $request, SiteConfig $config)
    {
        $validationRules = [
            'label' => 'nullable|string|max:255|unique:site_configs,label,' . $config->id,
            'type' => 'nullable|string|in:text,textarea,file',
            'description' => 'nullable|string',
        ];

        // Add file validation if type is file
        if ($request->type === 'file') {
            $validationRules['content'] = 'nullable|file|mimes:jpg,jpeg,png,gif,webp,avif,pdf,doc,docx,txt,mp4|max:10240'; // 10MB = 10240KB
        } else {
            $validationRules['content'] = 'nullable';
        }

        $request->validate($validationRules, [
            'content.required' => 'Please select a file to upload.',
            'content.file' => 'The uploaded file is not valid.',
            'content.mimes' => 'The file must be of type: jpg, jpeg, png, gif, webp, avif, pdf, doc, docx, txt, mp4.',
            'content.max' => 'The file size must not exceed 10MB.',
        ]);

        $data = $request->only(['label', 'type', 'description']);
        
        // Handle file upload
        if ($request->type === 'file' && $request->hasFile('content')) {
            // Delete old file if exists
            if ($config->content && \Storage::disk('public')->exists($config->content)) {
                \Storage::disk('public')->delete($config->content);
            }
            
            $file = $request->file('content');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('configs', $filename, 'public');
            $data['content'] = $path;
        } else {
            $data['content'] = $request->content;
        }

        // Get old attributes before update
        $oldAttributes = $this->getOldAttributes($config);
        
        $config->update($data);
        
        // Log the activity
        $this->logUpdate($config, $oldAttributes);

        // Clear cache for this config
        ConfigHelper::clearCache();

        return redirect()->route('configs.index')
            ->with('success', 'Configuration updated successfully.');
    }

    /**
     * Remove the specified configuration
     */
    public function destroy(SiteConfig $config)
    {
        // Delete associated file if exists
        if ($config->type === 'file' && $config->content && \Storage::disk('public')->exists($config->content)) {
            \Storage::disk('public')->delete($config->content);
        }
        
        // Log the activity before deletion
        $this->logDelete($config);
        
        $config->delete();

        // Clear cache
        ConfigHelper::clearCache();

        return redirect()->route('configs.index')
            ->with('success', 'Configuration deleted successfully.');
    }

    /**
     * Clear all configuration cache
     */
    public function clearCache()
    {
        ConfigHelper::clearCache();
        
        return redirect()->back()
            ->with('success', 'Configuration cache cleared successfully.');
    }

    /**
     * Bulk update configurations
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'configs' => 'required|array',
            'configs.*.id' => 'required|exists:site_configs,id',
            'configs.*.content' => 'nullable|string',
        ]);

        foreach ($request->configs as $configData) {
            $config = SiteConfig::find($configData['id']);
            if ($config) {
                $config->update(['content' => $configData['content']]);
            }
        }

        // Clear cache
        ConfigHelper::clearCache();

        return response()->json([
            'success' => true,
            'message' => 'Configurations updated successfully.'
        ]);
    }
}