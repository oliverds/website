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
        @include('_header')

        @include('_navigation')

        <section class="mt-12">
            @include('_subscribe')
        </section>

        <section class="mt-12">
            <div class="grid gap-6 lg:gap-y-6">
                @foreach ($posts as $post)
                    <div class="py-6 lg:py-10">
                        <p class="text-sm text-gray-500 font-mono">
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('F j, Y') }}</time>
                        </p>
                        <a href="{{ route('posts.show', $post) }}" class="mt-2 block">
                            <p class="text-xl lg:text-2xl font-semibold text-gray-900">
                                {{ $post->title }}
                            </p>
                            <p class="mt-3 text-base lg:text-lg text-gray-700">
                                {{ $post->excerpt }}
                            </p>
                        </a>
                        <div class="mt-3">
                            <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                Read more
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
</x-layout>
