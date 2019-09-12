<?php

use Illuminate\Database\Seeder;

class CourseTargetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('course_targets')->delete();
        
        \DB::table('course_targets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'type' => 'requirement',
                'text' => 'Knowledge of Javascript',
                'sortOrder' => 1,
                'created_at' => '2018-12-31 01:30:16',
                'updated_at' => '2018-12-31 01:30:16',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'type' => 'requirement',
                'text' => 'Understand API design patterns',
                'sortOrder' => 2,
                'created_at' => '2018-12-31 01:30:16',
                'updated_at' => '2018-12-31 01:30:16',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'type' => 'what_to_learn',
                'text' => 'Basics of Vuejs',
                'sortOrder' => 1,
                'created_at' => '2018-12-31 01:30:16',
                'updated_at' => '2018-12-31 01:38:54',
            ),
            3 => 
            array (
                'id' => 4,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'type' => 'what_to_learn',
                'text' => 'Installing Vue CLI',
                'sortOrder' => 3,
                'created_at' => '2018-12-31 01:30:16',
                'updated_at' => '2018-12-31 01:31:08',
            ),
            4 => 
            array (
                'id' => 5,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'type' => 'what_to_learn',
                'text' => 'Loading Vue.js Packages',
                'sortOrder' => 4,
                'created_at' => '2018-12-31 01:30:16',
                'updated_at' => '2018-12-31 01:31:05',
            ),
            5 => 
            array (
                'id' => 6,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'type' => 'target_student',
                'text' => 'All web developers',
                'sortOrder' => 2,
                'created_at' => '2018-12-31 01:30:16',
                'updated_at' => '2018-12-31 01:31:35',
            ),
            6 => 
            array (
                'id' => 7,
                'uuid' => \Str::uuid(),
                'course_id' => 1,
                'type' => 'target_student',
                'text' => 'Anyone prepared to develop SPAs',
                'sortOrder' => 1,
                'created_at' => '2018-12-31 01:30:16',
                'updated_at' => '2018-12-31 01:31:35',
            ),
            7 => 
            array (
                'id' => 8,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'requirement',
                'text' => 'Knowledge of Javascript',
                'sortOrder' => 1,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            8 => 
            array (
                'id' => 9,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'requirement',
                'text' => 'HTML and CSS skills',
                'sortOrder' => 2,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            9 => 
            array (
                'id' => 10,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'what_to_learn',
                'text' => 'Learn how to install Reactjs',
                'sortOrder' => 1,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            10 => 
            array (
                'id' => 11,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'what_to_learn',
                'text' => 'How to configure assets compilation',
                'sortOrder' => 2,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            11 => 
            array (
                'id' => 12,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'what_to_learn',
                'text' => 'How routing works in React',
                'sortOrder' => 3,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            12 => 
            array (
                'id' => 13,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'what_to_learn',
                'text' => 'Creating reusable components',
                'sortOrder' => 4,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            13 => 
            array (
                'id' => 14,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'target_student',
                'text' => 'Programmers new to Reactjs',
                'sortOrder' => 1,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            14 => 
            array (
                'id' => 15,
                'uuid' => \Str::uuid(),
                'course_id' => 2,
                'type' => 'target_student',
                'text' => 'People trying to move from Vuejs to Reactjs',
                'sortOrder' => 2,
                'created_at' => '2019-04-23 12:44:21',
                'updated_at' => '2019-04-23 12:44:21',
            ),
            15 => 
            array (
                'id' => 16,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'type' => 'requirement',
                'text' => 'Basic computer skills',
                'sortOrder' => 1,
                'created_at' => '2019-04-24 14:52:54',
                'updated_at' => '2019-04-24 14:52:54',
            ),
            16 => 
            array (
                'id' => 17,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'type' => 'requirement',
                'text' => 'An open mind to learn',
                'sortOrder' => 2,
                'created_at' => '2019-04-24 14:52:54',
                'updated_at' => '2019-04-24 14:52:54',
            ),
            17 => 
            array (
                'id' => 18,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'type' => 'what_to_learn',
                'text' => 'Learn the fundamentals of business',
                'sortOrder' => 1,
                'created_at' => '2019-04-24 14:52:54',
                'updated_at' => '2019-04-24 14:52:54',
            ),
            18 => 
            array (
                'id' => 19,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'type' => 'what_to_learn',
                'text' => 'Learn how to get dropshipping suppliers',
                'sortOrder' => 2,
                'created_at' => '2019-04-24 14:52:54',
                'updated_at' => '2019-04-24 14:52:54',
            ),
            19 => 
            array (
                'id' => 20,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'type' => 'what_to_learn',
                'text' => 'Learn how to fulfill orders',
                'sortOrder' => 3,
                'created_at' => '2019-04-24 14:52:54',
                'updated_at' => '2019-04-24 14:52:54',
            ),
            20 => 
            array (
                'id' => 21,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'type' => 'target_student',
                'text' => 'Any newbies in business',
                'sortOrder' => 1,
                'created_at' => '2019-04-24 14:52:55',
                'updated_at' => '2019-04-24 14:52:55',
            ),
            21 => 
            array (
                'id' => 22,
                'uuid' => \Str::uuid(),
                'course_id' => 3,
                'type' => 'target_student',
                'text' => 'Anyone looking to start a business',
                'sortOrder' => 2,
                'created_at' => '2019-04-24 14:52:55',
                'updated_at' => '2019-04-24 14:52:55',
            ),
        ));
        
        
    }
}