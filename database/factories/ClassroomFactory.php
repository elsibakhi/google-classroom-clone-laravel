<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'subject' => fake()->text(10),
            'room' => fake()->text(10),
            'section' => fake()->text(10),
            'code' => fake()->unique()->text(8),

            'status' => "active",
            'user_id' => 7,
            'created_at' => now(),
            'updated_at' => now(),


        ];
    }



//     public function userID($id): Factory
// {
//     return $this->state(function (array $attributes) use ($id) {
//         return [
//             'user_id' => $id,
//         ];
//     });
// }


public function defaultImage(): Factory
{
    return $this->state(function (array $attributes)  {
        return [
              'cover_img_path' => "/covers/1.jpg",
        ];
    });
}
}
