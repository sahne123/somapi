<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $User = new User;
        $User->name = 'admin';
        $User->api_token = str_random(60);
        $User->save();
    }
}
