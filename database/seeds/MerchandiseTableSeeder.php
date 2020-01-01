<?php

use Illuminate\Database\Seeder;
use App\Merchandise as MerchandiseEloquent;
use Faker\Calculator as faker;

class MerchandiseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MerchandiseEloquent=MerchandiseEloquent::created([
            'status' => 'C',
            'name' => $faker
        ]);
    }
}
