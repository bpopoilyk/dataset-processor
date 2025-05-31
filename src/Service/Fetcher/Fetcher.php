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
            DatasetItem::builder()->withId(1)->withValue('Alpha')->build(),
            DatasetItem::builder()->withId(2)->withValue('Beta')->build(),
            DatasetItem::builder()->withId(3)->withValue('Gamma')->build(),
            DatasetItem::builder()->withId(4)->withValue('Delta')->build(),
            DatasetItem::builder()->withId(5)->withValue('Epsilon')->build(),
        ];
    }
}
