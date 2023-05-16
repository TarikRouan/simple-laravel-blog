<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\commentsController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('blog.index'));
});

Route::get('/dashboard', function () {
    return view('dashboard', ["posts" => Auth::user()->posts()->orderBy('updated_at', 'desc')->paginate(5)]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('blog', PostsController::class);

Route::get('/comment/full', [commentsController::class, 'comments'])->middleware(['auth', 'verified']);

Route::post('/comment/{post}', [commentsController::class, 'store'])->name('comment.store');
Route::get('/comment/{post}', [commentsController::class, 'index'])->name('comment.index')->middleware(['auth', 'verified']);
Route::delete('/comment/{comment}', [commentsController::class, 'destroy'])->name('comment.destroy')->middleware(['auth', 'verified']);


Route::get('/searchpub', [FilterController::class, 'searchpub'])->name('searchpub');
Route::get('/searchadm', [FilterController::class, 'searchadm'])->name('searchadm');
