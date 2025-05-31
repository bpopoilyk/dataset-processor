<?php

declare(strict_types=1);

namespace App\Service\Cache;

/**
 * CacheService will handle caching logic for dataset.
 */
class CacheService implements CacheServiceInterface
{
    public function getDataset(): array
    {
        return [];
    }
}
