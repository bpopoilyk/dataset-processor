<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * DTO for single dataset item.
 */
readonly class DatasetItem
{
    public function __construct(
        public int $id,
        public string $value
    ) {}

    /**
     * Entry point for builder usage.
     *
     * @return DatasetItemBuilder
     */
    public static function builder(): DatasetItemBuilder
    {
        return new DatasetItemBuilder();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
        ];
    }
}
