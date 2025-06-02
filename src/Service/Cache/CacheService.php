<?php

declare(strict_types=1);

namespace App\Service\Cache;

use App\DTO\DatasetItem;
use Psr\Cache\CacheItemPoolInterface;

class CacheService implements CacheServiceInterface
{
    private const CACHE_KEY = 'dataset';
    private const CACHE_TTL = 60;

    public function __construct(
        private readonly CacheItemPoolInterface $cache
    ) {}

    public function getDataset(): ?array
    {
        $item = $this->cache->getItem(self::CACHE_KEY);
        if (!$item->isHit()) {
            return null;
        }

        $cachedArray = $item->get();

        return array_map(
            fn(array $data) => DatasetItem::builder()
                ->withId($data['id'])
                ->withValue($data['value'])
                ->build(),
            $cachedArray
        );
    }

    public function saveDataset(array $data): void
    {
        $item = $this->cache->getItem(self::CACHE_KEY);
        $item->expiresAfter(self::CACHE_TTL);

        $arrayData = array_map(
            fn(DatasetItem $item) => $item->toArray(),
            $data
        );

        $item->set($arrayData);
        $this->cache->save($item);
    }
}
