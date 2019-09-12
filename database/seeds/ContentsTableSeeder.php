<?php

use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contents')->delete();
        
        \DB::table('contents')->insert(array (
            0 => 
            array (
                'id' => 3,
                'uuid' => \Str::uuid(),
                'lesson_id' => 3,
                'content_type' => 'video',
                'video_provider' => 'youtube',
                'video_filename' => NULL,
                'video_duration' => 2,
                'video_path' => 'https://www.youtube.com/watch?v=mxK8b99iJTg',
                'video_storage' => NULL,
                'video_src' => 'embed',
                'article_body' => NULL,
                'created_at' => '2019-01-02 03:56:09',
                'updated_at' => '2019-01-02 03:56:09',
            ),
            1 => 
            array (
                'id' => 4,
                'uuid' => \Str::uuid(),
                'lesson_id' => 4,
                'content_type' => 'article',
                'video_provider' => NULL,
                'video_filename' => NULL,
                'video_duration' => 1,
                'video_path' => NULL,
                'video_storage' => NULL,
                'video_src' => NULL,
                'article_body' => '<p class="ql-align-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac orci sed sapien fringilla pretium. Etiam hendrerit commodo nulla nec pulvinar. Suspendisse consectetur dolor ut blandit placerat. Quisque vitae convallis turpis, quis interdum massa. Sed eleifend facilisis lorem, efficitur cursus mi efficitur at. Morbi ac ipsum nec mauris scelerisque scelerisque nec sit amet velit. Maecenas ultricies maximus tempus. Morbi ullamcorper, neque sed faucibus egestas, velit purus volutpat purus, quis laoreet velit purus quis augue. Aliquam bibendum nec lorem vitae semper. Sed eu rutrum velit. Pellentesque laoreet nulla at pellentesque fermentum. Suspendisse id convallis massa. Duis mattis, ex quis finibus lobortis, metus orci efficitur mi, nec rhoncus ante ante vel sem. Duis pellentesque a felis at ullamcorper.</p><p class="ql-align-justify"><br></p><p class="ql-align-justify">Proin viverra odio elementum suscipit sollicitudin. Duis pretium pulvinar eros nec bibendum. Vestibulum ante sem, venenatis ut neque id, ultrices sollicitudin ante. Pellentesque convallis neque accumsan metus posuere iaculis. Phasellus non posuere libero. Pellentesque varius arcu sagittis metus vestibulum pellentesque. Donec vitae auctor ex, ut congue tortor. In eget orci pellentesque, lacinia enim quis, efficitur dolor. Etiam cursus consectetur dignissim. Mauris risus neque, iaculis ac bibendum at, viverra sed velit. Aliquam a dignissim odio, vitae tempus dolor. Etiam interdum nisi non nunc porttitor, at ullamcorper dolor hendrerit. Mauris dignissim dolor lorem, nec condimentum risus blandit in.</p><p><br></p>',
                'created_at' => '2019-01-02 03:58:36',
                'updated_at' => '2019-01-02 03:58:36',
            ),
            2 => 
            array (
                'id' => 5,
                'uuid' => \Str::uuid(),
                'lesson_id' => 10,
                'content_type' => 'video',
                'video_provider' => NULL,
                'video_filename' => '1559235012-samplevideo-1280x720-10mb.mp4',
                'video_duration' => 0,
                'video_path' => '/uploads/videos/1559235012-samplevideo-1280x720-10mb.mp4',
                'video_storage' => 'local',
                'video_src' => 'upload',
                'article_body' => NULL,
                'created_at' => '2019-01-05 02:48:37',
                'updated_at' => '2019-01-05 02:48:37',
            ),
            3 => 
            array (
                'id' => 6,
                'uuid' => \Str::uuid(),
                'lesson_id' => 11,
                'content_type' => 'video',
                'video_provider' => NULL,
                'video_filename' => '1559235012-samplevideo-1280x720-10mb.mp4',
                'video_duration' => 1,
                'video_path' => '/uploads/videos/1559235012-samplevideo-1280x720-10mb.mp4',
                'video_storage' => 'local',
                'video_src' => 'upload',
                'article_body' => NULL,
                'created_at' => '2019-01-05 02:50:27',
                'updated_at' => '2019-01-05 02:50:27',
            ),
            4 => 
            array (
                'id' => 7,
                'uuid' => \Str::uuid(),
                'lesson_id' => 12,
                'content_type' => 'video',
                'video_provider' => NULL,
                'video_filename' => '1559235012-samplevideo-1280x720-10mb.mp4',
                'video_duration' => 0,
                'video_path' => '/uploads/videos/1559235012-samplevideo-1280x720-10mb.mp4',
                'video_storage' => 'local',
                'video_src' => 'upload',
                'article_body' => NULL,
                'created_at' => '2019-01-05 02:51:47',
                'updated_at' => '2019-01-05 02:51:47',
            ),
            5 => 
            array (
                'id' => 8,
                'uuid' => \Str::uuid(),
                'lesson_id' => 17,
                'content_type' => 'article',
                'video_provider' => NULL,
                'video_filename' => NULL,
                'video_duration' => 0,
                'video_path' => NULL,
                'video_storage' => NULL,
                'video_src' => NULL,
            'article_body' => '<p><span style="color: rgb(0, 0, 0);">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ante elit, commodo eget diam vitae, scelerisque venenatis libero. Sed vestibulum pulvinar dignissim. Nunc ut fermentum libero. Donec dapibus dapibus turpis, vitae mollis massa scelerisque a. Donec sagittis dolor lobortis tincidunt vulputate. Nulla vehicula tellus sem, eget egestas sapien tempor nec. Ut eget ligula lacus. Mauris dui sapien, facilisis vel eros sed, luctus consequat dui. Donec iaculis nisl cursus, posuere quam et, euismod tortor. Duis scelerisque a sem non efficitur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed purus velit. edited</span></p>',
                'created_at' => '2019-04-24 14:54:00',
                'updated_at' => '2019-04-24 14:54:40',
            ),
            6 => 
            array (
                'id' => 9,
                'uuid' => \Str::uuid(),
                'lesson_id' => 13,
                'content_type' => 'video',
                'video_provider' => 'youtube',
                'video_filename' => NULL,
                'video_duration' => 2,
                'video_path' => 'https://www.youtube.com/watch?v=9ylj9NR0Lcg',
                'video_storage' => NULL,
                'video_src' => 'embed',
                'article_body' => NULL,
                'created_at' => '2019-04-24 15:14:37',
                'updated_at' => '2019-04-24 15:14:37',
            ),
        ));
        
        
    }
}