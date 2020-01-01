<?php

use Illuminate\Database\Seeder;
use App\shop\Merchandise as Merchandise;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        Merchandise::unguard();

        $Merchandise = factory(Merchandise::class, 200)->create();
        $user = factory(User::class, 20)->create();

        Merchandise::reguard();
    }
}
