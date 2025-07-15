<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use Override;
use Stringable;

final class Line implements Stringable
{
    /**
     * @param string[]|Stringable[] $content
     */
    public function __construct(
        private readonly bool $comment = true,
        private int $layer = 0,
        private readonly string $startTime = '0:00:00.00',
        private readonly string $endTime = '0:00:00.00',
        private readonly string $style = 'Default',
        private string $actor = '',
        private string $effect = '',
        private array $content = [],
    ) {
    }

    #[Override]
    public function __toString(): string
    {
        $type = $this->comment ? 'Comment' : 'Dialogue';
        $content = implode('', $this->content);

        return "{$type}: {$this->layer},{$this->startTime},{$this->endTime},{$this->style},{$this->actor},0,0,0,{$this->effect},{$content}";
    }

    public static function comment(): self
    {
        return new self(comment: true);
    }

    public function layer(int $layer): self
    {
        $this->layer = $layer;

        return $this;
    }

    public function actor(string $actor): self
    {
        $this->actor = $actor;

        return $this;
    }

    public function effect(string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }

    public function content(string $content): self
    {
        $this->content[] = $content;

        return $this;
    }
}
