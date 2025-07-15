<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use Override;
use RainbowRush\KaraTemplater\Components\Mixin;
use RainbowRush\KaraTemplater\Components\Template;
use Stringable;

final class SpecialEffect implements Stringable
{
    /**
     * @var Template[]
     */
    private array $templates = [];

    /**
     * @var Mixin[]
     */
    private array $mixins = [];

    #[Override]
    public function __toString(): string
    {
        $output = [];

        foreach ($this->templates as $template) {
            $output[] = (string) $template;
        }

        foreach ($this->mixins as $mixin) {
            $output[] = (string) $mixin;
        }

        return implode(\PHP_EOL, $output);
    }

    public function template(?Template $template = null): Template
    {
        $template ??= new Template();

        $this->templates[] = $template;

        return $template;
    }

    public function mixin(?Mixin $mixin = null): Mixin
    {
        $mixin ??= new Mixin();

        $this->mixins[] = $mixin;

        return $mixin;
    }
}
