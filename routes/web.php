<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes - require authentication
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/count', [NotificationController::class, 'count'])->name('notifications.count');
    Route::get('/notifications/list', [NotificationController::class, 'getList'])->name('notifications.list');
    Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    // Admin Only Routes
    Route::middleware(['role:admin'])->group(function () {
        // Tasks Management
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/calendar', [TaskController::class, 'calendar'])->name('tasks.calendar');
        Route::get('/tasks/kanban', [TaskController::class, 'kanban'])->name('tasks.kanban');
        Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::get('/tasks/{id}/delete', [TaskController::class, 'destroy'])->name('tasks.destroy');

        // Users Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Profile Routes (available for both admin and employee)
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', function () {
        return view('users.edit_profile');
    })->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Employee Routes
    Route::middleware(['role:employee'])->group(function () {
        Route::get('/my-tasks', [TaskController::class, 'myTasks'])->name('tasks.my');
        Route::get('/my-tasks/{id}/edit', [TaskController::class, 'editEmployee'])->name('tasks.edit.employee');
        Route::put('/my-tasks/{id}', [TaskController::class, 'updateEmployee'])->name('tasks.update.employee');
    });
});
