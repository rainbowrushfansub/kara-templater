<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Components;

use Override;
use RainbowRush\KaraTemplater\Core\Line;
use RainbowRush\KaraTemplater\Traits\Effectable;
use RainbowRush\KaraTemplater\Traits\Functionable;
use RainbowRush\KaraTemplater\Traits\Taggable;
use RainbowRush\KaraTemplater\Traits\Transformable;
use Stringable;

abstract class AbstractComponent implements Stringable
{
    use Effectable;
    use Functionable;
    use Taggable;
    use Transformable;

    private string $label = '';

    private string $description = '';

    #[Override]
    public function __toString(): string
    {
        $output = $this->functions;

        $tagsAndTransformations = $this->buildTags().$this->buildTransformations();

        if (false === ('' === $tagsAndTransformations || '0' === $tagsAndTransformations)) {
            $output[] = '{'.$tagsAndTransformations.'}';
        }

        $actor = [];

        if (false === ('' === $this->label || '0' === $this->label)) {
            $actor[] = "[{$this->label}]";
        }

        if (false === ('' === $this->description || '0' === $this->description)) {
            $actor[] = $this->description;
        }

        $line = Line::comment();

        if ([] !== $actor) {
            $line->actor(implode(' ', $actor));
        }

        $line->content(implode('', $output));
        $line->effect($this->buildEffect());

        return (string) $line;
    }

    public function label(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
