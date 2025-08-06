<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::active()
            ->featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $allProjects = Project::active()
            ->orderBy('sort_order')
            ->get();

        $technologies = Technology::active()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('home', compact('featuredProjects', 'allProjects', 'technologies'));
    }
}
