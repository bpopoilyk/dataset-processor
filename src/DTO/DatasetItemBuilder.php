<?php

declare(strict_types=1);

namespace App\DTO;

/**
 * Builder for DatasetItem DTO.
 */
class DatasetItemBuilder
{
    private ?int $id = null;
    private ?string $value = null;

    public function withId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function withValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function build(): DatasetItem
    {
        if ($this->id === null || $this->value === null) {
            throw new \LogicException('Missing required properties for DatasetItem');
        }

        return new DatasetItem(
            id: $this->id,
            value: $this->value
        );
    }
}
