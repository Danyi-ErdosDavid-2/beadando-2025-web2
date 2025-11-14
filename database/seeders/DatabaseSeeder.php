<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ExamDataSeeder::class);

        User::updateOrCreate(
            ['email' => 'admin@vizsgaportal.test'],
            [
                'name' => 'Vizsga Admin',
                'password' => Hash::make('Titok123'),
                'role' => User::ROLE_ADMIN,
            ]
        );

        User::updateOrCreate(
            ['email' => 'latogato@vizsgaportal.test'],
            [
                'name' => 'Regisztrált Látogató',
                'password' => Hash::make('Titok123'),
                'role' => User::ROLE_REGISTERED,
            ]
        );

        Message::factory()->create([
            'name' => 'Teszt Felhasználó',
            'email' => 'teszt@example.com',
            'topic' => 'Kapcsolatfelvétel',
            'content' => 'Ez egy mintaüzenet, amely demonstrálja a kapcsolat űrlap működését.',
        ]);
    }
}
