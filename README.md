<h1 align="center"> Baidu Aip Image Search </h1>

<p align="center"> baidu aip image search for Laravel.</p>


## Installing

```shell
$ composer require buxuhunao/laravel-baidu-aip -vvv
```

## Configuration

`configs/services`中添加服务配置

```
<?php

return [
    // ...
    
    'baidu-aip' => [
        'client_id' => env('BAIDU_AIP_CLIENT_ID'),
        'client_secret' => env('BAIDU_AIP_CLIENT_SECRET'),
    ]
];
```

## Usage

```
使用Facade门面

\Buxuhunao\LaravelBaiduAip\Support\Aip::add($options)

或
/**
 * @var BaiduAip $app
 */
$app = app(\Buxuhunao\LaravelBaiduAip\BaiduAip::class);
$app->add($options)


可用方法：

// 入库
$app->add($options);

// 检索
$app->search($options);

// 更新
$app->update($options);

// 删除
$app->remove($options);

```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/buxuhunao/laravel-baidu-aip/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/buxuhunao/laravel-baidu-aip/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT