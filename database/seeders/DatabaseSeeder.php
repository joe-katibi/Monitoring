<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            AssignRoleSeeder::class,
            UserTableSeeder::class,
            ServicesTableSeeder::class,
            CountriesTableSeeder::class,
            CategoriesTableSeeder::class,
            PositionsTableSeeder::class,
            AnswersTableSeeder::class,
            IssueGeneralTableSeeder::class,
            CallRatingTableSeeder::class,
            ReportTypeSeeder::class,
            TicketStatusSeeders::class,
        ]);
    }
}
