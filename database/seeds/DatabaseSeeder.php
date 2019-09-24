<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        // $this->truncateMultiple([
        //     'cache',
        //     'jobs',
        //     'sessions',
        // ]);

        // $this->call(AuthTableSeeder::class);

        // Model::reguard();
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(CoursesTableSeeder::class);
        // $this->call(CouponsTableSeeder::class);
        // $this->call(CourseTargetsTableSeeder::class);
        // $this->call(SectionsTableSeeder::class);
        // $this->call(LessonsTableSeeder::class);
        // $this->call(ContentsTableSeeder::class);
        // $this->call(CountrySeeder::class);
        // $this->call(PeriodsTableSeeder::class);
        // $this->call(ReviewsTableSeeder::class);
        // $this->call(CurrenciesTableSeeder::class);
        // $this->call(SettingsTableSeeder::class);
        // $this->call(LanguageSeeder::class);
        $this->call(AuthTableSeeder::class);
        Model::reguard();
    }
}
