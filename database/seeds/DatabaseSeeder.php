<?php

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
        ## independent seeds
        factory(App\Specialty::class, 5)->create();

        $this->call([
            BloodTypeSeeder::class,
            WorkingHourSeeder::class,
            CustomUserSeeder::class
        ]);

        # dependent seeds
        factory(App\User::class, 5)->create();
        factory(App\Doctor::class, 5)->create();
    }
}
