<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Radiocubito\Contentful\Models\Post;

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
    return view('home', [
        'author' => User::first(),
        'posts' => Post::published()->orderBy('published_at', 'desc')->get(),
    ]);
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/now', function () {
    return view('now', ['author' => User::first()]);
})->name('now');

Route::get('/contact', function () {
    return view('contact', ['author' => User::first()]);
})->name('contact');

Route::get('/{post:slug}', function (Post $post) {
    abort_unless($post->isPublished(), 404);

    return view('post', [
        'author' => User::first(),
        'post' => $post,
    ]);
})->name('posts.show');
