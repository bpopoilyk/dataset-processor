<?php

declare(strict_types=1);

namespace App\Service\Fetcher;

use App\DTO\DatasetItem;

/**
 * Fetcher implementation which simulates a long-running operation
 * and returns a prepared dataset.
 */
class Fetcher implements FetcherInterface
{
    /**
     * Fetches the dataset with a simulated heavy computation.
     *
     * @return DatasetItem[]
     */
    public function fetch(): array
    {
        // Simulate long-running operation
        sleep(10);

        return [
            new DatasetItem(1, 'Alpha'),
            new DatasetItem(2, 'Beta'),
            new DatasetItem(3, 'Gamma'),
            new DatasetItem(4, 'Delta'),
            new DatasetItem(5, 'Epsilon'),
        ];
    }
}
