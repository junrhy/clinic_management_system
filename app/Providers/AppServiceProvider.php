<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

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
