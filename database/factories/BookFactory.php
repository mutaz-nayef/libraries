<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use App\Models\Library;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'library_id' => Library::factory(),
            'author_id' => Author::factory(),
            'category_id' => Category::factory(),
            'ispn' => $this->faker->isbn13(),
            'title' => $this->faker->word(),
            'published_at' => $this->faker->dateTime()
        ];
    }
}
