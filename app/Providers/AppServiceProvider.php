<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

use App\Model\Domain;
use App\Model\AdminSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if(env('FORCE_HTTPS',false)) { // Default value should be false for local server
            URL::forceScheme('https');
        }

        if (Schema::hasTable('domains'))
        {
            $domain_name = $request->gethost();

            $domain = Domain::where('domain_name', $domain_name)->first();

            view()->share('domain', $domain);
        }

        if (Schema::hasTable('admin_settings')) {
            $app_currency = AdminSetting::where('name', 'app_currency')->first();
            if (!empty($app_currency)) {
                view()->share('app_currency', $app_currency->value);
            }

            $bill_website_url = AdminSetting::where('name', 'bill_website_url')->first();
            if (!empty($bill_website_url)) {
                view()->share('bill_website_url', $bill_website_url->value);
            }            

            $bill_facebook_page = AdminSetting::where('name', 'bill_facebook_page')->first();
            if (!empty($bill_facebook_page)) {
                view()->share('bill_facebook_page', $bill_facebook_page->value);
            }

            $bill_contact_numbers = AdminSetting::where('name', 'bill_contact_numbers')->first();
            if (!empty($bill_contact_numbers)) {
                view()->share('bill_contact_numbers', $bill_contact_numbers->value);
            }

            $bill_contact_email = AdminSetting::where('name', 'bill_contact_email')->first();
            if (!empty($bill_contact_email)) {
                view()->share('bill_contact_email', $bill_contact_email->value);
            }

            $bill_contact_persons = AdminSetting::where('name', 'bill_contact_persons')->first();
            if (!empty($bill_contact_persons)) {
                view()->share('bill_contact_persons', $bill_contact_persons->value);
            }
        }
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
