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

            <section class="space-y-6">
                @foreach ($posts as $post)
                    <article class="pt-10 px-10 pb-24 border rounded shadow-lg relative">
                        <header>
                            <p class="text-center text-base text-gray-500">
                                {{ $post->published_at->format('F j, Y') }}
                            </p>
                            <h2 class="text-center font-bold text-3xl mt-1">
                                {{ $post->title }}
                            </h2>
                        </header>

                        <div class="mt-6 text-xl font-gray-900">
                            {{ $post->excerpt }}
                        </div>

                        <a class="absolute top-0 bottom-0 left-0 right-0 text-transparent z-10" href="{{ route('posts.show', $post) }}">Read more</a>

                        <div class="p-7 absolute bottom-0 left-0 right-0 text-center">
                            <span class="border rounded-full py-1 px-3 font-medium text-gray-500">Read more</span>
                        </div>
                    </article>
                @endforeach
            </section>
        </main>

        @production
            <!-- Fathom - simple website analytics - https://github.com/usefathom/fathom -->
            <script>
            (function(f, a, t, h, o, m){
                a[h]=a[h]||function(){
                    (a[h].q=a[h].q||[]).push(arguments)
                };
                o=f.createElement('script'),
                m=f.getElementsByTagName('script')[0];
                o.async=1; o.src=t; o.id='fathom-script';
                m.parentNode.insertBefore(o,m)
            })(document, window, '//fathom.radiocubito.com/tracker.js', 'fathom');
            fathom('set', 'siteId', 'BNRLG');
            fathom('trackPageview');
            </script>
            <!-- / Fathom -->
        @endproduction
    </body>
</html>
