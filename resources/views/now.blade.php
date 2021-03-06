<x-layout title="What I’m doing now">
    <x-slot name="head">
        <link rel="apple-touch-icon" sizes="300x300" href="{{ asset('/img/profile_photo.jpg') }}">
        <link rel="icon" type="image/png" sizes="300x300" href="{{ asset('/img/profile_photo.jpg') }}">

        <x-social-meta
            title="What I’m doing now"
            :image="asset('/img/profile_photo.jpg')"
            type="article"
            card="summary"
        />
    </x-slot>

    <x-switch-language />

    <main class="p-4 max-w-3xl mx-auto">
        @include('_header')

        <h2 class="text-xl lg:text-3xl font-bold leading-none mt-12 text-gray-900">
            What I’m doing now
        </h2>

        <section class="mt-12">
            <article>
                <x-mito-markdown class="prose min-w-full" flavor="github">
**Developer at Yclas**

I have been a web developer at [Yclas](https://yclas.com/) for five years.

_Updated Oct 16th, 2021, from Mexico City._</x-mito-markdown>
            </article>
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
                        <a href="{{ route('posts.show', ['slug' => $post['slug']]) }}" class="flex items-baseline text-base lg:text-xl leading-6 lg:leading-9 text-gray-600 hover:text-gray-900 transition">
                            <p class="flex-initial overflow-hidden overflow-ellipsis whitespace-nowrap">
                                {{ $post['title'] }}
                            </p>
                            <hr class="flex-1 border-dotted mx-3 lg:mx-5 border-gray-300">
                            <time class="flex-initial whitespace-nowrap" datetime="{{ Carbon\Carbon::parse($post['published_at'])->format('Y-m-d') }}">{{ Carbon\Carbon::parse($post['published_at'])->format('jS') }}</time>
                        </a>
                    @endforeach
                @endforeach
            @endforeach
        </section>

        @include('_footer')
    </main>
</x-layout>
