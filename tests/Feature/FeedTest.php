<?php

use App\Models\User;
use Illuminate\Support\Carbon;
use Mito\Models\Post;

beforeEach(function () {
    $author = User::factory([
            'name' => 'Oliver',
            'email' => 'm@oliver.mx'
        ])
        ->create();
});

it('shows only published posts', function () {
    $publishedPost = Post::factory([
        'slug' => 'published-post',
    ])->published()->create();

    $draftPost = Post::factory([
        'slug' => 'draft',
    ])->draft()->create();

    $response = $this->get(route('feed'));

    $response
        ->assertStatus(200)
        ->assertSee($publishedPost->title)
        ->assertDontSee($draftPost->title);
});

it('renders with the correct xml format', function () {
    Carbon::setTestNow('2021-10-13 12:00:00');

    Post::factory([
            'slug' => 'test-post-slug',
            'markdown' => 'Test post description',
        ])
        ->published()
        ->state(['published_at' => now()])
        ->create();

    $xml = $this->get(route('feed'))->getContent();

    $this->assertMatchesXmlSnapshot($xml);
});
