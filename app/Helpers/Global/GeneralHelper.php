<?php
use App\Models\Lesson;
if (! function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function app_name()
    {
        return config('app.name');
    }
}

if (! function_exists('gravatar')) {
    /**
     * Access the gravatar helper.
     */
    function gravatar()
    {
        return app('gravatar');
    }
}

if (! function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function home_route()
    {
        if (auth()->check()) {
            if (auth()->user()->can('view backend')) {
                return 'admin.dashboard';
            }

            return 'frontend.index';
        }

        return 'frontend.index';
    }

    
}
if( ! function_exists('format_currency')){
    
    function format_currency($value)
    {
        $value = (string)$value;
        $default_currency = setting('site.site_currency') ?: 'USD';
        $currency = \App\Models\Currency::where('code', setting('site.site_currency'))->first();

        if($currency->space_between){
            if($currency->symbol_position=='left') return $currency->symbol . ' ' . $value;
            return str($value) . ' ' . $currency->symbol_position; 
        } else {
            if($currency->symbol_position=='left') return $currency->symbol . $value;
            return str($value) . $currency->symbol; 
        }
    }
    
}

if( ! function_exists('artisan_migrate')){
    function artisan_migrate() 
    {
        \Artisan::call('migrate', ["--force"=> true]);
    }
}

if( ! function_exists('artisan_clear')){
    function artisan_clear() {
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
    }
}

if( ! function_exists('number_to_percentage')){
    function number_to_percentage($number, $precision = 2)
    {
        if (!is_numeric($number)) {
            return $number;
        }
        return sprintf("%.{$precision}f%%", $number * 100);
    }
}

if( ! function_exists('app_version')){
    function app_version()
    {
        return trim(file_get_contents(base_path('VERSION')));
    }
}

/**
 * Check if the app is installed
 *
 * @return boolean
 */
function installed()
{
    return \Storage::disk('installPath')->exists('INSTALL/site_installed.key');
    //return file_exists(storage_path('app/installed'));
}

if( ! function_exists('request_ip')){

    function request_ip()
    {
        return request()->getClientIp();
    }
}

if (! function_exists('camelcase_to_word')) {
    /**
     * @param $str
     *
     * @return string
     */
    function camelcase_to_word($str)
    {
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}


if( !function_exists('convert_minutes_to_duration'))
{
    function convert_minutes_to_duration($total_minutes, $format = '%02d:%02d:%02d')
    {
        if ($total_minutes < 0.0 || ! $total_minutes) {
            return '00:00:00';
        }
        
        $hours = floor($total_minutes / 60);
        $minutes = ($total_minutes % 60);
        $seconds = ($total_minutes*60) % 60;
        
        return sprintf($format, $hours, $minutes, $seconds);
    }
    
}

if (! function_exists('get_first_lesson')) {
    function get_first_lesson($course){
        $first_lesson = Lesson::where('lessons.course_id', $course->id)
            ->join('sections', 'sections.id', 'lessons.section_id')
            ->orderBy('sections.sortOrder')
            ->orderBy('lessons.sortOrder')
            ->first();
        
        if(auth()->check()){
            $lessons = $course->lessons()->pluck('id');
            $last_watched = auth()->user()->completions()->latest()
                                ->whereIn('lessons.id', $lessons)->first();
                                
            if(!is_null($last_watched)){
                $first_lesson = $last_watched;
            }
        }
        
        return $first_lesson;
    }
}