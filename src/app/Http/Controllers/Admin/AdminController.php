<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Contact;
use App\Models\Technology;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Middleware aplicado nas rotas

    public function index()
    {
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::active()->count(),
            'featured_projects' => Project::featured()->count(),
            'total_contacts' => Contact::count(),
            'unread_contacts' => Contact::where('status', 'new')->count(),
            'technologies' => Technology::active()->count(),
        ];

        $recent_contacts = Contact::latest()->limit(5)->get();
        $recent_projects = Project::latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_contacts', 'recent_projects'));
    }
}
