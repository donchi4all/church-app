<?php

namespace App\Providers;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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


        View::composer('*', function ($view) {
            $pages = [
                'home' => 'Home',
                'about' => 'About Us',
                'sermons' => 'Sermons',
                'contact' => 'Contact',
                'donation' => 'Donation',
                'ministry' => 'Ministry',
                'prayer.form' => 'Prayer Form',
                'partnership' => 'Partnership',
            ];

            $routeName = request()->route() ? request()->route()->getName() : 'home';

            // Ensure only valid pages are processed
            if (!array_key_exists($routeName, $pages)) {
                $routeName = 'home';
            }

            // Cache SEO settings for 1 hour
            $seo = Cache::remember("seo_{$routeName}", 3600, function () use ($routeName) {
                return SeoSetting::where('page', $routeName)->first();
            });

            $view->with([
                'seo_title' => $seo->title ?? 'Default Site Title',
                'seo_description' => $seo->description ?? 'Default description for the site',
                'seo_keywords' => $seo->keywords ?? 'church, sermons, Bible, faith',
                'seo_image' => isset($seo) && $seo->image ? asset('storage/' . $seo->image) : asset('favicon.png'),
            ]);
        });

    }
}
