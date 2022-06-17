<?php

namespace Buxuhunao\LaravelBaiduAip\Support;

use Buxuhunao\LaravelBaiduAip\Http\Response;
use Buxuhunao\LaravelBaiduAip\BaiduAip;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Response add(array $options)
 * @method static Response search(array $options)
 * @method static Response update(array $options)
 * @method static Response remove(array $options)
 */
class Aip extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaiduAip::class;
    }
}
