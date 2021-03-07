<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Oliver Jiménez-Servín</title>

        <link rel="apple-touch-icon" sizes="300x300" href="{{ $author->profile_photo_url }}">
        <link rel="icon" type="image/png" sizes="300x300" href="{{ $author->profile_photo_url }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="font-sans antialiased pb-16">
        <main class="p-4 max-w-3xl mx-auto">
            <header class="my-12 text-center">
                <a href="/">
                    <img class="h-12 w-12 rounded-full mx-auto mb-1" src="{{ $author->profile_photo_url }}">
                    <h1 class="text-base tracking-widest uppercase text-gray-500">{{ $author->name }}</h1>
                </a>
            </header>

            <p class="text-center text-base text-gray-500">
                {{ $post->published_at->format('M n, Y') }}
            </p>

            <h2 class="text-5xl font-bold text-center leading-none mt-3">
                {{ $post->title }}
            </h2>

            <section class="mt-12">
                <article>
                    <div class="prose prose-xl">
                        {!! $post->html !!}
                    </div>
                </article>
            </section>
        </main>
    </body>
</html>
