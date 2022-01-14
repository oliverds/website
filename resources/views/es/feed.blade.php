@php echo '<?xml version="1.0" encoding="UTF-8"?>' @endphp

<feed xml:lang="es-MX" xmlns="http://www.w3.org/2005/Atom">
    <id>tag:{{ request()->getHost() }},2005:/feed</id>
    <link rel="alternate" type="text/html" href="{{ route('es.home') }}"/>
    <link rel="self" type="application/atom+xml" href="{{ route('es.feed') }}"/>
    <title><![CDATA[{{ config('app.name') }}]]></title>
    <updated>{{ $posts->first()->updated_at->format('Y-m-d\TH:i:s\Z') }}</updated>
    @foreach ($posts as $post)
    <entry>
        <id>tag:{{ request()->getHost() }},2005:World::Post/{{ $post->id }}</id>
        <published>{{ $post->published_at->format('Y-m-d\TH:i:s\Z') }}</published>
        <updated>{{ $post->updated_at->format('Y-m-d\TH:i:s\Z') }}</updated>
        <link rel="alternate" type="text/html" href="{{ route('es.posts.show', $post) }}" />
        <title><![CDATA[{{ $post->title }}]]></title>
        <content type="html">
            <![CDATA[<x-mito-markdown flavor="github">{!! $post->markdown_without_title !!}</x-mito-markdown>]]>
        </content>
        <author>
            <name> <![CDATA[{{ $author->name }}]]></name>
            <email> <![CDATA[{{ $author->email }}]]></email>
        </author>
    </entry>
    @endforeach
</feed>
