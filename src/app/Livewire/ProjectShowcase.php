<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Technology;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectShowcase extends Component
{
    use WithPagination;

    public $showAll = false;
    public $selectedCategory = 'all';
    public $selectedProject = null;
    public $searchTerm = '';
    
    protected $queryString = [
        'searchTerm' => ['except' => ''],
        'selectedCategory' => ['except' => 'all'],
    ];

    public function showAllProjects()
    {
        $this->showAll = true;
        $this->resetPage();
    }

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
        $this->resetPage();
    }

    public function showProjectDetails($projectId)
    {
        $this->selectedProject = Project::findOrFail($projectId);
        $this->dispatch('open-project-modal');
    }

    public function closeProjectModal()
    {
        $this->selectedProject = null;
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Project::active()->orderBy('sort_order');

        // Apply search
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('title', 'ilike', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'ilike', '%' . $this->searchTerm . '%')
                  ->orWhere('short_description', 'ilike', '%' . $this->searchTerm . '%');
            });
        }

        // Apply category filter
        if ($this->selectedCategory !== 'all') {
            $query->whereJsonContains('tech_stack', $this->selectedCategory);
        }

        // Determine how many to show
        $limit = $this->showAll ? 12 : 3;
        $projects = $query->limit($limit)->get();

        // Get featured projects for initial display
        $featuredProjects = $this->showAll ? collect([]) : 
            Project::active()->featured()->orderBy('sort_order')->limit(3)->get();

        // Get technology categories for filters
        $technologies = Technology::active()
            ->select('slug', 'name', 'category')
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('livewire.project-showcase', compact('projects', 'featuredProjects', 'technologies'));
    }
}
