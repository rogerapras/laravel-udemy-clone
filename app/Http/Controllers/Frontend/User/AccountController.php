<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;

/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.user.account.BasicInformation');
    }

    public function basicInformation()
    {
        $user = auth()->user();
        //return view('frontend.user.account.BasicInformation', compact('user'));
    }
    
    public function changePassword()
    {
        $user = auth()->user();
        return view('frontend.user.account.ChangePassword', compact('user'));
    }
    
    public function privacySettings()
    {
        $user = auth()->user();
        return view('frontend.user.account.PrivacySettings', compact('user'));
    }
    
    public function payoutSettings()
    {
        $user = auth()->user();
        return view('frontend.user.account.PayoutSettings', compact('user'));
    }
}
