<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'likepost' => 'App\Models\Like',
            'likecomment' => 'App\Models\Like',
            'comment' => 'App\Models\Comment',
            'repliedcomment' => 'App\Models\Comment',
            'firstpost' => 'App\Models\Post',
            'post' => 'App\Models\Post',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }
}
