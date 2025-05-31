<?php

declare(strict_types=1);

namespace App\Service\Fetcher;

/**
 * Interface for dataset fetching logic
 */
interface FetcherInterface
{
    /**
     * Fetches dataset
     *
     * @return array
     */
    public function fetch(): array;
}
