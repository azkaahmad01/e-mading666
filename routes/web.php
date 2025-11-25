<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;

// Routes untuk frontend
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{postId}/modal', [PostController::class, 'modal'])->name('posts.modal');
Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store')->middleware('auth');
Route::post('/posts/{postId}/like', [App\Http\Controllers\LikeController::class, 'toggle'])->name('posts.like')->middleware('auth');

// Notification routes
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

Route::get('/category/{category:slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('posts.category');
Route::get('/tag/{tag:slug}', [PostController::class, 'tag'])->name('posts.tag');

// Routes untuk pembina
Route::prefix('pembina')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\PembinaController::class, 'dashboard'])->name('pembina.dashboard');
    Route::get('/posts/pending', [App\Http\Controllers\PembinaController::class, 'pendingPosts'])->name('pembina.posts.pending');
    Route::post('/posts/{post}/approve', [App\Http\Controllers\PembinaController::class, 'approvePost'])->name('pembina.posts.approve');
    Route::post('/posts/{post}/reject', [App\Http\Controllers\PembinaController::class, 'rejectPost'])->name('pembina.posts.reject');
});

// Routes untuk siswa
Route::prefix('siswa')->middleware(['auth', 'siswa'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/posts', [App\Http\Controllers\SiswaController::class, 'myPosts'])->name('siswa.posts');
    Route::get('/posts/create', [App\Http\Controllers\SiswaController::class, 'createPost'])->name('siswa.posts.create');
    Route::post('/posts', [App\Http\Controllers\SiswaController::class, 'storePost'])->name('siswa.posts.store');
    Route::get('/posts/{post}/edit', [App\Http\Controllers\SiswaController::class, 'editPost'])->name('siswa.posts.edit');
    Route::put('/posts/{post}', [App\Http\Controllers\SiswaController::class, 'updatePost'])->name('siswa.posts.update');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\SiswaController::class, 'markNotificationAsRead'])->name('siswa.notifications.read');
});

// Routes untuk admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Posts Management
    Route::resource('posts', AdminPostController::class)->except(['create', 'store', 'show'])->names([
        'index' => 'admin.posts.index',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy',
    ]);
    Route::get('/posts/pending', [AdminPostController::class, 'pending'])->name('admin.posts.pending');
    Route::post('/posts/{post}/approve', [AdminPostController::class, 'approve'])->name('admin.posts.approve');
    Route::post('/posts/{post}/reject', [AdminPostController::class, 'reject'])->name('admin.posts.reject');


    // Categories Management
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    // Comments Management
    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::patch('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('admin.comments.approve');
    Route::patch('/comments/{comment}/reject', [CommentController::class, 'reject'])->name('admin.comments.reject');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');

    // User Management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // Reports
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/export/pdf', [App\Http\Controllers\Admin\ReportController::class, 'exportPdf'])->name('admin.reports.export.pdf');
    Route::get('/reports/export/excel', [App\Http\Controllers\Admin\ReportController::class, 'exportExcel'])->name('admin.reports.export.excel');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});