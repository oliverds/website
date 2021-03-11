@php echo '<?xml version="1.0" encoding="UTF-8"?>' @endphp

<feed xml:lang="en-US" xmlns="http://www.w3.org/2005/Atom">
    <id>tag:{{ request()->getHost() }},2005:/feed</id>
    <link rel="alternate" type="text/html" href="{{ route('home') }}"/>
    <link rel="self" type="application/atom+xml" href="{{ route('feed') }}"/>
    <title><![CDATA[{{ config('app.name') }}]]></title>
    <updated>{{ $posts->first()->updated_at->format('D, d M Y H:i:s +0000') }}</updated>
    @foreach ($posts as $post)
    <entry>
        <id>tag:{{ request()->getHost() }},2005:World::Post/{{ $post->id }}</id>
        <published>{{ $post->published_at->format('D, d M Y H:i:s +0000') }}</published>
        <updated>{{ $post->updated_at->format('D, d M Y H:i:s +0000') }}</updated>
        <link rel="alternate" type="text/html" href="{{ route('posts.show', $post) }}" />
        <title><![CDATA[{{ $post->title }}]]></title>
        <content type="html">
            <![CDATA[{!! $post->html !!}]]>
        </content>
        <author>
            <name> <![CDATA[{{ $post->author->name }}]]></name>
            <email> <![CDATA[{{ $post->author->email }}]]></email>
        </author>
    </entry>
    @endforeach
</feed>
