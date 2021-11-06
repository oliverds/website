@props([
    'leadingAddOn' => false,
])

<div class="flex rounded">
    @if ($leadingAddOn)
        <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm leading-4">
            {{ $leadingAddOn }}
        </span>
    @endif

    <input {{ $attributes->merge(['class' => 'flex-1 focus:ring-primary-500 focus:border-primary-500 text-sm py-1.5 border-gray-300 rounded' . ($leadingAddOn ? ' rounded-l-none' : '')]) }}">
</div>
