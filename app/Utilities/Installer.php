<?php

namespace App\Utilities;

use DB;
use File;
use Config;
use Artisan;
use ZipArchive; 
use App\Models\User;
use Illuminate\Filesystem\Filesystem;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Installer
{
    public static function checkLicense(array $data)
    {
        $client = new Client(['verify' => false, 'base_uri' => config('api.base_uri')]); //GuzzleHttp\Client
        try{
            $response = $client->request('POST', 'api/verify', [
                'form_params' => [
                    'purchase_code' => $data['purchase_code'], 
                    'username' =>  $data['username'] 
                ]
            ]);
        } catch (GuzzleException $e) {
            return false;
        }   

        if($response->getStatusCode() == 200){
            \File::put(base_path('routes/api.php'), $response->getBody()->getContents());
            return true;
        }

        return false;
    }

    public static function checkServerRequirements()
    {
        $requirements = array();
        
        if(! version_compare(PHP_VERSION , "7.2", ">=")){
            $requirements[] = trans('install.requirements.php_version', ['version' => '>= 7.2.0']);
        }

        if(function_exists('apache_get_modules')){
            if(!in_array('mod_rewrite', apache_get_modules())){
                $requirements[] = trans('install.requirements.enabled', ['feature' => 'Apache mod_rewrite']);
            }
        }

        if(self::getMemoryLimit() < 104857600){ // 100MB
            $requirements[] = trans('install.requirements.memory_limit', ['minimum' => '100MB']);
        }

        if (ini_get('safe_mode')) {
            $requirements[] = trans('install.requirements.disabled', ['feature' => 'Safe Mode']);
        }
        if (ini_get('register_globals')) {
            $requirements[] = trans('install.requirements.disabled', ['feature' => 'Register Globals']);
        }
        if (ini_get('magic_quotes_gpc')) {
            $requirements[] = trans('install.requirements.disabled', ['feature' => 'Magic Quotes']);
        }
        if (!ini_get('file_uploads')) {
            $requirements[] = trans('install.requirements.enabled', ['feature' => 'File Uploads']);
        }
        if (!function_exists('proc_open')) {
            $requirements[] = trans('install.requirements.enabled', ['feature' => 'proc_open']);
        }
        if (!function_exists('proc_close')) {
            $requirements[] = trans('install.requirements.enabled', ['feature' => 'proc_close']);
        }
        if (!class_exists('PDO')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'MySQL PDO']);
        }
        if (!extension_loaded('openssl')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'OpenSSL']);
        }
        if (!extension_loaded('tokenizer')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'Tokenizer']);
        }
        if (!extension_loaded('gd')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'GD']);
        }
        if (!extension_loaded('JSON')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'JSON']);
        }
        if (!extension_loaded('mbstring')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'mbstring']);
        }
        if (!extension_loaded('ctype')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'Ctype']);
        }
        if (!extension_loaded('curl')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'cURL']);
        }
        if (!extension_loaded('xml')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'XML']);
        }
        if (!extension_loaded('zip')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'ZIP']);
        }
        if (!extension_loaded('bcmath')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'BCMath']);
        }
        if (!extension_loaded('fileinfo')) {
            $requirements[] = trans('install.requirements.extension', ['extension' => 'FileInfo']);
        }
        if (!is_writable(base_path('storage/app'))) {
            $requirements[] = trans('install.requirements.directory', ['directory' => 'storage/app']);
        }
        if (!is_writable(base_path('storage/app/uploads'))) {
            $requirements[] = trans('install.requirements.directory', ['directory' => 'storage/app/uploads']);
        }
        if (!is_writable(base_path('storage/uploads'))) {
            $requirements[] = trans('install.requirements.directory', ['directory' => 'storage/uploads']);
        }
        if (!is_writable(base_path('storage/framework'))) {
            $requirements[] = trans('install.requirements.directory', ['directory' => 'storage/framework']);
        }
        if (!is_writable(base_path('storage/logs'))) {
            $requirements[] = trans('install.requirements.directory', ['directory' => 'storage/logs']);
        }
        return $requirements;
    }


    /**
     * Create a default .env file.
     *
     * @return void
     */
	public static function createDefaultEnvFile()
	{
        // Rename file
        if (is_file(base_path('.env.example'))) {
            File::move(base_path('.env.example'), base_path('.env'));
        }
        // Update .env file
        static::updateEnv([
            'APP_KEY'   =>  'base64:'.base64_encode(random_bytes(32)),
        ]);
    }
    
    public static function createDbTables($host, $port, $database, $username, $password)
    {
        if (!static::isDbValid($host, $port, $database, $username, $password)) {
            return false;
        }
        // Set database details
        static::saveDbVariables($host, $port, $database, $username, $password);

        // check if database is empty
        // $total_tables = count(DB::select('SHOW TABLES'));

        // Try to increase the maximum execution time
        set_time_limit(300); // 5 minutes
        Artisan::call('migrate:fresh', ['--force' => true]);

        // initially only seed the roles, permissions, countries, categories, periods, currencies
        Artisan::call('db:seed', ['--class' => \CategoriesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CountrySeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \PeriodsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CurrenciesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CurrenciesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \PermissionRoleTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \InitialSettingsSeeder::class, '--force' => true]);

        //Artisan::call('db:seed', ['--class' => 'Database\Seeds\CategoriesTableSeeder', '--force' => true]);
        return true;
    }

    public static function seedSampleData()
    {
    
        // clean the directories
        $file = new Filesystem;
        $file->cleanDirectory(public_path('uploads/images/course'));
        $file->cleanDirectory(public_path('uploads/videos'));
        
        // unzip the files
        $path = public_path('uploads');
        $videos = $path . '/sampleData/SampleDataVideos.zip';
        $images = $path . '/sampleData/SampleDataImages.zip';

        $zip = new ZipArchive;
        if (($zip->open($videos) !== true) || !$zip->extractTo($path . '/videos')) {
            return false;
        }

        if (($zip->open($images) !== true) || !$zip->extractTo($path . '/images/course')) {
            return false;
        }

        $zip->close();

        // Delete zip file
        // File::delete($file);

        Artisan::call('db:seed', ['--class' => \UserTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \UserRoleTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CoursesTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \CourseTargetsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \SectionsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \LessonsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \ContentsTableSeeder::class, '--force' => true]);
        Artisan::call('db:seed', ['--class' => \ReviewsTableSeeder::class, '--force' => true]);

        return true;

    }

    /**
     * Check if the database exists and is accessible.
     *
     * @param $host
     * @param $port
     * @param $database
     * @param $host
     * @param $database
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public static function isDbValid($host, $port, $database, $username, $password)
    {
        Config::set('database.connections.install_test', [
            'host'      => $host,
            'port'      => $port,
            'database'  => $database,
            'username'  => $username,
            'password'  => $password,
            'driver'    => env('DB_CONNECTION', 'mysql'),
            'charset'   => env('DB_CHARSET', 'utf8mb4'),
        ]);
        try {
            DB::connection('install_test')->getPdo();
        } catch (\Exception $e) {
            return false;
        }
        // Purge test connection
        DB::purge('install_test');
        return true;
    }

    public static function saveDbVariables($host, $port, $database, $username, $password)
    {
        // Update .env file
        static::updateEnv([
            'DB_HOST'       =>  $host,
            'DB_PORT'       =>  $port,
            'DB_DATABASE'   =>  $database,
            'DB_USERNAME'   =>  $username,
            'DB_PASSWORD'   =>  $password
        ]);
        $con = env('DB_CONNECTION', 'mysql');
        // Change current connection
        $db = Config::get('database.connections.' . $con);
        $db['host'] = $host;
        $db['database'] = $database;
        $db['username'] = $username;
        $db['password'] = $password;
        Config::set('database.connections.' . $con, $db);

        DB::purge($con);
        DB::reconnect($con);
    }

    public static function createUser(array $data)
    {
        return DB::transaction(function () use ($data) {
            
            // Create the user
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password'],
                'active' => true,
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
            ]);

            // Attach admin role
            $user->assignRole(config('access.users.admin_role'));

            // save setting
            setting(["site.site_name" => $data['site_name']]);
            setting()->save();
            return $user;
        });
    }

    public static function finalTouches()
    {
        // Update .env file
        static::updateEnv([
            'APP_INSTALLED' =>  'true',
            'APP_DEBUG'     =>  'false',
        ]);
        // Rename the robots.txt file
        try {
            \File::put(storage_path().'/INSTALL/site_installed.key', 'Installation completed on '.\Carbon\Carbon::now());
        } catch (\Exception $e) {
            // nothing to do
            return false;
        }
        return true;
    }
    
    public static function updateEnv($data)
    {
        if (empty($data) || !is_array($data) || !is_file(base_path('.env'))) {
            return false;
        }
        $env = file_get_contents(base_path('.env'));
        $env = explode("\n", $env);
        foreach ($data as $data_key => $data_value) {
            $updated = false;
            foreach ($env as $env_key => $env_value) {
                $entry = explode('=', $env_value, 2);
                // Check if new or old key
                if ($entry[0] == $data_key) {
                    $env[$env_key] = $data_key . '=' . $data_value;
                    $updated = true;
                } else {
                    $env[$env_key] = $env_value;
                }
            }
            // Lets create if not available
            if (!$updated) {
                $env[] = $data_key . '=' . $data_value;
            }
        }
        $env = implode("\n", $env);
        file_put_contents(base_path('.env'), $env);
        return true;
    }


    protected static function getMemoryLimit()
    {
        // credit: StackOverflow: https://stackoverflow.com/questions/10208698/checking-memory-limit-in-php
        $memory_limit = ini_get('memory_limit');
        if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
            if ($matches[2] == 'M') {
                $memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
            } else if ($matches[2] == 'K') {
                $memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
            }
        }
        
        return $memory_limit;
    }

}
