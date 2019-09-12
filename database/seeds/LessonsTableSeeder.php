<?php

use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('lessons')->delete();
        
        \DB::table('lessons')->insert(array (
            0 => 
            array (
                'id' => 3,
                'uuid' => \Str::uuid(),
                'section_id' => 2,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'Installing the packages',
                'description' => 'Let\'s install some packages to get started.',
                'preview' => 0,
                'sortOrder' => 1,
                'created_at' => '2018-12-30 23:23:41',
                'updated_at' => '2018-12-30 23:23:41',
            ),
            1 => 
            array (
                'id' => 4,
                'uuid' => \Str::uuid(),
                'section_id' => 3,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'What is Vue-CLI',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 1,
                'created_at' => '2018-12-30 23:24:06',
                'updated_at' => '2018-12-30 23:24:06',
            ),
            2 => 
            array (
                'id' => 5,
                'uuid' => \Str::uuid(),
                'section_id' => 4,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'Introduction',
                'description' => NULL,
                'preview' => 1,
                'sortOrder' => 1,
                'created_at' => '2018-12-31 23:29:46',
                'updated_at' => '2019-04-23 12:44:59',
            ),
            3 => 
            array (
                'id' => 6,
                'uuid' => \Str::uuid(),
                'section_id' => 4,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'What is React.js',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 2,
                'created_at' => '2018-12-31 23:30:51',
                'updated_at' => '2019-04-23 12:44:59',
            ),
            4 => 
            array (
                'id' => 7,
                'uuid' => \Str::uuid(),
                'section_id' => 5,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'PC or Mac',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 2,
                'created_at' => '2018-12-31 23:31:56',
                'updated_at' => '2019-04-23 12:45:02',
            ),
            5 => 
            array (
                'id' => 8,
                'uuid' => \Str::uuid(),
                'section_id' => 5,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'Installing React on PC',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 1,
                'created_at' => '2018-12-31 23:32:09',
                'updated_at' => '2019-04-23 12:45:02',
            ),
            6 => 
            array (
                'id' => 9,
                'uuid' => \Str::uuid(),
                'section_id' => 5,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'Installing React on Mac',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 3,
                'created_at' => '2018-12-31 23:32:24',
                'updated_at' => '2018-12-31 23:32:24',
            ),
            7 => 
            array (
                'id' => 10,
                'uuid' => \Str::uuid(),
                'section_id' => 1,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'Instroduction',
                'description' => 'This is an intro',
                'preview' => 1,
                'sortOrder' => 1,
                'created_at' => '2019-01-05 02:48:01',
                'updated_at' => '2019-01-05 02:48:01',
            ),
            8 => 
            array (
                'id' => 11,
                'uuid' => \Str::uuid(),
                'section_id' => 1,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'A second lesson here',
                'description' => NULL,
                'preview' => 1,
                'sortOrder' => 2,
                'created_at' => '2019-01-05 02:48:55',
                'updated_at' => '2019-01-05 02:48:55',
            ),
            9 => 
            array (
                'id' => 12,
                'uuid' => \Str::uuid(),
                'section_id' => 2,
                'course_id' => 1,
                'lesson_type' => 'lecture',
                'title' => 'Lesson three video',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 2,
                'created_at' => '2019-01-05 02:51:19',
                'updated_at' => '2019-01-05 02:51:19',
            ),
            10 => 
            array (
                'id' => 13,
                'uuid' => \Str::uuid(),
                'section_id' => 6,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'Introduction',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 1,
                'created_at' => '2019-04-24 14:45:55',
                'updated_at' => '2019-04-24 14:45:55',
            ),
            11 => 
            array (
                'id' => 14,
                'uuid' => \Str::uuid(),
                'section_id' => 7,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'What really is business?',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 1,
                'created_at' => '2019-04-24 14:49:28',
                'updated_at' => '2019-04-24 14:50:59',
            ),
            12 => 
            array (
                'id' => 15,
                'uuid' => \Str::uuid(),
                'section_id' => 6,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'How this course is organized',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 3,
                'created_at' => '2019-04-24 14:49:44',
                'updated_at' => '2019-04-24 14:51:00',
            ),
            13 => 
            array (
                'id' => 16,
                'uuid' => \Str::uuid(),
                'section_id' => 7,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'Business fundamentals',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 2,
                'created_at' => '2019-04-24 14:50:02',
                'updated_at' => '2019-04-24 14:50:59',
            ),
            14 => 
            array (
                'id' => 17,
                'uuid' => \Str::uuid(),
                'section_id' => 6,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'Who this course is for',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 2,
                'created_at' => '2019-04-24 14:50:18',
                'updated_at' => '2019-04-24 14:50:59',
            ),
            15 => 
            array (
                'id' => 18,
                'uuid' => \Str::uuid(),
                'section_id' => 8,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'What is dropshipping?',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 1,
                'created_at' => '2019-04-24 14:50:30',
                'updated_at' => '2019-04-24 14:50:30',
            ),
            16 => 
            array (
                'id' => 19,
                'uuid' => \Str::uuid(),
                'section_id' => 8,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'How to dropship',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 2,
                'created_at' => '2019-04-24 14:50:49',
                'updated_at' => '2019-04-24 14:50:49',
            ),
            17 => 
            array (
                'id' => 20,
                'uuid' => \Str::uuid(),
                'section_id' => 7,
                'course_id' => 3,
                'lesson_type' => 'lecture',
                'title' => 'Get a head start as a business person',
                'description' => NULL,
                'preview' => 0,
                'sortOrder' => 3,
                'created_at' => '2019-04-24 14:51:19',
                'updated_at' => '2019-04-24 14:51:23',
            ),
        ));
        
        
    }
}