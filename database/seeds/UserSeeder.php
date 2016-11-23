<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'display_name' => 'Masood Torabi',
                'email' => $this->email(),
                'password' => bcrypt('123456'),
                'user_level'=>'1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'display_name' => 'Mohammad Mostafavi',
                'email' => $this->email(),
                'password' => bcrypt('654321'),
                'user_level'=>'1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'display_name' => 'Hamidreza karimi',
                'email' => 'hkarimi561@gmail.com',
                'password' => bcrypt('3241253724'),
                'user_level'=>'1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        ];

        foreach ($users as $u) {
            DB::table('users')->insert($u);
        }
    }

    public function email()
    {
        return str_random(10) . '@gmail.com';
    }

}
