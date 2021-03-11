@props([
    'title' => '',
    'description' => '',
    'type' => 'website',
    'card' => 'summary_large_image',
    'image' => '',
    'url' => '',
])

<meta name="twitter:card" content="{{ $card }}" />
<meta name="twitter:image" content="{{ $image }}" />

<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}" />

@if ($description)
    <meta name="description" content="{{ $description }}">
    <meta property="og:description" content="{{ $description }}">
@endif

@if ($image)
    <meta property="og:image" content="{{ $image }}" />
@endif

<meta property="og:url" content="{{ $url ?: url()->current() }}" />
<meta property="og:locale" content="{{ app()->getLocale() }}" />
