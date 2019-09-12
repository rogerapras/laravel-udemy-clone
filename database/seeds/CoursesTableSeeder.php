<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('courses')->delete();
        
        \DB::table('courses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => \Str::uuid(),
                'user_id' => 1,
                'category_id' => 2,
                'title' => 'Building SPAs with Vue.js',
                'subtitle' => 'Learn how to build Single-Page Applications with Vue.js',
                'slug' => 'building-spas-with-vuejs',
                'description' => '<p class="ql-align-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla hendrerit, dui ut dapibus posuere, mi neque laoreet ipsum, eget ultrices ex magna ac felis. Nam vitae condimentum urna, et ullamcorper elit. Morbi sagittis nulla facilisis sapien suscipit faucibus. Sed euismod, ex id fringilla aliquam, velit lorem aliquam risus, eu lobortis turpis diam quis risus. Phasellus bibendum aliquam gravida. Fusce eget tellus massa. Morbi fermentum malesuada libero vitae bibendum. Sed quis augue ac libero semper tincidunt. Integer consectetur tristique neque, lacinia molestie lectus blandit eu. Praesent tempor magna vitae sagittis sodales. Mauris sed dignissim lorem, scelerisque convallis massa. Praesent vitae nunc imperdiet, venenatis sapien id, lacinia orci. Vivamus elit ante, accumsan et vehicula et, ultrices ultrices tellus. Aliquam ut odio vel mi placerat aliquet. Duis sit amet lacinia nibh, eu pellentesque mi.</p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Suspendisse nec dolor quis mi commodo mollis. Vivamus placerat justo non orci pretium, sed tincidunt libero iaculis. Phasellus vitae orci ut tellus elementum facilisis. Cras tincidunt consequat leo sed egestas. Nulla vel maximus orci, sit amet viverra quam. In at dapibus ipsum, eu posuere lorem. Fusce ipsum lorem, sagittis eget purus feugiat, viverra imperdiet nunc. Cras condimentum vestibulum orci, id gravida nisl maximus id. Nam diam ipsum, mattis non pretium ac, feugiat mattis tortor. Aliquam scelerisque tristique tristique. Donec semper rutrum lectus nec mollis. Vestibulum ut purus a lectus consectetur mollis ut id nulla. Phasellus mollis odio vel metus lacinia, quis imperdiet libero gravida. Praesent est felis, venenatis id enim vel, consectetur finibus mi.</p><p><br></p>',
                'language' => 'english',
                'image' => '15c293bc14e709.png',
                'level' => 'all',
                'featured' => 0,
                'price' => '19.99',
                'published' => 1,
                'approved' => 1,
                'created_at' => '2018-12-30 20:18:59',
                'updated_at' => '2018-12-31 00:05:58',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => \Str::uuid(),
                'user_id' => 1,
                'category_id' => 2,
                'title' => 'React.js for beginners',
                'subtitle' => 'Beginners\' guide to React.js',
                'slug' => 'reactjs-for-beginners',
            'description' => '<p><span style="color: rgb(0, 0, 0);">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eu ante nec mauris pulvinar scelerisque quis quis elit. Vivamus erat ante, ornare eget sapien in, accumsan pulvinar urna. Nullam ex lacus, tincidunt sed aliquam id, suscipit in justo. Ut dapibus odio ante, et condimentum purus imperdiet et. Phasellus a enim sagittis, posuere urna vitae, egestas elit. Fusce eu faucibus mauris. Nullam egestas fermentum mattis. Nullam malesuada leo in tellus semper, eu viverra dolor aliquam. Aenean vitae sapien sit amet nulla pulvinar hendrerit. Morbi vehicula neque ut facilisis blandit. Duis finibus, tellus sit amet porttitor mollis, dolor metus maximus purus, ac fringilla magna libero at tortor. Proin eleifend elementum ante, sed dapibus eros. Curabitur et augue vitae odio malesuada vestibulum id sit amet ipsum.</span></p>',
                'language' => 'french',
                'image' => NULL,
                'level' => 'all',
                'featured' => 0,
                'price' => '29.99',
                'published' => 0,
                'approved' => 0,
                'created_at' => '2018-12-31 23:29:46',
                'updated_at' => '2019-04-23 12:45:35',
            ),
            2 => 
            array (
                'id' => 3,
                'uuid' => \Str::uuid(),
                'user_id' => 2,
                'category_id' => 6,
                'title' => 'Business crash course',
                'subtitle' => 'Learn the tricks of business',
                'slug' => 'business-crash-course',
                'uuid' => '15561171552',
            'description' => '<p><span style="color: rgb(0, 0, 0);">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ante elit, commodo eget diam vitae, scelerisque venenatis libero. Sed vestibulum pulvinar dignissim. Nunc ut fermentum libero. Donec dapibus dapibus turpis, vitae mollis massa scelerisque a. Donec sagittis dolor lobortis tincidunt vulputate. Nulla vehicula tellus sem, eget egestas sapien tempor nec. Ut eget ligula lacus. Mauris dui sapien, facilisis vel eros sed, luctus consequat dui. Donec iaculis nisl cursus, posuere quam et, euismod tortor. Duis scelerisque a sem non efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed purus velit.</span></p><p><br></p><p><span style="color: rgb(0, 0, 0);"><span class="ql-cursor">﻿</span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ante elit, commodo eget diam vitae, scelerisque venenatis libero. Sed vestibulum pulvinar dignissim. Nunc ut fermentum libero. Donec dapibus dapibus turpis, vitae mollis massa scelerisque a. Donec sagittis dolor lobortis tincidunt vulputate. Nulla vehicula tellus sem, eget egestas sapien tempor nec. Ut eget ligula lacus. Mauris dui sapien, facilisis vel eros sed, luctus consequat dui. Donec iaculis nisl cursus, posuere quam et, euismod tortor. Duis scelerisque a sem non efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed purus velit.</span></p>',
                'language' => 'english',
                'image' => NULL,
                'level' => 'beginner',
                'featured' => 0,
                'price' => '0.00',
                'published' => 0,
                'approved' => 0,
                'created_at' => '2019-04-24 14:45:55',
                'updated_at' => '2019-04-24 14:46:51',
            ),
        ));
        
        
    }
}