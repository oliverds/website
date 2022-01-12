@php
$link = match (app()->getLocale()) {
    'es' => '/',
    default => '/es',
};

$title = match (app()->getLocale()) {
    'es' => 'English',
    default => 'Español',
};
@endphp

<div class="text-right px-3 leading-relaxed py-2">
    <a class="text-gray-600 font-medium hover:underline hover:text-gray-900" href="{{ $link }}">{{ $title }} →</a>
</div>
