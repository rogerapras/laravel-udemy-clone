<?php

use Illuminate\Database\Seeder;

class InitialSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => NULL,
                'key' => 'payments.enable_paypal',
                'value' => '1',
            ),
            1 => 
            array (
                'id' => 85,
                'user_id' => NULL,
                'key' => 'payments.stripe_sandbox_secret_key',
                'value' => NULL,
            ),
            2 => 
            array (
                'id' => 84,
                'user_id' => NULL,
                'key' => 'payments.stripe_sandbox_public_key',
                'value' => NULL,
            ),
            3 => 
            array (
                'id' => 83,
                'user_id' => NULL,
                'key' => 'payments.stripe_mode',
                'value' => 'sandbox',
            ),
            4 => 
            array (
                'id' => 117,
                'user_id' => NULL,
                'key' => 'site.envato_username',
                'value' => NULL,
            ),
            5 => 
            array (
                'id' => 116,
                'user_id' => NULL,
                'key' => 'site.purchase_code',
                'value' => NULL,
            ),
            6 => 
            array (
                'id' => 79,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_api_secret',
                'value' => NULL,
            ),
            7 => 
            array (
                'id' => 78,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_api_password',
                'value' => NULL,
            ),
            8 => 
            array (
                'id' => 77,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_api_username',
                'value' => NULL,
            ),
            9 => 
            array (
                'id' => 41,
                'user_id' => NULL,
                'key' => 'payments.credit_card_processor',
                'value' => 'stripe',
            ),
            10 => 
            array (
                'id' => 40,
                'user_id' => NULL,
                'key' => 'payments.enable_credit_card',
                'value' => '1',
            ),
            11 => 
            array (
                'id' => 76,
                'user_id' => NULL,
                'key' => 'payments.paypal_mode',
                'value' => 'sandbox',
            ),
            12 => 
            array (
                'id' => 88,
                'user_id' => NULL,
                'key' => 'payments.razorpay_mode',
                'value' => 'sandbox',
            ),
            13 => 
            array (
                'id' => 115,
                'user_id' => NULL,
                'key' => 'site.earning_promo_sales_percentage',
                'value' => '75',
            ),
            14 => 
            array (
                'id' => 93,
                'user_id' => NULL,
                'key' => 'site.site_mode',
                'value' => 'demo',
            ),
            15 => 
            array (
                'id' => 94,
                'user_id' => NULL,
                'key' => 'site.site_name',
                'value' => 'EduCore',
            ),
            16 => 
            array (
                'id' => 95,
                'user_id' => NULL,
                'key' => 'site.site_description',
                'value' => 'Your online learning platform',
            ),
            17 => 
            array (
                'id' => 96,
                'user_id' => NULL,
                'key' => 'site.site_keywords',
                'value' => 'Online course, Udemy alternative',
            ),
            18 => 
            array (
                'id' => 114,
                'user_id' => NULL,
                'key' => 'site.earning_organic_sales_percentage',
                'value' => '40',
            ),
            19 => 
            array (
                'id' => 99,
                'user_id' => NULL,
                'key' => 'site.site_system_email',
                'value' => NULL,
            ),
            20 => 
            array (
                'id' => 119,
                'user_id' => NULL,
                'key' => 'site.site_google_analytics',
                'value' => NULL,
            ),
            21 => 
            array (
                'id' => 107,
                'user_id' => NULL,
                'key' => 'site.site_address',
                'value' => NULL,
            ),
            22 => 
            array (
                'id' => 104,
                'user_id' => NULL,
                'key' => 'site.video_upload_location',
                'value' => 'local',
            ),
            23 => 
            array (
                'id' => 105,
                'user_id' => NULL,
                'key' => 'site.video_max_size_mb',
                'value' => '20',
            ),
            24 => 
            array (
                'id' => 106,
                'user_id' => NULL,
                'key' => 'site.video_providers',
                'value' => 'both',
            ),
            25 => 
            array (
                'id' => 135,
                'user_id' => NULL,
                'key' => 'payments.razorpay_sandbox_secret_key',
                'value' => NULL,
            ),
            26 => 
            array (
                'id' => 134,
                'user_id' => NULL,
                'key' => 'payments.razorpay_sandbox_public_key',
                'value' => NULL,
            ),
            27 => 
            array (
                'id' => 138,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_username',
                'value' => NULL,
            ),
            28 => 
            array (
                'id' => 139,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_password',
                'value' => NULL,
            ),
            29 => 
            array (
                'id' => 140,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_secret',
                'value' => NULL,
            ),
            30 => 
            array (
                'id' => 136,
                'user_id' => NULL,
                'key' => 'payments.razorpay_live_public_key',
                'value' => NULL,
            ),
            31 => 
            array (
                'id' => 137,
                'user_id' => NULL,
                'key' => 'payments.razorpay_live_secret_key',
                'value' => NULL,
            ),
            32 => 
            array (
                'id' => 141,
                'user_id' => NULL,
                'key' => 'payments.stripe_live_public_key',
                'value' => NULL,
            ),
            33 => 
            array (
                'id' => 142,
                'user_id' => NULL,
                'key' => 'payments.stripe_live_secret_key',
                'value' => NULL,
            ),
        ));
    }
}
