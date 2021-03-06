<?php

namespace Mbarlow\Timezones;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TimezonesServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'MBarlow\Timezones\Timezones',
            function ($app) {
                return new \MBarlow\Timezones\Timezones;
            }
        );
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive(
            'displayDate',
            function ($expression) {
                list($dateTime, $tz, $format) = explode(',', $expression);

                return  "<?php echo \Timezones::convertToLocal($dateTime, $tz, $format); ?>";
            }
        );
    }
}
