<?php

use Illuminate\Database\Seeder;
use App\WorkingHour;

class WorkingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ## Check presence of records
        $workingHour = WorkingHour::find(1);

        # if does not exists insert records
        if (!$workingHour) {
            WorkingHour::insert([
                ['time' => '10:00:00'],
                ['time' => '11:00:00'],
                ['time' => '12:00:00'],
                ['time' => '13:00:00'],
                ['time' => '14:00:00'],
                ['time' => '15:00:00'],
                ['time' => '16:00:00'],
                ['time' => '17:00:00'],
                ['time' => '18:00:00'],
            ]);
        }
    }
}
