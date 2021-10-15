<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Carbon;

it('shows only published posts', function () {
    $publishedPost = Post::factory()->published()->create();

    $response = $this->get(route('feed'));

    $response
        ->assertStatus(200)
        ->assertSee($publishedPost->title);
});

it('renders with the correct xml format', function () {
    Carbon::setTestNow('2021-10-13 12:00:00');

    $author = User::factory([
            'name' => 'Oliver',
            'email' => 'm@oliver.mx'
        ])
        ->create();

    Post::factory([
            'title' => 'Test post title',
            'slug' => 'test-post-title',
            'html' => 'Test post description',
            'author_id' => $author,
        ])
        ->published()
        ->state(['published_at' => now()])
        ->create();

    $xml = $this->get(route('feed'))->getContent();

    $this->assertMatchesXmlSnapshot($xml);
});
