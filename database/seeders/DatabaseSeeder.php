<?php

namespace Database\Seeders;

use App\Helpers\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'pab362002@yahoo.com',
            'name' => 'Pablo Ruiz',
            'role' => UserRoles::ADMIN,
            'country' => 'Pakistan',
            'timezone' => 'Asia/Karachi',
        ]);

        $this->call([
            SpecialismCategorySeeder::class,
            SpecialismSeeder::class,
            CountrySeeder::class,
            LanguageSeeder::class,
        ]);
    }
}
