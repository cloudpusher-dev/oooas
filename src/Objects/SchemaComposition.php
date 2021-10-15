<?php

declare(strict_types=1);

namespace GoldSpecDigital\ObjectOrientedOAS\Objects;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Utilities\Arr;

/**
 * @property \GoldSpecDigital\ObjectOrientedOAS\Objects\Schema[]|null $schemas
 * @property \GoldSpecDigital\ObjectOrientedOAS\Objects\Discriminator|null $discriminator
 */
abstract class SchemaComposition extends BaseObject implements SchemaContract
{
    /**
     * @var \GoldSpecDigital\ObjectOrientedOAS\Objects\Schema[]|null
     */
    protected $schemas;

    /**
     * @var \GoldSpecDigital\ObjectOrientedOAS\Objects\Discriminator|null
     */
    protected $discriminator;

    /**
     * @param \GoldSpecDigital\ObjectOrientedOAS\Objects\Schema[] $schemas
     * @return static
     */
    public function schemas(Schema ...$schemas): self
    {
        $instance = clone $this;

        $instance->schemas = $schemas ?: null;

        return $instance;
    }

    /**
     * @param \GoldSpecDigital\ObjectOrientedOAS\Objects\Discriminator|null $discriminator
     * @return static
     */
    public function discriminator(?Discriminator $discriminator): self
    {
        $instance = clone $this;

        $instance->discriminator = $discriminator;

        return $instance;
    }

    /**
     * @return string
     */
    abstract protected function compositionType(): string;

    /**
     * @return array
     */
    protected function generate(): array
    {
        return Arr::filter([
            $this->compositionType() => $this->schemas,
            'discriminator' => $this->discriminator,
        ]);
    }
}
