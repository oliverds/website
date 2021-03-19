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
        @include('_header')

        <p class="text-center text-sm lg:text-base text-gray-500 font-mono mt-12">
            <time datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('F j, Y') }}</time>
        </p>

        <h2 class="text-4xl lg:text-5xl font-bold text-center leading-none mt-2">
            {{ $post->title }}
        </h2>

        <section class="mt-12">
            <article>
                <div class="leading-snug prose prose-lg lg:prose-xl">
                    {!! $post->html !!}
                </div>
            </article>
        </section>

        <section class="mt-12">
            @include('_subscribe')
        </section>

        @include('_footer')
    </main>
</x-layout>
