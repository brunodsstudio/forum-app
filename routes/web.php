<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;

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

Route::get('/exit', function () {
   
    //return view('login');
    return view('dashboard');
});

Route::get('/', [PostsController::class, 'index']
)->middleware(['auth'])->name('Posts');


Route::get('/viewProfile', [ProfileController::class, 'index']
)->middleware(['auth'])->name('Profile');

/*profile routes----------------------------------------------------------------*/
Route::post('/uploadPicProfile', [ProfileController::class, 'uploadPicProfile']
)->middleware(['auth'])->name('Profile');

Route::post('/updateProfile', [ProfileController::class, 'updateProfile']
)->middleware(['auth'])->name('Profile');
/*end profile routes*/

Route::get('/viewPosts', [PostsController::class, 'index']
)->middleware(['auth'])->name('Posts');

Route::post('/likePost', [PostsController::class, 'likePost']
)->middleware(['auth'])->name('Profile');

Route::get('/allPostsTable', [PostsController::class, 'allPostsTable']
)->middleware(['auth'])->name('Profile');

Route::post('/editHist', [PostsController::class, 'showPostHistory']
)->middleware(['auth'])->name('Profile');

Route::post('/deletePost', [PostsController::class, 'deletePost']
)->middleware(['auth'])->name('Profile');

Route::post('/deleteComment', [PostsController::class, 'deleteComment']
)->middleware(['auth'])->name('Profile');

Route::post('/addComment', [PostsController::class, 'addComment']
)->middleware(['auth'])->name('Profile');

Route::post('/addPost', [PostsController::class, 'addPost']
)->middleware(['auth'])->name('Profile');

Route::post('/editPost', [PostsController::class, 'editPost']
)->middleware(['auth'])->name('Profile');

Route::post('/updatePost', [PostsController::class, 'updatePost']
)->middleware(['auth'])->name('Profile');



Route::get('/dashboard', function () {
  //  return view('dashboard');
    return redirect('/');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
