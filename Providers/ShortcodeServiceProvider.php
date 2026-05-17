<?php 

namespace Modules\RootAccess\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\RootAccess\Shortcodes\RedirectButton;
use Shortcode;


class ShortcodeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
 
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        Shortcode::register('RedirectButton', RedirectButton::class);
  
    }

}