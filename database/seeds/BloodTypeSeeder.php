<?php

use Illuminate\Database\Seeder;
use App\BloodType;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ## check Blood Types in db
        $bloodTypePresence = BloodType::find(1);

        ## if does not exists record, create blood types
        if (!$bloodTypePresence) {
            BloodType::insert([
                ['title' => 'AB+'],
                ['title' => 'AB-'],
                ['title' => 'A+'],
                ['title' => 'A-'],
                ['title' => 'B+'],
                ['title' => 'B-'],
                ['title' => 'O+'],
                ['title' => 'O-'],
            ]);
        }
    }
}
