<?php

// src/Service/CacheExample.php

namespace App\Service;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\TraceableAdapter;
use Symfony\Component\Cache\CacheItem;

class CacheExample
{
    /**
     * @var TraceableAdapter
     */
    private $cache;

    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return CacheItem
     * @throws InvalidArgumentException
     */
    public function get()
    {
        //$cacheKey = md5('123').'_MY-KEY';
        $cacheKey = 'MY-KEY';
        $cachedItem = $this->cache->getItem($cacheKey);

        if (!$cachedItem->isHit()) {
            $cachedItem->set($cacheKey);
            $this->cache->save($cachedItem);
        }

        return $cachedItem;
    }
}