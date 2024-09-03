<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReadmeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;

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

Route::get('/', function () {
    return view('welcome', [
        'posts' => Post::count()
    ]);
})->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);
Route::post('/posts/{post}/publish', [PostController::class, 'publish'])->name('posts.publish');
Route::post('/posts/{post}/unpublish', [PostController::class, 'unpublish'])->name('posts.unpublish');

// Route for displaying the dashboard
Route::get('/dashboard', [DashboardController::class, 'show'])->middleware(['auth', 'can:access-dashboards'])->name('dashboard');

// Route for updating the markdown content in the dashboard
Route::post('/dashboard/update-md', [DashboardController::class, 'updateMarkdown'])->middleware(['auth', 'can:access-dashboards'])->name('dashboard.update-md');

Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::get('/cv', [CVController::class, 'index'])->name('cv');
Route::get('/about', [AboutController::class, 'index'])->name('about');

require __DIR__.'/auth.php';
