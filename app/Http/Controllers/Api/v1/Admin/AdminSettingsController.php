<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ICurrency;

class AdminSettingsController extends Controller
{

    private $currencies;

    public function __construct(ICurrency $currencies)
    {
        $this->currencies = $currencies;
    }
    
    public function fetchSettings(){
        return response()->json(setting()->all(), 200);
    }


    public function save_payment_settings(Request $request)
    {
        $paypal_sandbox_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_paypal == true && $request->paypal_mode == 'sandbox';
        });
        $paypal_live_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_paypal == true && $request->paypal_mode == 'live';
        });
        $stripe_sandbox_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'stripe' && $request->stripe_mode == 'sandbox';
        });
        $stripe_live_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'stripe' && $request->stripe_mode == 'live';
        });
        $razorpay_sandbox_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'razorpay' && $request->razorpay_mode == 'sandbox';
        });
        $razorpay_live_rule = Rule::requiredIf(function() use ($request){
            return $request->enable_credit_card == true && $request->credit_card_processor == 'razorpay' && $request->razorpay_mode == 'live';
        });

        $this->validate($request, [
            'paypal_sandbox_secret' => $paypal_sandbox_rule,
            'paypal_sandbox_client_id' => $paypal_sandbox_rule,
            'paypal_live_secret' => $paypal_live_rule,
            'paypal_live_client_id' => $paypal_live_rule,

            'stripe_sandbox_public_key' => $stripe_sandbox_rule,
            'stripe_sandbox_secret_key' => $stripe_sandbox_rule,
            'stripe_live_public_key' => $stripe_live_rule,
            'stripe_live_secret_key' => $stripe_live_rule,

            'razorpay_sandbox_public_key' => $razorpay_sandbox_rule,
            'razorpay_sandbox_secret_key' => $razorpay_sandbox_rule,
            'razorpay_live_public_key' => $razorpay_live_rule,
            'razorpay_live_secret_key' => $razorpay_live_rule
        ]);

        $data = $request->all();

        collect($data)->each(function ($v, $key) {
            setting(["payments.{$key}" => $v]);
        });
        setting()->save();
        return response()->json(setting()->all(), 200);
    }


    public function save_site_settings(Request $request)
    {
        $cur = $request->site_currency;
        if($cur){
            $currency = $this->currencies->findByCode($cur);
            if( ! $currency->is_primary){
                $this->currencies->markAsPrimary($currency->id);
            }
        }

        $this->validate($request, [
            's3_access_id' => 'required_if:video_upload_location,s3',
            's3_secret_access_key' => 'required_if:video_upload_location,s3',
            's3_default_region' => 'required_if:video_upload_location,s3',
            's3_bucket' => 'required_if:video_upload_location,s3'
        ]);
        

        $data = $request->all();

        collect($data)->each(function ($v, $key) {
            setting(["site.{$key}" => $v]);
        });
        setting()->save();
        return response()->json(setting()->all(), 200);
    }


    public function save_mail_settings(Request $request)
    {
        $data = $request->all();

        collect($data)->each(function ($v, $key) {
            setting(["mail.{$key}" => $v]);
        });
        setting()->save();
        return response()->json(setting()->all(), 200);
    }

    public function uploadLogo(Request $request)
    {
        $file = $request->file('photo');
        $extension = $request->file('photo')->extension();
        $name = "{$request->icon_type}.{$extension}";

        //$path = $file->storeAs('images', $file->getClientOriginalName(), 'icons'); // folder, filename, disk
        $path = $file->storeAs('images', $name, 'icons'); // folder, filename, disk
        
        if($path){
            setting(["site.{$request->icon_type}" => '/'.$path]);
            setting()->save();
        }
        
        return response()->json(setting()->all(), 200);
    }

}
