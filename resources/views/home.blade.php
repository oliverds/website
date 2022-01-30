<x-layout>
    <x-slot name="head">
        <link rel="apple-touch-icon" sizes="300x300" href="{{ asset('/img/profile_photo.jpg') }}">
        <link rel="icon" type="image/png" sizes="300x300" href="{{ asset('/img/profile_photo.jpg') }}">

        <x-social-meta
            :title="config('app.name')"
            :description="config('app.name')"
            :image="asset('/img/profile_photo.jpg')"
            type="article"
            card="summary"
        />
    </x-slot>

    <x-switch-language />

    <main class="p-4 max-w-3xl mx-auto">
        @include('_header')

        @include('_navigation')

        <hr class="h-px border-0 bg-gradient-to-r from-gray-50 via-gray-300 to-gray-50 mt-12">

        <p class="text-xs lg:text-sm uppercase tracking-wide font-semibold text-gray-900 mt-12">
            Projects
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 mt-4">
            <div class="bg-gray-100 p-4 rounded-md">
                <div class="h-12 flex items-center"><a href="https://mitophp.com" target="_blank"><img class="h-5" src="{{ asset('/img/mito-icon.png') }}" alt="Mito"></a></div>
                <p class="mt-4">A blog publishing platform with a minimal UI to manage a markdown blog publication.</p>
                <p class="mt-4"><a href="https://mitophp.com" target="_blank" class="text-gray-500 text-sm">mitophp.com ›</a></p>
            </div>
        </div>

        @if($latestPost)
            <hr class="h-px border-0 bg-gradient-to-r from-gray-50 via-gray-300 to-gray-50 mt-12">

            <p class="text-xs lg:text-sm uppercase tracking-wide font-semibold text-gray-900 mt-12">
                <time datetime="{{ Carbon\Carbon::parse($latestPost['published_at'])->format('Y-m-d') }}">{{ Carbon\Carbon::parse($latestPost['published_at'])->format('F j, Y') }}</time>
            </p>

            <h1 class="text-xl lg:text-3xl font-bold leading-none mt-2 text-gray-900">
                {{ $latestPost['title'] }}
            </h1>

            <section class="mt-12">
                <article>
                    <x-markdown class="prose min-w-full" flavor="github">{!! $latestPost['markdown_without_title'] !!}</x-markdown>
                </article>
            </section>
        @endif

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
    </main>
</x-layout>
