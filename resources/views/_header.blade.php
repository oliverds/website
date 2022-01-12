@php
$homeLink = match (app()->getLocale()) {
    'es' => '/es',
    default => '/',
};
@endphp

<header class="mt-12 text-center">
    @if (app()->getLocale() === 'es')
        <a href="/es">
            <img class="h-12 w-12 rounded-full mx-auto mb-1" src="{{ asset('/img/profile_photo.jpg') }}">
            <h1 class="block text-sm lg:text-base text-center text-gray-600 font-semibold tracking-widest uppercase">Oliver Servín</h1>
        </a>
    @else
        <a href="/">
            <img class="h-12 w-12 rounded-full mx-auto mb-1" src="{{ asset('/img/profile_photo.jpg') }}">
            <h1 class="block text-sm lg:text-base text-center text-gray-600 font-semibold tracking-widest uppercase">Oliver Servín</h1>
        </a>
    @endif
</header>
