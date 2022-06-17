<?php

namespace Buxuhunao\LaravelBaiduAip;

use Buxuhunao\LaravelBaiduAip\Exceptions\ClientException;
use Buxuhunao\LaravelBaiduAip\Exceptions\Exception;
use Buxuhunao\LaravelBaiduAip\Exceptions\InvalidConfigException;
use Buxuhunao\LaravelBaiduAip\Exceptions\ServerException;
use Buxuhunao\LaravelBaiduAip\Http\Response;
use Buxuhunao\LaravelBaiduAip\Traits\CreatesHttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use Throwable;

/**
 * @method Response get($uri, array $options = [])
 * @method Response head($uri, array $options = [])
 * @method Response options($uri, array $options = [])
 * @method Response put($uri, array $options = [])
 * @method Response post($uri, array $options = [])
 * @method Response patch($uri, array $options = [])
 * @method Response delete($uri, array $options = [])
 * @method Response request(string $method, $uri, array $options = [])
 * @method PromiseInterface getAsync($uri, array $options = [])
 * @method PromiseInterface headAsync($uri, array $options = [])
 * @method PromiseInterface optionsAsync($uri, array $options = [])
 * @method PromiseInterface putAsync($uri, array $options = [])
 * @method PromiseInterface postAsync($uri, array $options = [])
 * @method PromiseInterface patchAsync($uri, array $options = [])
 * @method PromiseInterface deleteAsync($uri, array $options = [])
 * @method PromiseInterface requestAsync(string $method, $uri, array $options = [])
 */
class Client
{
    use CreatesHttpClient;

    public const BASE_URI = 'https://aip.baidubce.com';

    protected Config $config;

    protected \GuzzleHttp\Client $client;

    /**
     * @param $config
     *
     * @throws InvalidConfigException
     */
    public function __construct($config)
    {
        if (! ($config instanceof Config)) {
            $config = new Config($config);
        }

        if (! $config->has('client_id') || ! $config->has('client_secret')) {
            throw new InvalidConfigException('client_id and client_secret was required.');
        }

        $this->config = $config;

        $this->configure($config);
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getHttpClient(): \GuzzleHttp\Client
    {
        return $this->client ?? $this->client = $this->createHttpClient();
    }

    /**
     * @param $method
     * @param $arguments
     * @return Response
     * @throws ClientException
     * @throws Exception
     * @throws ServerException
     */
    public function __call($method, $arguments)
    {
        try {
            return new Response(\call_user_func_array([$this->getHttpClient(), $method], $arguments));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            throw new ClientException($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            throw new ServerException($e);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }

    /**
     * @param Config $config
     *
     * @return Client
     */
    protected function configure(Config $config): Client
    {
        $this->setHttpClientOptions(\array_replace_recursive([
            'base_uri' => self::BASE_URI,
            'headers' => [
                'User-Agent' => 'buxuhunao/laravel-baidu-aip:'. ClientInterface::MAJOR_VERSION,
            ],
        ], $config->get('guzzle', [])));

        return $this;
    }

    public function postWithToken($uri, $options): Response
    {
        $uri = sprintf('%s?access_token=%s', $uri, app(Auth::class)->getToken());

        return $this->post($uri, ['form_params' => $options]);
    }
}
