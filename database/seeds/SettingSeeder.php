<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
                'app_name' => 'Laravel',
                'allow_signups' => true,
                'mail_driver' => 'sendmail',
                'mail_host' => 'smtp.mailtrap.io',
                'mail_port' => 2525,
                'mail_username' => '',
                'mail_password' => '',
                'mail_encryption' => 'tls',
                'mail_from_email' => '',
                'mail_from_name' => 'Laravel',
                'mailgun_domain' => '',
                'mailgun_secret' => '',
                'mailgun_endpoint' => 'api.mailgun.net'
        ];

        setting($settings)->save();
    }
}
