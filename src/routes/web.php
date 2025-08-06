<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Simple login system bypass for now
Route::get('/simple-login', function() {
    return view('simple-login');
});

Route::post('/simple-login', function(\Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    
    if ($credentials['email'] === 'admin@portfolio.local' && 
        $credentials['password'] === 'password123') {
        
        $user = \App\Models\User::where('email', 'admin@portfolio.local')->first();
        if ($user) {
            Auth::login($user);
            return redirect('/admin')->with('success', 'Login realizado com sucesso!');
        }
    }
    
    return back()->withErrors(['login' => 'Credenciais inválidas']);
});

Route::get('/simple-logout', function() {
    Auth::logout();
    return redirect('/simple-login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes - Test first (no auth)
Route::get('/admin/test-public', function() {
    return 'Admin route working without auth!';
});

// Test credentials directly
Route::get('/test-credentials', function() {
    $user = \App\Models\User::where('email', 'admin@portfolio.local')->first();
    
    if (!$user) {
        return 'User not found!';
    }
    
    $passwordTest = Hash::check('password123', $user->password);
    
    return [
        'user_found' => true,
        'name' => $user->name,
        'email' => $user->email,
        'password_correct' => $passwordTest
    ];
});

// Admin Routes - Test with auth
Route::get('/admin/test', function() {
    return 'Admin route working with auth! User: ' . (auth()->user()->name ?? 'No user');
})->middleware('auth:sanctum');

// Admin test with simple view
Route::get('/admin/test-view', function() {
    return view('dashboard'); // Usar view que sabemos que funciona
})->middleware('auth:sanctum');

// Test admin dashboard with same logic as controller
Route::get('/admin/test-dashboard', function() {
    $stats = [
        'total_projects' => \App\Models\Project::count(),
        'active_projects' => \App\Models\Project::active()->count(),
        'featured_projects' => \App\Models\Project::featured()->count(),
        'total_contacts' => \App\Models\Contact::count(),
        'unread_contacts' => \App\Models\Contact::where('status', 'new')->count(),
        'technologies' => \App\Models\Technology::active()->count(),
    ];

    $recent_contacts = \App\Models\Contact::latest()->limit(5)->get();
    $recent_projects = \App\Models\Project::latest()->limit(5)->get();

    return view('admin.dashboard', compact('stats', 'recent_contacts', 'recent_projects'));
})->middleware('auth:sanctum');

// Test auth views
Route::get('/test-login-view', function() {
    try {
        return view('auth.login');
    } catch (Exception $e) {
        return 'Login view error: ' . $e->getMessage();
    }
});

Route::get('/test-jetstream', function() {
    return 'Jetstream config: ' . json_encode([
        'stack' => config('jetstream.stack'),
        'guard' => config('jetstream.guard'),
        'middleware' => config('jetstream.middleware')
    ]);
});

// Test user credentials
Route::get('/check-user', function() {
    $user = \App\Models\User::where('email', 'admin@portfolio.local')->first();
    
    if ($user) {
        return [
            'found' => true,
            'name' => $user->name,
            'email' => $user->email,
            'has_password' => !empty($user->password),
            'password_test' => Hash::check('password123', $user->password)
        ];
    }
    
    return ['found' => false, 'message' => 'User not found'];
});

// Admin Routes (simplified middleware for testing)
Route::middleware(['auth:sanctum'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
        Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);
    });
