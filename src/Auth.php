<?php

namespace Buxuhunao\LaravelBaiduAip;

use Buxuhunao\LaravelBaiduAip\Contracts\Storage;

class Auth extends Client
{
    public function __construct(array $config, protected Storage $storage)
    {
        parent::__construct($config);
    }

    public function getToken(): string
    {
        if ($token = $this->storage->get($this->getCacheKey())) {
            return $token;
        }

        $options = $this->config->extend(['grant_type' => 'client_credentials'])->jsonSerialize();
        $response = $this->post('/oauth/2.0/token', ['query' => $options])->toArray();

        $token = $response['access_token'];
        $expires_in = $response['expires_in'] - 300;
        $this->storage->add($this->getCacheKey(), $token, $expires_in);

        return $token;
    }

    protected function getCacheKey(): string
    {
        return sprintf('baidu-aip.%s.access_token', $this->config->get('client_id'));
    }
}
