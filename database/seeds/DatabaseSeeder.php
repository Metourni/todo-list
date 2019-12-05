<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $date = date("Y-m-d H:i:s");

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@esi.dz',
                'updated_at' => $date,
                'created_at' => $date
            ]
        ]);
    }
}
