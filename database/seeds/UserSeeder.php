<?php

use Illuminate\Database\Seeder;
use App\Models\UserAccount;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,20)
            ->create()
            ->each(function($user){
                $useraccount = new UserAccount();
                $useraccount->create([
                    'number_account' => rand(10000000,99999999),
                    'agency' => 1303,
                    'balance' => 100,
                    'user_id' => $user->id
                ]);
            });
    }
}
