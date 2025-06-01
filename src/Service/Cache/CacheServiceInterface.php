<?php

declare(strict_types=1);

namespace App\Service\Cache;

use App\DTO\DatasetItem;

/**
 * Interface for dataset caching logic.
 */
interface CacheServiceInterface
{
    /**
     * Retrieves dataset from cache.
     *
     * @return DatasetItem[]|null
     */
    public function getDataset(): ?array;

    /**
     * Saves dataset to cache.
     *
     * @param DatasetItem[] $data
     */
    public function saveDataset(array $data): void;
}
