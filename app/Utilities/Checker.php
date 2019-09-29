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

class Checker
{

    public static function checkLicense(array $data)
    {
        $messages = [];

        // check paypal credentials
        if((int)setting('payments.enable_paypal') == 1){
            if(setting('payments.paypal_mode') == 'sandbox'){
                if(!setting('payments.paypal_sandbox_secret') || !setting('payments.paypal_sandbox_client_id') ){
                    array_push($messages, [
                        'feature' => 'PayPal',
                        'message' => 'Your PayPal Sandbox Credentials are missing'
                    ]);
                }
            }
            if(setting('payments.paypal_mode') == 'live'){
                if(!setting('payments.paypal_live_secret') || !setting('payments.paypal_live_client_id') ){
                    array_push($messages, [
                        'feature' => 'PayPal',
                        'message' => 'Your PayPal Live Credentials are missing'
                    ]);
                }
            }
        }

        // check Stripe credentials
        if((int)setting('payments.enable_credit_card') == 1){
            // Stripe
            if(setting('payments.credit_card_processor') == 'stripe'){
                if(setting('payments.stripe_mode') == 'sandbox' && (!setting('payments.stripe_sandbox_public_key') || !setting('payments.stripe_sandbox_secret_key')) ){
                    array_push($messages, [
                        'feature' => 'Stripe',
                        'message' => 'Your Stripe Sandbox credentials are missing'
                    ]);
                }
                if(setting('payments.stripe_mode') == 'live' && (!setting('payments.stripe_live_public_key') || !setting('payments.stripe_live_secret_key')) ){
                    array_push($messages, [
                        'feature' => 'Stripe',
                        'message' => 'Your Stripe Live credentials are missing'
                    ]);
                }
            }

            // RazorPay
            if(setting('payments.credit_card_processor') == 'razorpay'){
                if(setting('payments.razorpay_mode') == 'sandbox' && (!setting('payments.razorpay_sandbox_public_key') || !setting('payments.razorpay_sandbox_secret_key')) ){
                    array_push($messages, [
                        'feature' => 'Razorpay',
                        'message' => 'Your Razorpay Sandbox credentials are missing'
                    ]);
                }
                if(setting('payments.razorpay_mode') == 'live' && (!setting('payments.razorpay_live_public_key') || !setting('payments.razorpay_live_secret_key')) ){
                    array_push($messages, [
                        'feature' => 'Razorpay',
                        'message' => 'Your Razorpay Live credentials are missing'
                    ]);
                }
            }
        }

        // Upload Location
        if(setting('site.video_upload_location') == 's3'){
            if(!setting('site.s3_access_id') || !setting('site.s3_bucket') || !setting('site.s3_default_region') ){
                array_push($messages, [
                    'feature' => 's3',
                    'message' => 'You are missing Amazon s3 credentials'
                ]);
            }
        }




    }


}
