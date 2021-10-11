<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(3, true);
        $status = $this->faker->randomElement(['draft', 'published']);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'html' => $this->faker->paragraph(),
            'status' => $status,
            'type' => 'post',
            'author_id' => User::factory(),
            'published_at' => $status === 'published' ? $this->faker->dateTimeBetween('-1 month') : NULL,
        ];
    }

    public function published()
    {
        return $this->state([
            'status' =>  'published',
            'published_at' => $this->faker->dateTimeBetween('-1 month'),
        ]);
    }

    public function draft()
    {
        return $this->state([
            'status' =>  'draft',
        ]);
    }
}
