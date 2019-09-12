<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sections')->delete();
        
        \DB::table('sections')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'title' => 'Course Introduction',
                'objective' => 'Short course objective',
                'sortOrder' => 1,
                'created_at' => '2018-12-30 20:18:59',
                'updated_at' => '2018-12-30 22:37:25',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'title' => 'Installing Vue.js and packages',
                'objective' => 'Learn how to install vuejs using the CLI',
                'sortOrder' => 2,
                'created_at' => '2018-12-30 22:34:04',
                'updated_at' => '2018-12-30 22:37:25',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'title' => 'Working with Vue-CLI',
                'objective' => 'Quick demo of Vue-CLI',
                'sortOrder' => 3,
                'created_at' => '2018-12-30 22:37:12',
                'updated_at' => '2018-12-30 22:37:25',
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'title' => 'Start here',
                'objective' => 'Short course objective',
                'sortOrder' => 1,
                'created_at' => '2018-12-31 23:29:46',
                'updated_at' => '2019-04-23 12:45:12',
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'title' => 'Course requirements',
                'objective' => 'Requirements',
                'sortOrder' => 2,
                'created_at' => '2018-12-31 23:31:29',
                'updated_at' => '2019-04-23 12:45:12',
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'title' => 'Introduction',
                'objective' => 'Course intro',
                'sortOrder' => 1,
                'created_at' => '2019-04-24 14:45:55',
                'updated_at' => '2019-04-24 14:48:04',
            ),
            6 => 
            array (
                'id' => 7,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'title' => 'The basics of business',
                'objective' => 'Learn the basics of business',
                'sortOrder' => 2,
                'created_at' => '2019-04-24 14:48:23',
                'updated_at' => '2019-04-24 14:48:23',
            ),
            7 => 
            array (
                'id' => 8,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'title' => 'All about dropshipping',
                'objective' => 'Learn about dropshipping',
                'sortOrder' => 3,
                'created_at' => '2019-04-24 14:48:46',
                'updated_at' => '2019-04-24 14:48:46',
            ),
        ));
        
        
    }
}