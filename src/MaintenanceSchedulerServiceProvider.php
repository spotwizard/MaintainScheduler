<?php

namespace Spotwizard\MaintenanceScheduler;

use Illuminate\Support\ServiceProvider;

class MaintenanceSchedulerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/maintenance-scheduler.php' => config_path('maintenance-scheduler.php'),
        ]);

        $this->commands([
            Console\Commands\ScheduleMaintenance::class,
            Console\Commands\CancelMaintenance::class,
        ]);

        // 註冊排程
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            
            $startTime = config('maintenance-scheduler.start_time');
            $endTime = config('maintenance-scheduler.end_time');

            if ($startTime && $endTime) {
                $schedule->command('down')->at($startTime);
                $schedule->command('up')->at($endTime);
            }
        });
    }
} 