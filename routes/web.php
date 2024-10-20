<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication routes
Auth::routes();
Route::resource('tasks', TaskController::class);
// Redirect to tasks list after login
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Group routes that require user authentication
Route::middleware(['auth'])->group(function () {
    // Route for displaying the list of tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

    // Route for storing a new task
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    // Route for editing a task
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

    // Route for updating a task
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

    // Route for deleting a task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Route for marking a task as completed/incomplete
    // Route::post('/tasks/{task}/toggle', [TaskController::class, 'toggleCompletion'])->name('tasks.toggle');
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleCompletion'])->name('tasks.toggleCompletion');

});
