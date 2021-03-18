<?php

namespace Database\Factories;

use App\Models\Tablecontent;
use Illuminate\Database\Eloquent\Factories\Factory;

class TablecontentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tablecontent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'lastname' => $this->faker->lastName(),
          'firstname' => $this->faker->firstName(),
          'birthday' => $this->faker->dateTimeBetween('-60years', '-21years'),
          'avatar' => $this->faker->imageurl(60, 60, 'animals', true),
          'email' => $this->faker->unique()->safeEmail,
          'homepage' => $this->faker->url(),
          'wage' => $this->faker->randomFloat(2, 2000, 15000),
          'hasparking' => $this->faker->numberBetween(0, 1)
        ];
    }
}
/*
$table->string('lastname');
$table->string('firstname');
$table->date('birthday');
$table->string('avatar');
$table->string('email');
$table->string('homepage');
$table->unsignedDecimal('wage', 8, 2);
$table->boolean('hasparking');
*/
