<?php

declare(strict_types=1);

namespace App\Service\Lock;

use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\LockInterface;

/**
 * LockService implementation for concurrency control using Symfony Lock.
 */
class LockService implements LockServiceInterface
{
    private const LOCK_KEY = 'dataset_lock';
    private const LOCK_TTL = 60;

    public function __construct(
        private readonly LockFactory $lockFactory
    ) {}

    public function acquireLock(): ?LockInterface
    {
        $lock = $this->lockFactory->createLock(self::LOCK_KEY, self::LOCK_TTL);

        if ($lock->acquire()) {
            return $lock;
        }

        return null;
    }
}
