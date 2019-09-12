<?php

namespace App\Http\Controllers\Api\v1\Installer;

use File;
use Illuminate\Validation\Rule;
use App\Utilities\Installer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstallController extends Controller
{
    

    public function checkRequirements()
    {
        $requirements = Installer::checkServerRequirements();
        if (empty($requirements)) {
            return response()->json(null, 200);
        } else {
            return response()->json($requirements, 200);
        }

    }

    public function checkLicense(Request $request)
    {
        $this->validate($request, [
            'purchase_code' => ['required'],
            'username' => ['required']
        ]);

        if(!Installer::checkLicense($request->all())){
            return response()->json(['purchase_code' => 'Unable to validate the purchase. Please check the username and purchase code'], 422);
        }

        return response()->json(null, 200);

    }

    public function getDatabaseInfo()
    {
        $info = [
            'db_host' => env('DB_HOST'),
            'db_name' => env('DB_DATABASE'),
            'db_user' => env('DB_USERNAME'),
            'db_port' => env('DB_PORT'),
            'db_password' => env('DB_PASSWORD')
        ];

        return response()->json($info, 200);
    }

    public function setDatabase(Request $request)
    {
        $this->validate($request, [
            'db_host' => 'required',
            'db_name' => 'required',
            'db_user' => 'required',
            'db_port' => 'required',
            //'db_password' => 'required'
        ]);

        $host = $request['db_host'];
        $port = $request['db_port'];
        $database = $request['db_name'];
        $username = $request['db_user'];
        $password = $request['db_password'];

        // Check database connection
        if (!Installer::createDbTables($host, $port, $database, $username, $password)) {
            $message = trans('install.error.connection');
            return response()->json(['connection_error' => $message], 404);
        }
        return response()->json(null, 200);
    }

    public function saveSettings(Request $request)
    {
        try{
            \DB::statement("SET FOREIGN_KEY_CHECKS = 0");
            \DB::table('users')->truncate();
            \DB::statement("SET FOREIGN_KEY_CHECKS = 1");
        } catch(\Exception $e){
            return response()->json(['message' => 'Something went wrong.'], 404);
        }
       
        $this->validate($request, [
            'site_name' => ['required'],
            'username' => ['required', 'string', 'alpha_dash', 'max:15', Rule::unique('users')],
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
            
        // Create user
        $user = Installer::createUser($request->all());
        return response()->json($user, 200);
    }

    public function finish(Request $request)
    {
        
        try{
            if($request->import == true && ! Installer::seedSampleData()){
                return response()->json(['message' => 'Unable to load sample data'], 404);
            }
            if(! Installer::finalTouches()){
                return response()->json(['message' => 'Unable to finalize installation'], 404);
            }
        }catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404); 
        }
        
        return response()->json(null, 200);
        
    }
}
