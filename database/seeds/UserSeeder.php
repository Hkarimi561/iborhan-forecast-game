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
                'display_name' => 'Reza rfr',
                'first_name' => 'Reza',
                'last_name' => 'Faqihi',
                'national_code' => '123654789',
                'city_id' => '87',
                'avatar' => asset('images/users/photo_2016-12-10_14-58-47.jpg'),
                'email' =>'reza@faqihi.com',
                'password' => bcrypt('123456'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'display_name' => 'Hamidreza',
                'first_name' => 'Hamid ',
                'last_name' => 'Karimi',
                'national_code' => '123654789',
                'city_id' => '87',
                'avatar' => asset('images/users/photo_2016-12-10_15-00-14.jpg'),
                'email' => 'hkarimi561@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],

        ];

        foreach ($users as $u) {
            DB::table('users')->insert($u);
        }

        $admins = [
            [
                'name' => 'Reza rfr',
                'email' => 'faqihi@reza.com',
                'password' => bcrypt('123456'),

                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],
            [
                'name' => 'Hamidreza',
                'email' => 'hkarimi562@gmail.com',
                'password' => bcrypt('123456'),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ],

        ];

        foreach ($admins as $u) {
            DB::table('admins')->insert($u);
        }
    }

    public function email()
    {
        return str_random(10) . '@gmail.com';
    }

}
