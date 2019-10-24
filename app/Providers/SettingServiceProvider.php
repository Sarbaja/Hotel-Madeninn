<?php
/**
 * Created by PhpStorm.
 * Project Title: nepalagora
 * Author Name: Subas Nyaupane
 * Author Email: subas.nyaupane143@gmail.com
 * Author Url : https://subasnyaupane.github.io/
 * Date: 31/Jan/2019
 */

namespace App\Providers;

use App\Setting;
use Illuminate\Support\ServiceProvider;


class SettingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view){
            $setting = Setting::find('1');
            return $view->with('setting', $setting);
        });
    }
}
