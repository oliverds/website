<?php

use App\Models\Post;

it('renders the homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('shows only published posts on the homepage', function () {
    $publishedPost = Post::factory()->published()->create();

    $draftPost = Post::factory()->draft()->create();

    $response = $this->get('/');

    $response
        ->assertSee($publishedPost->title)
        ->assertDontSee($draftPost->title);
});
