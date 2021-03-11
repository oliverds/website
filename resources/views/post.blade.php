<x-layout :title="$post->title">
    <x-slot name="head">
        <link rel="apple-touch-icon" sizes="300x300" href="{{ $author->profile_photo_url }}">
        <link rel="icon" type="image/png" sizes="300x300" href="{{ $author->profile_photo_url }}">

        <x-social-meta
            :title="$post->title"
            :description="$post->excerpt"
            :image="$author->profile_photo_url"
            type="article"
            card="summary"
        />
    </x-slot>

    <main class="p-4 max-w-3xl mx-auto">
        <header class="my-12 text-center">
            <a href="/">
                <img class="h-12 w-12 rounded-full mx-auto mb-1" src="{{ $author->profile_photo_url }}">
                <h1 class="text-sm lg:text-base tracking-widest uppercase text-gray-500">{{ $author->name }}</h1>
            </a>
        </header>

        <p class="text-center text-sm lg:text-base text-gray-500">
            {{ $post->published_at->format('F j, Y') }}
        </p>

        <h2 class="text-4xl lg:text-5xl font-bold text-center leading-none mt-3">
            {{ $post->title }}
        </h2>

        <section class="mt-12">
            <article>
                <div class="leading-snug prose prose-lg lg:prose-xl">
                    {!! $post->html !!}
                </div>
            </article>
        </section>
    </main>
</x-layout>
