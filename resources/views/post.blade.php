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

        <p class="text-xs lg:text-sm uppercase tracking-wide font-semibold text-gray-900 mt-12">
            <time datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('F j, Y') }}</time>
        </p>

        <h2 class="text-xl lg:text-3xl font-bold leading-none mt-2 text-gray-900">
            {{ $post->title }}
        </h2>

        <section class="mt-12">
            <article>
                <div class="prose lg:prose-xl">
                    {!! $post->html !!}
                </div>
            </article>
        </section>

        <section class="mt-12">
            @include('_subscribe')
        </section>

        <hr class="h-px border-0 bg-gradient-to-r from-gray-50 via-gray-300 to-gray-50 mt-12">

        <section class="mt-12">
            @foreach ($years as $year => $months)
                @foreach ($months as $month => $posts)
                    <h3 class="flex items-center font-semibold text-lg lg:text-2xl leading-relaxed text-gray-900 py-3 mt-10">
                        @if ($loop->first)
                            <time>{{ $year }}</time>
                        @endif
                     <time class="ml-auto">{{ $month }}</time>
                    </h3>
                 @foreach ($posts as $post)
                        <a href="{{ route('posts.show', $post) }}" class="flex items-baseline text-base lg:text-xl leading-6 lg:leading-9 text-gray-600 hover:text-gray-900 transition">
                            <p class="flex-initial overflow-hidden overflow-ellipsis whitespace-nowrap">
                                {{ $post->title }}
                            </p>
                            <hr class="flex-1 border-dotted mx-3 lg:mx-5 border-gray-300">
                            <time class="flex-initial whitespace-nowrap" datetime="{{ $post->published_at->format('Y-m-d') }}">{{ $post->published_at->format('jS') }}</time>
                        </a>
                    @endforeach
                @endforeach
            @endforeach
        </section>

        @include('_footer')
    </main>
</x-layout>
