<?php

namespace Buxuhunao\LaravelBaiduAip\Support;

use Buxuhunao\LaravelBaiduAip\Http\Response;
use Buxuhunao\LaravelBaiduAip\BaiduAip;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Response getUuid(string $code)
 * @method static Response bind(string $uuid, string $name, ?string $remark = null)
 * @method static Response unbind(string $uuid)
 * @method static Response info(string $uuid)
 * @method static Response list(int $page)
 * @method static Response edit(string $uuid, string $name, ?string $remark = null)
 * @method static Response capability(string $uuid)
 * @method static Response create(array $params)
 * @method static Response cancel(string $uuid)
 * @method static Response process(string $uuid, string $printUuid)
 * @method static Response reboot(string $uuid)
 * @method static Response headClean(string $uuid)
 * @method static Response flush(string $uuid)
 * @method static Response nozzleCheck(string $uuid)
 */
class Aip extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaiduAip::class;
    }
}
