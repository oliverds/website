<x-html class="font-sans antialiased pb-16" :title="isset($title) ? $title . ' - ' . config('app.name') : ''">
    <x-slot name="head">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <link rel="alternate" type="application/atom+xml" title="Feed" href="{{ route('feed') }}">

        {{ $head ?? '' }}
    </x-slot>

    {{ $slot }}

    @production
        @guest
            <script async defer data-website-id="96e24546-82c4-4144-a473-35d0c94f7b57" src="https://stats.radiocubito.com/umami.js"></script>
        @endguest
    @endproduction

    @guest
        <script async defer data-volante src="{{ asset(mix('js/volante.js', 'vendor/volante')) }}"></script>
    @endguest
</x-html>
