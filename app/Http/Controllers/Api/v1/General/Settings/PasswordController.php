<?php
namespace App\Http\Controllers\Api\v1\General\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|old_password:' . auth()->user()->password,
            'password' => 'required|confirmed|min:6',
        ]);
        $request->user()->update([
            'password' => Hash::make($request->password)
            //'password' => bcrypt($request->password),
        ]);
    }
}