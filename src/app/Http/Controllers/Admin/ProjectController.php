<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    // Middleware aplicado nas rotas

    public function index()
    {
        $projects = Project::with('images')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $technologies = Technology::active()->orderBy('category')->orderBy('name')->get();
        return view('admin.projects.create', compact('technologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'tech_stack' => 'required|array|min:1',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->boolean('featured');
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order'] ?? Project::max('sort_order') + 1;
        $validated['views'] = 0;

        $project = Project::create($validated);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $filename = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('projects', $filename, 'public');
                
                ProjectImage::create([
                    'project_id' => $project->id,
                    'filename' => $filename,
                    'original_name' => $image->getClientOriginalName(),
                    'path' => $path,
                    'size' => $image->getSize(),
                    'mime_type' => $image->getMimeType(),
                    'type' => $index === 0 ? 'thumbnail' : 'gallery',
                    'alt_text' => $project->title . ' - Imagem ' . ($index + 1),
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Projeto criado com sucesso!');
    }

    public function show(Project $project)
    {
        $project->load('images');
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $technologies = Technology::active()->orderBy('category')->orderBy('name')->get();
        return view('admin.projects.edit', compact('project', 'technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'tech_stack' => 'required|array|min:1',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'remove_images' => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured'] = $request->boolean('featured');
        $validated['is_active'] = $request->boolean('is_active');

        $project->update($validated);

        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = ProjectImage::find($imageId);
                if ($image && $image->project_id === $project->id) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentImageCount = $project->images()->count();
            foreach ($request->file('images') as $index => $image) {
                if ($currentImageCount + $index >= 5) break; // Limit to 5 images
                
                $filename = time() . '_' . ($currentImageCount + $index) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('projects', $filename, 'public');
                
                ProjectImage::create([
                    'project_id' => $project->id,
                    'filename' => $filename,
                    'original_name' => $image->getClientOriginalName(),
                    'path' => $path,
                    'size' => $image->getSize(),
                    'mime_type' => $image->getMimeType(),
                    'type' => $currentImageCount === 0 && $index === 0 ? 'thumbnail' : 'gallery',
                    'alt_text' => $project->title . ' - Imagem ' . ($currentImageCount + $index + 1),
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Projeto atualizado com sucesso!');
    }

    public function destroy(Project $project)
    {
        // Delete associated images
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Projeto excluído com sucesso!');
    }
}
