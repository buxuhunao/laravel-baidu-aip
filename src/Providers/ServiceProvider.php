<?php

namespace Buxuhunao\LaravelBaiduAip\Providers;

use Buxuhunao\LaravelBaiduAip\Auth;
use Buxuhunao\LaravelBaiduAip\BaiduAip;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected bool $defer = true;

    public function register()
    {
        $this->app->singleton('buxuhunao.baidu-aip.storage', function () {
            return $this->app->make(Illuminate::class);
        });

        $this->app->singleton(Auth::class, function ($app) {
            return new Auth($this->config(), $app['buxuhunao.baidu-aip.storage']);
        });

        $this->app->singleton(BaiduAip::class, function () {
            return new BaiduAip($this->config());
        });
    }

    public function provides(): array
    {
        return [BaiduAip::class];
    }

    protected function config()
    {
        return config('services.baidu-aip');
    }
}
