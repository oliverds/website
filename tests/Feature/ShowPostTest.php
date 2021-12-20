<?php

use Olipacks\Mito\Models\Post;

it('shows a published post', function () {
    $publishedPost = Post::factory([
        'slug' => 'published-post',
    ])->published()->create();

    $response = $this->get(route('posts.show', $publishedPost));

    $response
        ->assertStatus(200)
        ->assertSee($publishedPost->title);
});

it('does not show a draft post', function () {
    $draftPost = Post::factory([
        'slug' => 'published-post',
    ])->draft()->create();

    $response = $this->get(route('posts.show', $draftPost));

    $response
        ->assertStatus(404);
});
