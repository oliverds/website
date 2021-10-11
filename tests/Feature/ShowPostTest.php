<?php

use App\Models\Post;

it('renders a published post', function () {
    $publishedPost = Post::factory()->published()->create();

    $response = $this->get(route('posts.show', $publishedPost));

    $response
        ->assertStatus(200)
        ->assertSee($publishedPost->title);
});

it('does not render a draft post', function () {
    $draftPost = Post::factory()->draft()->create();

    $response = $this->get(route('posts.show', $draftPost));

    $response
        ->assertStatus(404);
});
