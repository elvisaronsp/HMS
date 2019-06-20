<?php

use Illuminate\Database\Seeder;

class CustomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ## check
        $customUser = App\User::where('email', 'giogela97@gmail.com')->first();
        $customDoctor = App\Doctor::where('email', 'g_gelashvili4@cu.edu.ge')->first();

        if (!$customUser) {
            App\User::insert([
                'name' => 'Giorgi',
                'surname' => 'Gelashvili',
                'birthday' => '12-01-1997',
                'gender' => 'male',
                'phone' => '593757435',
                'address' => 'Gvaladze Street 20a',
                'password' => Hash::make('password'),
                'email' => 'giogela97@gmail.com',
                'email_verified_at' => now(),
                'avatar' => 'http://www.iconninja.com/files/473/667/778/headset-person-man-avatar-support-male-young-icon.png',
                'blood_type_id' => rand(1, 8)
            ]);
        }

        if (!$customDoctor) {
            App\Doctor::insert([
                'name' => 'Eddie',
                'surname' => 'Dean',
                'email' => 'g_gelashvili4@cu.edu.ge',
                'password' => Hash::make('password'),
                'about' => 'ლორემ იფსუმ',
                'specialty_id' => rand(1, 5),
                'phone' => '593757435',
                'image' => 'https://myblue.bluecrossma.com/sites/g/files/csphws1461/files/inline-images/Doctor%20Image%20Desktop.png'
            ]);
        }
    }
}
