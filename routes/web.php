<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Radiocubito\Wordful\Models\Post;

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
    $latestPost = Post::published()->ofType('post')->orderBy('published_at', 'desc')->first();

    $years = Post::published()->ofType('post')->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('home', [
        'latestPost' => $latestPost,
        'years' => $years,
    ]);
})->name('home');

Route::get('/feed', function () {
    $content = view('feed', [
        'posts' => Post::published()->ofType('post')->orderBy('published_at', 'desc')->get(),
    ]);

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
})->name('feed');

Route::get('/{post:slug}', function (Post $post) {
    abort_unless($post->isPublished(), 404);

    $years = Post::published()->ofType('post')->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('post', [
        'years' => $years,
        'post' => $post,
    ]);
})->name('posts.show');
