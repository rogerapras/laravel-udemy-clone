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
                'id' => 40,
                'user_id' => NULL,
                'key' => 'payments.enable_credit_card',
                'value' => '1',
            ),
            2 => 
            array (
                'id' => 41,
                'user_id' => NULL,
                'key' => 'payments.credit_card_processor',
                'value' => 'stripe',
            ),
            3 => 
            array (
                'id' => 76,
                'user_id' => NULL,
                'key' => 'payments.paypal_mode',
                'value' => 'sandbox',
            ),
            4 => 
            array (
                'id' => 83,
                'user_id' => NULL,
                'key' => 'payments.stripe_mode',
                'value' => 'sandbox',
            ),
            5 => 
            array (
                'id' => 84,
                'user_id' => NULL,
                'key' => 'payments.stripe_sandbox_public_key',
                'value' => 'pk_test_HGvVcTD8ZOTGwHT3lCVMsxW2',
            ),
            6 => 
            array (
                'id' => 85,
                'user_id' => NULL,
                'key' => 'payments.stripe_sandbox_secret_key',
                'value' => 'sk_test_UMpKO6paKZwitb6C34eLLoHO',
            ),
            7 => 
            array (
                'id' => 88,
                'user_id' => NULL,
                'key' => 'payments.razorpay_mode',
                'value' => 'sandbox',
            ),
            8 => 
            array (
                'id' => 93,
                'user_id' => NULL,
                'key' => 'site.site_mode',
                'value' => 'demo',
            ),
            9 => 
            array (
                'id' => 94,
                'user_id' => NULL,
                'key' => 'site.site_name',
                'value' => 'ArcInspire',
            ),
            10 => 
            array (
                'id' => 95,
                'user_id' => NULL,
                'key' => 'site.site_description',
                'value' => 'Your online learning platform',
            ),
            11 => 
            array (
                'id' => 96,
                'user_id' => NULL,
                'key' => 'site.site_keywords',
                'value' => 'Online course, Udemy alternative',
            ),
            12 => 
            array (
                'id' => 99,
                'user_id' => NULL,
                'key' => 'site.site_system_email',
                'value' => 'contact@educore.com',
            ),
            13 => 
            array (
                'id' => 104,
                'user_id' => NULL,
                'key' => 'site.video_upload_location',
                'value' => 'local',
            ),
            14 => 
            array (
                'id' => 105,
                'user_id' => NULL,
                'key' => 'site.video_max_size_mb',
                'value' => '20',
            ),
            15 => 
            array (
                'id' => 106,
                'user_id' => NULL,
                'key' => 'site.video_providers',
                'value' => 'both',
            ),
            16 => 
            array (
                'id' => 107,
                'user_id' => NULL,
                'key' => 'site.site_address',
                'value' => '1',
            ),
            17 => 
            array (
                'id' => 114,
                'user_id' => NULL,
                'key' => 'site.earning_organic_sales_percentage',
                'value' => '40',
            ),
            18 => 
            array (
                'id' => 115,
                'user_id' => NULL,
                'key' => 'site.earning_promo_sales_percentage',
                'value' => '75',
            ),
            19 => 
            array (
                'id' => 116,
                'user_id' => NULL,
                'key' => 'site.purchase_code',
                'value' => '0b4ff457-56ec-44f1-bc34-85160b580aef',
            ),
            20 => 
            array (
                'id' => 117,
                'user_id' => NULL,
                'key' => 'site.envato_username',
                'value' => 'mazensalama',
            ),
            21 => 
            array (
                'id' => 119,
                'user_id' => NULL,
                'key' => 'site.site_google_analytics',
                'value' => 'UA-123223-23',
            ),
            22 => 
            array (
                'id' => 134,
                'user_id' => NULL,
                'key' => 'payments.razorpay_sandbox_public_key',
                'value' => 'rzp_test_1LLa12DKTnu640',
            ),
            23 => 
            array (
                'id' => 135,
                'user_id' => NULL,
                'key' => 'payments.razorpay_sandbox_secret_key',
                'value' => 'vhkt56DMkjzac7bqAlpocnmF',
            ),
            24 => 
            array (
                'id' => 136,
                'user_id' => NULL,
                'key' => 'payments.razorpay_live_public_key',
                'value' => 'rzp_test_1LLa12DKTnu640',
            ),
            25 => 
            array (
                'id' => 137,
                'user_id' => NULL,
                'key' => 'payments.razorpay_live_secret_key',
                'value' => 'vhkt56DMkjzac7bqAlpocnmF',
            ),
            26 => 
            array (
                'id' => 138,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_username',
                'value' => 'fgneba-facilitator_api1.gmail.com',
            ),
            27 => 
            array (
                'id' => 139,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_password',
                'value' => '8CVA8HR867KF3JVK',
            ),
            28 => 
            array (
                'id' => 140,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_api_secret',
                'value' => 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-Ag0Fm7dTlaThCnz2K41rrLt8-pKJ',
            ),
            29 => 
            array (
                'id' => 141,
                'user_id' => NULL,
                'key' => 'payments.stripe_live_public_key',
                'value' => 'pk_test_HGvVcTD8ZOTGwHT3lCVMsxW2',
            ),
            30 => 
            array (
                'id' => 142,
                'user_id' => NULL,
                'key' => 'payments.stripe_live_secret_key',
                'value' => 'sk_test_UMpKO6paKZwitb6C34eLLoHO',
            ),
            31 => 
            array (
                'id' => 143,
                'user_id' => NULL,
                'key' => 'site.logo',
                'value' => '/images/logo.png',
            ),
            32 => 
            array (
                'id' => 144,
                'user_id' => NULL,
                'key' => 'site.favicon',
                'value' => '/images/favicon.png',
            ),
            33 => 
            array (
                'id' => 145,
                'user_id' => NULL,
                'key' => 'site.homepage_image',
                'value' => '/images/homepage_image.png',
            ),
            34 => 
            array (
                'id' => 146,
                'user_id' => NULL,
                'key' => 'site.encode_videos',
                'value' => '0',
            ),
            35 => 
            array (
                'id' => 147,
                'user_id' => NULL,
                'key' => 'site.enable_demo_mode',
                'value' => '0',
            ),
            36 => 
            array (
                'id' => 148,
                'user_id' => NULL,
                'key' => 'site.site_url',
                'value' => 'http://udemyl6.test',
            ),
            37 => 
            array (
                'id' => 149,
                'user_id' => NULL,
                'key' => 'site.redirect_https',
                'value' => '0',
            ),
            38 => 
            array (
                'id' => 150,
                'user_id' => NULL,
                'key' => 'site.site_currency',
                'value' => 'USD',
            ),
            39 => 
            array (
                'id' => 151,
                'user_id' => NULL,
                'key' => 'site.video_hd_dimension',
                'value' => '1280, 720',
            ),
            40 => 
            array (
                'id' => 152,
                'user_id' => NULL,
                'key' => 'site.video_sd_dimension',
                'value' => '640, 360',
            ),
            41 => 
            array (
                'id' => 153,
                'user_id' => NULL,
                'key' => 'site.s3_access_id',
                'value' => 'AKIAICWSOFVJ3XEPISNA',
            ),
            42 => 
            array (
                'id' => 154,
                'user_id' => NULL,
                'key' => 'site.s3_secret_access_key',
                'value' => 'p0mDH9t0hXaXXGcI+1SK7EyuOlkF9NRtRUNk0a6e',
            ),
            43 => 
            array (
                'id' => 155,
                'user_id' => NULL,
                'key' => 'site.s3_default_region',
                'value' => 'us-east-1',
            ),
            44 => 
            array (
                'id' => 156,
                'user_id' => NULL,
                'key' => 'site.s3_bucket',
                'value' => 'devprojects.stream.io',
            ),
            45 => 
            array (
                'id' => 157,
                'user_id' => NULL,
                'key' => 'site.s3_url',
                'value' => NULL,
            ),
            46 => 
            array (
                'id' => 158,
                'user_id' => NULL,
                'key' => 'site.queue_connection',
                'value' => 'database',
            ),
            47 => 
            array (
                'id' => 159,
                'user_id' => NULL,
                'key' => 'mail.driver',
                'value' => 'smtp',
            ),
            48 => 
            array (
                'id' => 160,
                'user_id' => NULL,
                'key' => 'mail.sendmail_path',
                'value' => '/usr/sbin/sendmail -bs',
            ),
            49 => 
            array (
                'id' => 161,
                'user_id' => NULL,
                'key' => 'mail.mailgun_domain',
                'value' => NULL,
            ),
            50 => 
            array (
                'id' => 162,
                'user_id' => NULL,
                'key' => 'mail.mailgun_secret',
                'value' => NULL,
            ),
            51 => 
            array (
                'id' => 163,
                'user_id' => NULL,
                'key' => 'mail.mailgun_endpoint',
                'value' => NULL,
            ),
            52 => 
            array (
                'id' => 164,
                'user_id' => NULL,
                'key' => 'mail.postmark_token',
                'value' => NULL,
            ),
            53 => 
            array (
                'id' => 165,
                'user_id' => NULL,
                'key' => 'mail.sparkpost_secret',
                'value' => NULL,
            ),
            54 => 
            array (
                'id' => 166,
                'user_id' => NULL,
                'key' => 'mail.ses_key',
                'value' => NULL,
            ),
            55 => 
            array (
                'id' => 167,
                'user_id' => NULL,
                'key' => 'mail.ses_secret',
                'value' => NULL,
            ),
            56 => 
            array (
                'id' => 168,
                'user_id' => NULL,
                'key' => 'mail.ses_region',
                'value' => NULL,
            ),
            57 => 
            array (
                'id' => 169,
                'user_id' => NULL,
                'key' => 'mail.smtp_host',
                'value' => 'smtp.mailtrap.io',
            ),
            58 => 
            array (
                'id' => 170,
                'user_id' => NULL,
                'key' => 'mail.smtp_port',
                'value' => '2525',
            ),
            59 => 
            array (
                'id' => 171,
                'user_id' => NULL,
                'key' => 'mail.smtp_username',
                'value' => '40b6c42a13f173',
            ),
            60 => 
            array (
                'id' => 172,
                'user_id' => NULL,
                'key' => 'mail.smtp_password',
                'value' => '86b26d5e618335',
            ),
            61 => 
            array (
                'id' => 173,
                'user_id' => NULL,
                'key' => 'mail.smtp_encryption',
                'value' => 'tls',
            ),
            62 => 
            array (
                'id' => 174,
                'user_id' => NULL,
                'key' => 'mail.from_address',
                'value' => 'contact@arcinspire.com',
            ),
            63 => 
            array (
                'id' => 175,
                'user_id' => NULL,
                'key' => 'mail.from_name',
                'value' => 'ArcInspire',
            ),
            64 => 
            array (
                'id' => 176,
                'user_id' => NULL,
                'key' => 'mail.mailing_address',
                'value' => '1 Some Street<br />
Cambridge ON<br />
J9A4SW Canada',
            ),
            65 => 
            array (
                'id' => 177,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_client_id',
                'value' => 'AVy7ITmYosrnTwe-IU7McefOgQa9GNhmn9_N03bezTVnjKTUjM_zjSJM03kjDU4099Xz94QqJ9LnPhQZ',
            ),
            66 => 
            array (
                'id' => 178,
                'user_id' => NULL,
                'key' => 'payments.paypal_sandbox_secret',
                'value' => 'EJywEGj8qCeoS6ccCIWS54hmjrGeyxUeO344fVlfGNJ9qRBPc5nE4aE-DAgzhqjZD5RLu30Sy_wv9wr6',
            ),
            67 => 
            array (
                'id' => 179,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_client_id',
                'value' => NULL,
            ),
            68 => 
            array (
                'id' => 180,
                'user_id' => NULL,
                'key' => 'payments.paypal_live_secret',
                'value' => NULL,
            ),
            69 => 
            array (
                'id' => 181,
                'user_id' => NULL,
                'key' => 'site.type',
                'value' => 'videos',
            ),
        ));
        
        
    }
}