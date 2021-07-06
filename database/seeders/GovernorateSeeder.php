<?php

namespace Database\Seeders;

use App\Models\Governorates;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Governorates::create([
            'name'=>'Cairo',
            'shipping_cost'=>30
        ]);


        Governorates::create([
            'name'=>'Giza',
            'shipping_cost'=>30
        ]);


        Governorates::create([
            'name'=>'Alexandria',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'Aswan',
            'shipping_cost'=>80
        ]);


        Governorates::create([
            'name'=>'Asyut',
            'shipping_cost'=>80
        ]);


        Governorates::create([
            'name'=>'Beheira',
            'shipping_cost'=>40
        ]);


        Governorates::create([
            'name'=>'Beni Suef',
            'shipping_cost'=>80
        ]);


        Governorates::create([
            'name'=>'Dakahlia',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'Damietta',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'Faiyum',
            'shipping_cost'=>70
        ]);


        Governorates::create([
            'name'=>'Gharbia',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'Ismailia',
            'shipping_cost'=>60
        ]);


        Governorates::create([
            'name'=>'Kafr El Sheikh',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'Luxor',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'Matruh',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'Minya',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'Monufia',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'New Valley',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'North Sinai',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'Port Said',
            'shipping_cost'=>80
        ]);


        Governorates::create([
            'name'=>'Qalyubia',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'Qena',
            'shipping_cost'=>80
        ]);


        Governorates::create([
            'name'=>'Red Sea',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'Sharqia',
            'shipping_cost'=>50
        ]);


        Governorates::create([
            'name'=>'Sohag',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'South Sinai',
            'shipping_cost'=>100
        ]);


        Governorates::create([
            'name'=>'Suez',
            'shipping_cost'=>80
        ]);



    }
}
