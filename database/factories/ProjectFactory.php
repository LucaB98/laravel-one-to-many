<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Arr;
use App\Models\Type;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        Storage::makeDirectory('project_images');

        $title = fake()->text(20);
        $slug = Str::slug($title);
        $img = fake()->image(null, 640, 480);
        \Log::debug(var_export($img, true));
        $img_url = Storage::putFileAs('project_images', $img, "$slug.png");

        $type_ids = Type::pluck('id')->toArray(); //pluck trasforma l'array di oggetti in un array associativo
        $type_ids[] = null; //aggiungo all'array il null nel caso non avessi nessun tipo selezionato

        return [
            'title' => $title,
            'slug' => $slug,
            'type_id' => Arr::random($type_ids),
            'description' => fake()->paragraphs(10, true),//se lascio false fa un array
            'image' => $img_url,
            'is_completed' => fake()->boolean(),
        ];
    }
}
