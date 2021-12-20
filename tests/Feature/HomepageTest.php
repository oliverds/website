<?php

use Olipacks\Mito\Models\Post;

it('renders the homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('shows only published posts on the homepage', function () {
    $publishedPost = Post::factory([
        'slug' => 'published-post',
    ])->published()->create();

    $draftPost = Post::factory([
        'slug' => 'draft',
    ])->draft()->create();

    $response = $this->get('/');

    $response
        ->assertSee($publishedPost->title)
        ->assertDontSee($draftPost->title);
});
