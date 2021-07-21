<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\FrontPostController;
use App\Http\Controllers\FrontCommentController;

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

Route::group(['middleware' => 'admin'], function(){
    Route::prefix('blog/admin/')->name('admin.')->group(function(){
        Route::get('/',[HomeController::class, 'index'])->name('home');
        Route::resource('categories', CategoryController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('posts', PostController::class);
        Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
        Route::post('comments/status/{id}', [CommentController::class, 'action'])->name('comments.action');
        Route::delete('comments/{id}', [CommentController::class, 'delete'])->name('comments.delete');
    });
});

Route::get('/', [MainController::class, 'index']);
Route::get('/post/{id}', [FrontPostController::class, 'index'])->name('post.show');
Route::get('/search', [FrontPostController::class, 'searchTitle'])->name('post.search');
Route::post('/comment/{post_id}', [FrontCommentController::class, 'store'])->name('comment.store');
Route::post('/reply', [FrontCommentController::class, 'reply'])->name('comment.reply');



Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

