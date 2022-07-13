<?php

namespace Buxuhunao\LaravelBaiduAip;

use Buxuhunao\LaravelBaiduAip\Exceptions\Exception;

class BaiduAip extends Client
{
    public function __construct($config)
    {
        parent::__construct($config);
    }

   public function add($options): array
   {
       $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/add';

       return $this->toArray($this->postWithToken($uri, $options));
   }

    public function search($options): array
    {
        $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/search';

        return $this->toArray($this->postWithToken($uri, $options));
    }

    public function update($options): array
    {
        $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/update';

        return $this->toArray($this->postWithToken($uri, $options));
    }

    public function remove($options): array
    {
        $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/delete';

        return $this->toArray($this->postWithToken($uri, $options));
    }

    protected function toArray($response)
    {
        $array = $response->toArray();

        if (! empty($array['error_code'])) {
            throw new Exception($array['error_msg'], 500);
        }

        return $array;
    }
}
