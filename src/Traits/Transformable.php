<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Traits;

use Closure;
use RainbowRush\KaraTemplater\Core\Transform;

trait Transformable
{
    /**
     * @var Transform[]
     */
    private array $transformations = [];

    public function transform(Closure $closure): self
    {
        $transformation = new Transform();
        $closure($transformation);

        $this->transformations[] = $transformation;

        return $this;
    }

    public function buildTransformations(): string
    {
        return implode('', $this->transformations);
    }
}
