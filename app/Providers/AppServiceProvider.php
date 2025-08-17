<?php

namespace App\Providers;

use App\Services\ContactService;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
      public function boot(): void
    {
        // Register Blade directive for contact details
        Blade::directive('contact', function ($expression) {
            return "<?php echo App\Services\ContactService::getContactDetail({$expression}); ?>";
        });

        // Share contact details globally with all views
        view()->share('contact', ContactService::getContactDetails());
        
        // Register Livewire components
      Livewire::component('doctor.section.view-detail', \App\Livewire\Doctor\Section\ViewDetail::class);
    }
}
