<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

/**
 * Class UsersTableSeeder
 *
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Factory::create();
        $password = $faker->password;

        $user = [
            'email'    => $faker->email,
            'password' => bcrypt($password),
        ];

        User::factory()->create($user);

        $user = User::where('email', $user['email'])->first();
        if ($user) {
            // By pass the register and login methods
            $token = $user->createToken(config('auth.sanctum_token_name'))->plainTextToken;
            $this->command->comment('User created with email address: ' . $user['email']);
            $this->command->comment('User created with password: ' . $password);
            $this->command->comment('User api auth header: Bearer ' . $token);
        }
    }
}
