<?php

declare(strict_types=1);

namespace App\Service\Lock;

/**
 * Interface for concurrency lock handling during dataset processing.
 */
interface LockServiceInterface
{
    /**
     * Acquires lock for dataset processing.
     */
    public function acquireLock(): void;
}
