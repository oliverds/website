<x-layout>
    <x-slot name="head">
        <link rel="apple-touch-icon" sizes="300x300" href="{{ $author->profile_photo_url }}">
        <link rel="icon" type="image/png" sizes="300x300" href="{{ $author->profile_photo_url }}">

        <x-social-meta
            :title="config('app.name')"
            :description="config('app.name')"
            :image="$author->profile_photo_url"
            type="article"
            card="summary"
        />
    </x-slot>

    <main class="p-4 max-w-3xl mx-auto">
        <header class="mt-12 text-center">
            <a href="/">
                <img class="h-12 w-12 rounded-full mx-auto mb-1" src="{{ $author->profile_photo_url }}">
                <h1 class="text-sm lg:text-base tracking-widest uppercase text-gray-500">{{ $author->name }}</h1>
            </a>
        </header>

        <section class="mt-12 text-center">
            <p class="text-sm lg:text-base text-gray-500 mt-4 mb-3">
                <a href="/now">Now</a>
                <span aria-hidden="true"> · </span>
                <a href="https://twitter.com/olrjs">Twitter</a>
                <span aria-hidden="true"> · </span>
                <a href="https://github.com/oliverds/">Github</a>
                <span aria-hidden="true"> · </span>
                <a href="/contact">Contact</a>
                <span aria-hidden="true"> · </span>
                <a href="{{ route('feed') }}">RSS feed</a>
            </p>
        </section>

        <section class="mt-12">
            @include('_subscribe')
        </section>

        <section class="mt-12 space-y-6">
            @foreach ($posts as $post)
                <article class="pt-6 px-6 pb-16 lg:pt-10 lg:px-10 lg:pb-24 border rounded shadow-lg relative">
                    <header>
                        <p class="text-center text-sm lg:text-base text-gray-500">
                            {{ $post->published_at->format('F j, Y') }}
                        </p>
                        <h2 class="text-center font-bold text-2xl lg:text-3xl mt-1 leading-none">
                            {{ $post->title }}
                        </h2>
                    </header>

                    <div class="mt-6 text-lg leading-snug lg:text-xl font-gray-900">
                        {{ $post->excerpt }}
                    </div>

                    <a class="absolute top-0 bottom-0 left-0 right-0 text-transparent z-10" href="{{ route('posts.show', $post) }}">Read more</a>

                    <div class="p-5 lg:p-7 absolute bottom-0 left-0 right-0 text-center">
                        <span class="border rounded-full py-1 px-3 font-medium text-gray-500 text-sm lg:text-base">Read more</span>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
</x-layout>
