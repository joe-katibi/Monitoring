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

        $this->call([
            PermissionsSeeder::class,
            RolesSeeder::class,
            UserTableSeeder::class,
            AssignRoleSeeder::class,
            DepartmentSeeder::class,
            ServicesTableSeeder::class,
            CountriesTableSeeder::class,
            CategoriesTableSeeder::class,
            PositionsTableSeeder::class,
            AnswersTableSeeder::class,
            IssueGeneralTableSeeder::class,
            CallRatingTableSeeder::class,
            ReportTypeSeeder::class,
            TicketStatusSeeders::class,
            SummarySeeder::class,
            CounterSeeder::class,
            StatusesSeeder::class,
        ]);
    }
}
