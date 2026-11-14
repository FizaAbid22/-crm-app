<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::firstOrCreate(
            ['email' => 'admin@example.com'],   // 1. look for a user with this email
            [                                   // 2. if none exists, create one with this data
                'name'     => 'Admin User',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );
    User::firstOrCreate(
        ['email' => 'ali@example.com'],
        ['name' => 'Ali Khan',
        'password' => Hash::make('password'), 
        'role'     => 'team_member',
        ]
    );
    User::firstOrCreate(
        ['email' => 'sara@example.com'],
        [
            'name'     => 'Sara Ahmed',
            'password' => Hash::make('password'),
            'role'     => 'team_member',
        ]

    );

    $clients = Client::factory()->count(5)->create();
    $deals = Deal::factory()->count(10)->recycle($clients)->create();
    $employees = User::where('role','team_member')->get();
    foreach($deals as $deal )
        {
             $deal->users()->attach(
                 $employees->random(rand(1, 2))->pluck('id')
             );
        }

    }
}
