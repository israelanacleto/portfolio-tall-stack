<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Tecnologias para a seção de showcase
        $technologies = Technology::active()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('home', compact('technologies'));
    }
}
