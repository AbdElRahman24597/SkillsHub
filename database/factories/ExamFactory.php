<?php

namespace Database\Factories;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => [
                'en' => $this->faker->word(),
                'ar' => $this->faker->word(),
            ],
            'description' => [
                'en' => $this->faker->text(5000),
                'ar' => $this->faker->text(5000),
            ],
            'image' => 'exams/default.jpg',
            'questions_number' => 15,
            'difficulty' => $this->faker->numberBetween(1, 5),
            'duration' => $this->faker->numberBetween(1, 3) * 30,
        ];
    }
}
