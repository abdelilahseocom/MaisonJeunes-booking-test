<?php

namespace Database\Seeders;
use App\City;
use App\YouthCenter;
use Illuminate\Database\Seeder;

class YouthCenterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $youthCenters = collect([
            ["name"=>"Maison de jeune 1","address"=>null],
            ["name"=>"Maison de jeune 2","address"=>null],
            ["name"=>"Maison de jeune 3","address"=>null],

        ]);

        $youthCenters->each(function($item){
            $item["city_id"]=City::inRandomOrder()->first()->id;
            YouthCenter::create($item);
        });
    }
}