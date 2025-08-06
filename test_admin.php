<?php

// Simple test to verify admin functionality
require_once 'src/vendor/autoload.php';

$app = require_once 'src/bootstrap/app.php';

// Bootstrap the application
$app->bootConsole();

try {
    echo "Testing admin user access...\n";
    
    $user = \App\Models\User::where('email', 'admin@portfolio.local')->first();
    
    if ($user) {
        echo "✓ Admin user found: " . $user->name . "\n";
        echo "✓ Email: " . $user->email . "\n";
        echo "✓ User ID: " . $user->id . "\n";
    } else {
        echo "✗ Admin user not found\n";
        exit(1);
    }
    
    echo "\nTesting project counts...\n";
    $projectCount = \App\Models\Project::count();
    $activeProjects = \App\Models\Project::active()->count();
    $featuredProjects = \App\Models\Project::featured()->count();
    
    echo "✓ Total projects: $projectCount\n";
    echo "✓ Active projects: $activeProjects\n";
    echo "✓ Featured projects: $featuredProjects\n";
    
    echo "\nTesting contact counts...\n";
    $contactCount = \App\Models\Contact::count();
    $unreadContacts = \App\Models\Contact::where('status', 'new')->count();
    
    echo "✓ Total contacts: $contactCount\n";
    echo "✓ Unread contacts: $unreadContacts\n";
    
    echo "\nTesting technology count...\n";
    $techCount = \App\Models\Technology::active()->count();
    echo "✓ Active technologies: $techCount\n";
    
    echo "\n✅ All database queries working correctly!\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}