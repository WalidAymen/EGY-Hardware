<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{

    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' =>Hash::make($this->faker->randomNumber(5)),
            'phone'=>$this->faker->phoneNumber,
            'address'=>$this->faker->address,
            'city'=>$this->faker->city,
            'country'=>$this->faker->country,
        ];
    }
}
