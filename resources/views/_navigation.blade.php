@php
$links = match (app()->getLocale()) {
    'es' => [
        ['Ahora', '/es/ahora', 'Twitter', 'https://twitter.com/oliverds_'],
        ['Twitter', 'https://twitter.com/oliverds_'],
        ['Github', 'https://github.com/oliverds/'],
        ['Contacto', '/es/contacto'],
    ],
    default => [
        ['Now', '/now', 'Twitter', 'https://twitter.com/oliverds_'],
        ['Twitter', 'https://twitter.com/oliverds_'],
        ['Github', 'https://github.com/oliverds/'],
        ['Contact', '/contact'],
    ],
};
@endphp

<section class="mt-12 text-center">
    <p class="text-sm lg:text-base text-gray-500 mt-4 mb-3">
        @foreach ($links as list($title, $link))
            <a class="hover:underline hover:text-gray-700 font-medium transition" href="{{ $link }}">{{ $title }}</a>

            @unless ($loop->last)
               <span aria-hidden="true"> · </span>
            @endif
        @endforeach
    </p>
</section>
