<?php

namespace Buxuhunao\LaravelBaiduAip;

class BaiduAip extends Client
{
    public function __construct($config)
    {
        parent::__construct($config);
    }

   public function add($options): Http\Response
   {
       $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/add';

       return $this->postWithToken($uri, $options);
   }

    public function search($options): Http\Response
    {
        $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/search';

        return $this->postWithToken($uri, $options);
    }

    public function update($options): Http\Response
    {
        $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/update';

        return $this->postWithToken($uri, $options);
    }

    public function remove($options): Http\Response
    {
        $uri = '/rest/2.0/image-classify/v1/realtime_search/similar/delete';

        return $this->postWithToken($uri, $options);
    }
}
