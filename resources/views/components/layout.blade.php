<x-html class="font-sans antialiased pb-16" :title="isset($title) ? $title . ' - ' . config('app.name') : ''">
    <x-slot name="head">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <link rel="alternate" type="application/atom+xml" title="Feed" href="{{ route('feed') }}">

        {{ $head ?? '' }}
    </x-slot>

    {{ $slot }}


    @production
        <!-- Fathom - simple website analytics - https://github.com/usefathom/fathom -->
        <script>
        (function(f, a, t, h, o, m){
            a[h]=a[h]||function(){
                (a[h].q=a[h].q||[]).push(arguments)
            };
            o=f.createElement('script'),
            m=f.getElementsByTagName('script')[0];
            o.async=1; o.src=t; o.id='fathom-script';
            m.parentNode.insertBefore(o,m)
        })(document, window, '//fathom.radiocubito.com/tracker.js', 'fathom');
        fathom('set', 'siteId', 'BNRLG');
        fathom('trackPageview');
        </script>
        <!-- / Fathom -->
    @endproduction
</x-html>
