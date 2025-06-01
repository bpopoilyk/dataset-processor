<?php

declare(strict_types=1);

namespace App\Service\Lock;

use Symfony\Component\Lock\LockInterface;

/**
 * Interface for concurrency lock handling during dataset processing.
 */
interface LockServiceInterface
{
    /**
     * Tries to acquire exclusive lock.
     *
     * @return LockInterface|null Lock object or null if lock could not be acquired.
     */
    public function acquireLock(): ?LockInterface;
}
