<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Cat;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition()
    {
        static $i=0;
        $i++;
        return [
            'name'=>$this->faker->sentence(2),
            'cat_id'=>rand(1,Cat::count()),
            'brand_id'=>rand(1,Brand::count()),
            'price'=>$this->faker->numberBetween(1000,100000),
            'img'=>"products/$i.jpg",
            'model'=>$this->faker->iban(+2),

        ];
    }
}
