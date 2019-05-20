<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
use App\User;



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
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);
        // $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
        //     $event->menu->add('ADMINISTRATOR');
        //      $items = User::all()->map(function (User $user) {
        //         return [
        //             'text' => $user['name'],
        //             'icon' => 'cogs',
        //             'url' => $user['id'],
        //         ];
        //     });

        //     $event->menu->add(...$items);
        // });
    }
}
