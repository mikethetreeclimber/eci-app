<?php

namespace App\Providers;

use Livewire\Component;
use Illuminate\Log\Logger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        RedirectResponse::macro('banner', function ($message) {
            return $this->with('flash', [
                'bannerStyle' => 'success',
                'banner' => $message,
            ]);
        });

        RedirectResponse::macro('dangerBanner', function ($message) {
            return $this->with('flash', [
                'bannerStyle' => 'danger',
                'banner' => $message,
            ]);
        });

        Component::macro('notify', function ($message) {
            $this->dispatchBrowserEvent('notify', $message);
        });

        Component::macro('dangerNotify', function ($message) {
            $this->dispatchBrowserEvent('danger', $message);
        });

        Queue::after(function (JobProcessed $event) {
            info($event);
            // $event->connectionName
            // $event->job
            // $event->job->payload()
        });
    }
}
