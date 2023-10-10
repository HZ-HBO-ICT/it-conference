<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presentation>
 */
class PresentationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $file = UploadedFile::fake()->create($this->faker->word . '.pdf', 100);
        $path = Storage::disk('local')->putFile('test-data', $file);

        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'max_participants' => $this->faker->numberBetween(1, 50),
            'type' => $this->faker->boolean ? 'lecture' : 'workshop',
            'file_path' => $path
        ];
    }
}
