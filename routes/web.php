<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Admin
// Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
Route::prefix('admin')->name('admin.')->group(function(){
    Route::namespace('Auth')->middleware('guest:admin')->group(function(){
        // Login route
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('adminlogin');
    });
    
    Route::middleware('admin')->group(function(){
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('admin-test', [HomeController::class, 'adminTest'])->name('admintest');
        Route::get('editor-test', [HomeController::class, 'editorTest'])->name('editortest');

        Route::resource('posts', PostController::class);
        
        // Route::get('posts-index', [PostController::class, 'index'])->name('posts.index');
        // Route::get('posts-edit', [PostController::class, 'edit'])->name('posts.edit');
        // Route::post('posts-update', [PostController::class, 'update'])->name('posts.update');
        // Route::resource('posts', PostController::class)->shallow();
    });
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout'); 
});
