<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use RainbowRush\KaraTemplater\Components\Mixin;

final class KaraTemplater
{
    /**
     * @var Requirement[]
     */
    private array $requirements = [];

    /**
     * @var Invocable[]
     */
    private array $invocables = [];

    /**
     * @var Procedure[]
     */
    private array $procedures = [];

    /**
     * @var Variable[]
     */
    private array $variables = [];

    /**
     * @var Mixin[]
     */
    private array $globalMixins = [];

    /**
     * @var SpecialEffect[]
     */
    private array $specialEffects = [];

    public function __construct(private readonly string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function init(string $name): self
    {
        return new self($name);
    }

    public function require(string $name, string $file): self
    {
        $this->requirements[$name] = new Requirement($name, $file);

        return $this;
    }

    public function invoke(string $expression): Invocable
    {
        $invocable = new Invocable($expression);

        $this->invocables[] = $invocable;

        return $invocable;
    }

    public function procedure(string $content): Procedure
    {
        $procedure = new Procedure($content);

        $this->procedures[] = $procedure;

        return $procedure;
    }

    /**
     * @param scalar $value
     */
    public function set(string $name, mixed $value): Variable
    {
        $variable = new Variable($name, $value);

        $this->variables[] = $variable;

        return $variable;
    }

    public function mixin(): Mixin
    {
        $mixin = new Mixin();

        $this->globalMixins[] = $mixin;

        return $mixin;
    }

    public function sfx(string $name): SpecialEffect
    {
        $sfx = new SpecialEffect();

        $this->specialEffects[$name] = $sfx;

        return $sfx;
    }

    public function buildTemplate(): string
    {
        $output = [];

        $output[] = section(
            label: 'Global Requirements',
            content: implode(\PHP_EOL, array_map(fn ($requirement): string => (string) $requirement, $this->requirements))
        );

        $output[] = section(
            label: 'Global Calls',
            content: implode(\PHP_EOL, array_map(fn ($invocable): string => (string) $invocable, $this->invocables))
        );

        $output[] = section(
            label: 'Global Procedures',
            content: implode(\PHP_EOL, array_map(fn ($procedure): string => (string) $procedure, $this->procedures))
        );

        $output[] = section(
            label: 'Global Variables',
            content: implode(\PHP_EOL, array_map(fn ($variable): string => (string) $variable, $this->variables))
        );

        $output[] = section(
            label: 'Global Mixins',
            content: implode(\PHP_EOL, array_map(fn ($globalMixin): string => (string) $globalMixin, $this->globalMixins))
        );

        foreach ($this->specialEffects as $label => $sfx) {
            $output[] = section("[SFX] $label", (string) $sfx);
        }

        return implode(\PHP_EOL, array_filter($output));
    }
}
