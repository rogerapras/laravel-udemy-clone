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

class Updater
{
    private static $item = 'educore';
    private static $latestUrl = 'api/latest';
    private static $downloadUrl = 'api/get_latest';

    public static function checkLatestVersion()
    {
        $client = new Client(['verify' => false, 'base_uri' => config('api.base_uri')]); 
        try{
            $response = $client->request('GET', self::$latestUrl, ['query' => ['item' => self::$item]]);
        } catch (GuzzleException $e) {
            return ['success' => false];
        }

        if($response->getStatusCode() == 200){
            $version = json_decode($response->getBody()->getContents());
            $update_required = version_compare(app_version(), $version->version_number, '<');
            return ['success' => true, 'update_required' => $update_required, 'version' => $version->version_number];
        }
        return ['success' => false];
    }

    public static function getLatestVersion()
    {


        set_time_limit(600); // 10 minutes
        $client = new Client(['verify' => false, 'base_uri' => config('api.base_uri')]);
        try {
            $release = $client->request('GET', self::$latestUrl, ['query' => ['item' => self::$item]]);
            $version = json_decode($release->getBody()->getContents());
            $file_path = storage_path('updates/downloads/'.$version->filename);
            // get the zip file
            $response = $client->request('GET', self::$downloadUrl, [  
                'query' => [
                    'purchase_code' => setting('site.purchase_code'),
                    'username' => setting('site.envato_username'),
                    'item' => 'educore'
                ],
                'sink' => $file_path
            ]);
            
            // unzip the downloaded file to temp directory
            $temp_path = storage_path('updates/tmp');
            $zip = new ZipArchive();
            if (($zip->open($file_path) !== true) || !$zip->extractTo($temp_path)) {
                return [
                    'success' => false,
                    'error' => 'Unable to unzip'
                ];
            }
            $zip->close();
            File::delete($file_path);

            // copy the unzipped files and folders from the temp path to base directory
            if (!File::copyDirectory($temp_path, base_path())) {
                return [
                    'success' => false,
                    'errors' => 'Error copying files',
                ];
            }
            // empty the temp directory
            File::cleanDirectory($temp_path);
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');

            // run migration if necessary
            if($version->should_migrate){
                Artisan::call('migrate', ['--force' => true]);
            }
            
            // Update the version number
            File::put(base_path('VERSION'), $version->version_number);

            return [
                'success' => true,
                'errors' => false
            ];
        } catch(GuzzleException $e) {
            return [
                'success' => false,
                'errors' => "Error occured"
            ];
        }

        

        return [
            'success' => true,
            'errors' => false
        ];
    }


}