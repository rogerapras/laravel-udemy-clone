<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

/**
 * Class AuthTableSeeder.
 */
class AuthTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        resolve(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->call(UserTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);

        factory(App\Models\User::class, 6)
            ->create()
            ->each(function($user) {
                $user->assignRole(config('access.users.default_role'));
                // create courses for user
                $user->authored_courses()->saveMany(factory(App\Models\Course::class, rand(5,8))->make())
                    ->each(function($course){
                        // generate What To Learn
                        $course->requirements()->saveMany(factory(App\Models\CourseTarget::class, rand(3,5))->make(['type' => 'requirement']));
                        $course->target_students()->saveMany(factory(App\Models\CourseTarget::class, rand(3,5))->make(['type' => 'target_student']));
                        $course->what_to_learn()->saveMany(factory(App\Models\CourseTarget::class, rand(3,5))->make(['type' => 'what_to_learn']));

                        // create sections and lessons for each course
                        $course->sections()->saveMany(factory(App\Models\Section::class, rand(4,6))->make())
                            ->each( function($section) use ($course) {
                                $section->lessons()->saveMany(factory(App\Models\Lesson::class, 4)->make(['course_id' => $course->id]))
                                    ->each(function($lesson){
                                        // generate video content for each video if it is youtube or video type
                                        if($lesson->content_type == 'youtube' || $lesson->content_type == 'video'){
                                            $lesson->video()->save(factory(App\Models\Video::class)->make(['lesson_type' => $lesson->content_type]));
                                        }
                                    });
                            });

                    });
            });

        //$this->enableForeignKeys();
    }
}
