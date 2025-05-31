<?php

declare(strict_types=1);

namespace App\Service\Lock;

/**
 * LockService will manage concurrency control using locking mechanism.
 */
class LockService implements LockServiceInterface
{
    public function acquireLock(): void
    {
    }
}
