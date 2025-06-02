<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\DatasetItem;
use App\Service\Cache\CacheServiceInterface;
use App\Service\Fetcher\FetcherInterface;
use App\Service\Lock\LockServiceInterface;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller for processing huge dataset with cache and lock handling.
 */
class DatasetController extends AbstractController
{
    public function __construct(
        private readonly CacheServiceInterface $cacheService,
        private readonly LockServiceInterface $lockService,
        private readonly FetcherInterface $fetcher
    ) {}

    #[Route('/process-huge-dataset', methods: ['GET'])]
    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns processed dataset"
     * )
     * @OA\Response(
     *     response=202,
     *     description="Processing is in progress"
     * )
     */
    public function process(): JsonResponse
    {
        $lock = $this->lockService->acquireLock();

        if ($lock === null) {
            $cached = $this->cacheService->getDataset();

            if ($cached === null) {
                return $this->json([], 202);
            }

            $response = new JsonResponse(
                array_map(fn (DatasetItem $item) => $item->toArray(), $cached),
                200
            );
            $response->headers->set('X-Cache-Status', 'STALE');

            return $response;
        }

        try {
            $data = $this->fetcher->fetch();
            $this->cacheService->saveDataset($data);

            return $this->json(
                array_map(fn (DatasetItem $item) => $item->toArray(), $data)
            );
        } finally {
            $lock->release();
        }
    }
}
