<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $current_time = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        DB::table('settings')->insert([
            'logo' => 'logo.png',
            'sitetitle' => 'My Site',
            'siteemail' => 'info@yoursite.com',
            'sitekeyword' => 'About Your Site',
            'facebookurl' => 'https://www.facebook.com/',
            'twitterurl' => 'https://twitter.com/',
            'googleplusurl' => 'https://plus.google.com/',
            'linkedinurl' => 'https://www.linkedin.com/',
            'phone' => '9800000000',
            'mobile' => '9800000000',
            'instagramurl' => 'https://www.instagram.com/',
            'fax' => '4422',
            'address' => 'Kathmandu, Nepal',
            'created_at' => $current_time,
            'updated_at' => $current_time
        ]);
    }
}
