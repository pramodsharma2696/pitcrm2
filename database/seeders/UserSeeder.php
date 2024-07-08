<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $faker = Faker::create();

        // Generate dummy users
        for ($i = 0; $i < 1; $i++) {
            $name = $faker->firstName;
            $email = strtolower($name) . '@yopmail.com';
            User::create([
                'firstname' => "Sanskar",
                'lastname' => "Prabhakar",
                'role' => 'admin',
                'authorized' => '1',
                'email' => "cs@mindpooltech.com",
                'email_verified_at' => now(),
                'phone' => $faker->phoneNumber,
                'designation' => $faker->jobTitle,
                'password' =>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'otp' => null,
                'otp_verified' => 'false',
                'remember_token' => null,
            ]);
        }
        */
         User::create([
                'firstname' => "Sanskar",
                'lastname' => "Prabhakar",
                'role' => 'admin',
                'authorized' => '0',
                'email' => "cs@mindpooltech.com",
                'email_verified_at' => now(),
                'phone' => "9561979197",
                'designation' => "Company Secretary & Compliance Officer",
                'password' =>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'otp' => null,
                'otp_verified' => 'false',
                'remember_token' => null,
            ]);

    }
}