<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use Override;
use RainbowRush\KaraTemplater\Traits\Taggable;
use Stringable;

final class Transform implements Stringable
{
    use Taggable;

    public function __construct(
        private int|float|string|null $startTime = null,
        private int|float|string|null $endTime = null,
        private int|float|null $accel = null,
    ) {
    }

    #[Override]
    public function __toString(): string
    {
        $tags = $this->buildTags();

        if (null !== $this->startTime && null !== $this->endTime) {
            if (null !== $this->accel) {
                return \sprintf('\\t(%s,%s,%s,%s)', $this->startTime, $this->endTime, $this->accel, $tags);
            }

            return \sprintf('\\t(%s,%s,%s)', $this->startTime, $this->endTime, $tags);
        }

        if (null !== $this->accel) {
            return \sprintf('\\t(%s,%s)', $this->accel, $tags);
        }

        return \sprintf('\\t(%s)', $tags);
    }

    public function start(int|float|string $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function end(int|float|string $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function accel(int|float $accel): self
    {
        $this->accel = $accel;

        return $this;
    }
}
