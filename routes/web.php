<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
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
    $posts = cache()->remember('posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $latestPost = $posts->first();

    $years = $posts->groupBy([
        function ($post) {
            return Carbon::parse($post['published_at'])->format('Y');
        },
        function ($post) {
            return Carbon::parse($post['published_at'])->format('F');
        },
    ]);

    return view('home', [
        'latestPost' => $latestPost,
        'years' => $years,
    ]);
})->name('home');

Route::get('/es', function () {
    app()->setLocale('es');

    $posts = cache()->remember('es-posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver-es/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $latestPost = $posts->first();

    $years = $posts->groupBy([
        function ($post) {
            return Carbon::parse($post['published_at'])->format('Y');
        },
        function ($post) {
            return Carbon::parse($post['published_at'])->format('F');
        },
    ]);

    return view('es.home', [
        'latestPost' => $latestPost,
        'years' => $years,
    ]);
})->name('es.home');

Route::get('/feed', function () {
    $posts = cache()->remember('posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $content = view('feed', [
        'author' => User::first(),
        'posts' => $posts,
    ]);

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
})->name('feed');

Route::get('/es/feed', function () {
    $posts = cache()->remember('es-posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver-es/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $content = view('es.feed', [
        'author' => User::first(),
        'posts' => $posts,
    ]);

    return response($content, 200)
        ->header('Content-Type', 'text/xml');
})->name('es.feed');

Route::get('/now', function () {
    $posts = cache()->remember('posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $years = $posts->groupBy([
        function ($post) {
            return Carbon::parse($post['published_at'])->format('Y');
        },
        function ($post) {
            return Carbon::parse($post['published_at'])->format('F');
        },
    ]);

    return view('now', [
        'years' => $years,
    ]);
})->name('now');

Route::get('/es/ahora', function () {
    app()->setLocale('es');

    $posts = cache()->remember('es-posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver-es/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $years = $posts->groupBy([
        function ($post) {
            return Carbon::parse($post['published_at'])->format('Y');
        },
        function ($post) {
            return Carbon::parse($post['published_at'])->format('F');
        },
    ]);

    return view('es.now', [
        'years' => $years,
    ]);
})->name('es.now');

Route::get('/contact', function () {
    $posts = cache()->remember('posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $years = $posts->groupBy([
        function ($post) {
            return Carbon::parse($post['published_at'])->format('Y');
        },
        function ($post) {
            return Carbon::parse($post['published_at'])->format('F');
        },
    ]);

    return view('contact', [
        'years' => $years,
    ]);
})->name('contact');

Route::get('/es/contacto', function () {
    app()->setLocale('es');

    $posts = cache()->remember('es-posts', now()->addHours(12), function () {
        $response = Http::mito()
            ->get('/oliver-es/content/posts')
            ->collect();

        if ($response->has('data')) {
            return collect($response->get('data'));
        }
    });

    $years = $posts->groupBy([
        function ($post) {
            return Carbon::parse($post['published_at'])->format('Y');
        },
        function ($post) {
            return Carbon::parse($post['published_at'])->format('F');
        },
    ]);

    return view('es.contact', [
        'years' => $years,
    ]);
})->name('contact');

$englishPostSlugs = cache()->remember('post-slugs', now()->addHours(12), function () {
    $response = Http::mito()
        ->get('/oliver/content/posts?fields[posts]=slug')
        ->collect();

    if ($response->has('data')) {
        return collect($response->get('data'));
    }
});

$englishPostSlugs->pluck('slug')->each(function ($postSlug) {
    Route::get("/{$postSlug}", function() use ($postSlug) {
        $currentPost = cache()->remember("posts/{$postSlug}", now()->addHours(12), function () use ($postSlug) {
            $response = Http::mito()
                ->get("/oliver/content/posts/slug/{$postSlug}")
                ->collect();

            if ($response->has('data')) {
                return collect($response->get('data'));
            }
        });

        $posts = cache()->remember('posts', now()->addHours(12), function () {
            $response = Http::mito()
                ->get('/oliver/content/posts')
                ->collect();

            if ($response->has('data')) {
                return collect($response->get('data'));
            }
        });

        $years = $posts->groupBy([
            function ($post) {
                return Carbon::parse($post['published_at'])->format('Y');
            },
            function ($post) {
                return Carbon::parse($post['published_at'])->format('F');
            },
        ]);

        return view('post', [
            'years' => $years,
            'currentPost' => $currentPost,
        ]);
    });
});

$spanishPostSlugs = cache()->remember('es-post-slugs', now()->addHours(12), function () {
    $response = Http::mito()
        ->get('/oliver-es/content/posts?fields[posts]=slug')
        ->collect();

    if ($response->has('data')) {
        return collect($response->get('data'));
    }
});

$spanishPostSlugs->pluck('slug')->each(function ($postSlug) {
    Route::get("/es/{$postSlug}", function() use ($postSlug) {
        $currentPost = cache()->remember("es-posts/{$postSlug}", now()->addHours(12), function () use ($postSlug) {
            $response = Http::mito()
                ->get("/oliver-es/content/posts/slug/{$postSlug}")
                ->collect();

            if ($response->has('data')) {
                return collect($response->get('data'));
            }
        });

        $posts = cache()->remember('es-posts', now()->addHours(12), function () {
            $response = Http::mito()
                ->get('/oliver/content/posts')
                ->collect();

            if ($response->has('data')) {
                return collect($response->get('data'));
            }
        });

        $years = $posts->groupBy([
            function ($post) {
                return Carbon::parse($post['published_at'])->format('Y');
            },
            function ($post) {
                return Carbon::parse($post['published_at'])->format('F');
            },
        ]);

        return view('es.post', [
            'years' => $years,
            'currentPost' => $currentPost,
        ]);
    });
});

Route::get('/es/{slug}', function ($slug) {
    abort(404);
})->name('es.posts.show');

Route::get('/{slug}', function ($slug) {
    abort(404);
})->name('posts.show');
