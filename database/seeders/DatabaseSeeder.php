<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $user = User::factory()->create([
             'name' => 'Amitav Roy',
             'email' => 'reachme@amitavroy.com',
             'password' => bcrypt('Password@123'),
         ]);

        Document::factory(5)->create([
            'creator_id' => $user->id,
        ]);

         Document::factory(10)->create();
         Document::factory(10)->inactive()->create();
    }
}
