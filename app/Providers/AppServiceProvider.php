<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

use App\Model\Domain;

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
