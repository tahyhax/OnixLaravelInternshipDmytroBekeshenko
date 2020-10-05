<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $name = $this->faker->unique()->name([
//            'Gear',
//            'Clothing',
//            'Shoes',
//            'Diapering',
//            'Feeding',
//            'Bath',
//            'Toys',
//            'Nursery',
//            'Household',
//            'Grocery'
//         ]);
        $name = $this->faker->unique()->name;
        $slug = Str::slug($name, '-');
//        $file = UploadedFile::fake()->image('category.png', 600, 600);
        return [
            'name' => $name,
            'description' => $this->faker->paragraphs(4, true),
            'slug'=> $slug,
            //'cover' => $file->store('categories', ['disk' => 'public'])

        ];
    }
}
