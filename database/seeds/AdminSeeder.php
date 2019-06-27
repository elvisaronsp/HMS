<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ## try to find admin
        $admin = App\User::where('email', 'admin@gmail.com')->first();

        ## check existence
        if(!$admin) {
            App\User::insert([
                'name' => 'Admin',
                'surname' => 'Admin',
                'birthday' => '12-01-1997',
                'gender' => 'male',
                'phone' => '593757435',
                'address' => 'Gvaladze Street 20a',
                'password' => Hash::make('password'),
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'avatar' => 'http://www.iconninja.com/files/473/667/778/headset-person-man-avatar-support-male-young-icon.png',
                'blood_type_id' => rand(1, 8),
                'is_admin' => 1,
            ]);
        }
    }
}
