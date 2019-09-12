<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('coupons')->delete();
        
        \DB::table('coupons')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'code' => 'CODECODE',
                'percent' => 80,
                'quantity' => 2,
                'expires' => '2019-01-31',
                'active' => 1,
                'sitewide' => 0,
                'created_at' => '2018-12-31 01:01:36',
                'updated_at' => '2018-12-31 01:02:51',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'code' => 'CODECODE-FREE',
                'percent' => 100,
                'quantity' => 2,
                'expires' => NULL,
                'active' => 1,
                'sitewide' => 0,
                'created_at' => '2018-12-31 01:02:40',
                'updated_at' => '2018-12-31 01:02:40',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'code' => 'EASTER-PROMO',
                'percent' => 50,
                'quantity' => 100,
                'expires' => NULL,
                'active' => 1,
                'sitewide' => 0,
                'created_at' => '2019-04-23 12:46:06',
                'updated_at' => '2019-04-23 12:46:06',
            ),
        ));
        
        
    }
}