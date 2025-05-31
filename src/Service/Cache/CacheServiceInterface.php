<?php

declare(strict_types=1);

namespace App\Service\Cache;

/**
 * Interface for dataset caching logic.
 */
interface CacheServiceInterface
{
    /**
     * Retrieves dataset from cache or storage.
     *
     * @return array
     */
    public function getDataset(): array;
}
