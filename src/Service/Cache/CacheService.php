<?php

declare(strict_types=1);

namespace App\Service\Cache;

use App\DTO\DatasetItem;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

/**
 * CacheService implementation using Redis cache storage.
 */
class CacheService implements CacheServiceInterface
{
    private const CACHE_KEY = 'dataset';
    private const CACHE_TTL = 60;

    public function __construct(
        private readonly CacheInterface $cache
    ) {}

    /**
     * Retrieve dataset from cache or null if not found.
     */
    public function getDataset(): ?array
    {
        return $this->cache->get(self::CACHE_KEY, function (ItemInterface $item) {
            // If cache miss — we don't generate anything yet
            $item->expiresAfter(self::CACHE_TTL);
            return null;
        });
    }

    /**
     * Save dataset to cache.
     */
    public function saveDataset(array $data): void
    {
        $this->cache->delete(self::CACHE_KEY);

        $this->cache->get(self::CACHE_KEY, function (ItemInterface $item) use ($data) {
            $item->expiresAfter(self::CACHE_TTL);
            return $data;
        });
    }
}
