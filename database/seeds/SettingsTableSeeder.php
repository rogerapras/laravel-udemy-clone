<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
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
                'value' => 'sk_test_UMpKO6paKZwitb6C34eLLoHO',
            ),
            2 => 
            array (
                'id' => 84,
                'user_id' => NULL,
                'key' => 'payments.stripe_sandbox_public_key',
                'value' => 'pk_test_HGvVcTD8ZOTGwHT3lCVMsxW2',
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
                'value' => 'fgneba',
            ),
            5 => 
            array (
                'id' => 116,
                'user_id' => NULL,
                'key' => 'site.purchase_code',
                'value' => 'envato-purchase-code',
            ),
            6 => 
            array (
                'id' => 79,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_api_secret',
                'value' => 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-Ag0Fm7dTlaThCnz2K41rrLt8-pKJ',
            ),
            7 => 
            array (
                'id' => 78,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_api_password',
                'value' => '8CVA8HR867KF3JVK',
            ),
            8 => 
            array (
                'id' => 77,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_api_username',
                'value' => 'fgneba-facilitator_api1.gmail.com',
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
                'value' => 'EduCorea',
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
                'value' => 'contact@educore.com',
            ),
            20 => 
            array (
                'id' => 119,
                'user_id' => NULL,
                'key' => 'site.site_google_analytics',
                'value' => 'UA-123223-23',
            ),
            21 => 
            array (
                'id' => 107,
                'user_id' => NULL,
                'key' => 'site.site_address',
                'value' => '1 Rue de l\'Astre<br />Gatineau QC',
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
                'value' => 'vhkt56DMkjzac7bqAlpocnmF',
            ),
            26 => 
            array (
                'id' => 134,
                'user_id' => NULL,
                'key' => 'payments.razorpay_sandbox_public_key',
                'value' => 'rzp_test_1LLa12DKTnu640',
            ),
            27 => 
            array (
                'id' => 138,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_username',
                'value' => 'fgneba-facilitator_api1.gmail.com',
            ),
            28 => 
            array (
                'id' => 139,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_password',
                'value' => '8CVA8HR867KF3JVK',
            ),
            29 => 
            array (
                'id' => 140,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_secret',
                'value' => 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-Ag0Fm7dTlaThCnz2K41rrLt8-pKJ',
            ),
            30 => 
            array (
                'id' => 136,
                'user_id' => NULL,
                'key' => 'payments.razorpay_live_public_key',
                'value' => 'rzp_test_1LLa12DKTnu640',
            ),
            31 => 
            array (
                'id' => 137,
                'user_id' => NULL,
                'key' => 'payments.razorpay_live_secret_key',
                'value' => 'vhkt56DMkjzac7bqAlpocnmF',
            ),
            32 => 
            array (
                'id' => 141,
                'user_id' => NULL,
                'key' => 'payments.stripe_live_public_key',
                'value' => 'pk_test_HGvVcTD8ZOTGwHT3lCVMsxW2',
            ),
            33 => 
            array (
                'id' => 142,
                'user_id' => NULL,
                'key' => 'payments.stripe_live_secret_key',
                'value' => 'sk_test_UMpKO6paKZwitb6C34eLLoHO',
            ),
        ));
        
        
    }
}