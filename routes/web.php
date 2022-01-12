<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Olipacks\Mito\Models\Post;

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
    $latestPost = Post::doesntHaveTag('es')->published()->orderBy('published_at', 'desc')->first();

    $years = Post::doesntHaveTag('es')->published()->orderBy('published_at', 'desc')->get()
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

Route::get('/es', function () {
    app()->setLocale('es');

    $latestPost = Post::hasTag('es')->published()->orderBy('published_at', 'desc')->first();

    $years = Post::hasTag('es')->published()->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('es.home', [
        'latestPost' => $latestPost,
        'years' => $years,
    ]);
})->name('es.home');

Route::get('/feed', function () {
    $content = view('feed', [
        'author' => User::first(),
        'posts' => Post::doesntHaveTag('es')->published()->orderBy('published_at', 'desc')->get(),
    ]);

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
})->name('feed');

Route::get('/now', function () {
    $years = Post::doesntHaveTag('es')->published()->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('now', [
        'years' => $years,
    ]);
})->name('now');

Route::get('/es/ahora', function () {
    app()->setLocale('es');

    $years = Post::hasTag('es')->published()->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('es.now', [
        'years' => $years,
    ]);
})->name('es.now');

Route::get('/contact', function () {
    $years = Post::doesntHaveTag('es')->published()->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('contact', [
        'years' => $years,
    ]);
})->name('contact');

Route::get('/es/contacto', function () {
    app()->setLocale('es');

    $years = Post::hasTag('es')->published()->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('es.contact', [
        'years' => $years,
    ]);
})->name('contact');

Route::get('/es/{post:slug}', function (Post $post) {
    abort_unless($post->isPublished(), 404);

    abort_unless($post->tags->pluck('slug')->contains('es'), 404);

    app()->setLocale('es');

    Carbon::setlocale(app()->getLocale());

    $years = Post::hasTag('es')->published()->orderBy('published_at', 'desc')->get()
        ->groupBy([
            function ($post) {
                return Carbon::parse($post->published_at)->format('Y');
            },
            function ($post) {
                return Carbon::parse($post->published_at)->format('F');
            },
    ]);

    return view('es.post', [
        'years' => $years,
        'post' => $post,
    ]);
})->name('es.posts.show');

Route::get('/{post:slug}', function (Post $post) {
    abort_unless($post->isPublished(), 404);

    abort_unless($post->tags->pluck('slug')->doesntContain('es'), 404);

    $years = Post::doesntHaveTag('es')->published()->orderBy('published_at', 'desc')->get()
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
