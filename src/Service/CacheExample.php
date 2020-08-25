<?php

// src/Service/CacheExample.php

namespace App\Service;

use App\Repository\ArticleRepository;
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
    /**
     * @var ArticleRepository
     */
    private $repository;

    public function __construct(CacheItemPoolInterface $cache,ArticleRepository $repository)
    {
        $this->cache = $cache;
        $this->repository = $repository;
    }

    /**
     * @param string|null $key
     * @return CacheItem
     * @throws InvalidArgumentException
     */
    public function getCacheData(string $key=null)
    {
        //$cacheKey = md5($key);
        $cacheKey = 'MY-KEY';
        $item = $this->cache->getItem($cacheKey);

        if (!$item->isHit()) {

            $article= $this->repository->articlesPerPageNoFilter();
            $enabledArticles= $this->repository->enabledArticles();

            $data=["article" => $article ,  "enabledArticles" => $enabledArticles];
            $item->set(["Data" => $data]);
            $this->cache->save($item);
        }

        return $item->get();
    }
}