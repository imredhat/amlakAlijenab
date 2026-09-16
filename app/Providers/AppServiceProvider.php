<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
// use Hekmatinasser\Verta\Verta;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Shared hosting has no SSH access to clear stale configuration caches.
        // Keep web authentication state persistent even if an old cached
        // SESSION_DRIVER value is still present on the server.
        $this->app->make('config')->set([
            'session.driver' => 'file',
            'session.files' => storage_path('framework/sessions'),
            'session.cookie' => 'melkalijenab_session',
            'session.path' => '/',
            'session.domain' => null,
            'session.secure' => false,
            'session.http_only' => true,
            'session.same_site' => 'lax',
        ]);

         // ثبت Verta در container
        // $this->app->bind('verta', function () {
        //     return new Verta();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share site logo globally to all views
        View::composer('*', function ($view) {
            $contactPage = DB::table('pages')->where('slug', 'contact')->first();
            $siteLogo = $contactPage->logo ?? '/img/logo/logo-dark.svg';
            $view->with('siteLogo', $siteLogo);
        });

        View::composer('partials.home.footer', function ($view) {
            $footerBlogs = Blog::published()
                ->orderByDesc('published_at')
                ->limit(2)
                ->get();

            $contactPage = DB::table('pages')->where('slug', 'contact')->first();

            $view->with('footerBlogs', $footerBlogs);
            $view->with('footerContact', $contactPage);
        });

        View::composer('partials.home.menu', function ($view) {
            $locations = DB::table('neighborhoods')->where('showInMenu', true)->get();
            $view->with('locations', $locations);
        });
    }
}
