<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Traits;

use LogicException;
use RainbowRush\KaraTemplater\Enum\Component;
use RainbowRush\KaraTemplater\Enum\Scope;

trait Effectable
{
    protected Component $component = Component::TEMPLATE;

    private ?Scope $scope = null;

    /**
     * @var string[]
     */
    private array $modifiers = [];

    public function once(): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::CODE);
        $this->scope = Scope::ONCE;

        return $this;
    }

    public function line(): self
    {
        $this->scope = Scope::LINE;

        return $this;
    }

    public function syl(): self
    {
        $this->scope = Scope::SYL;

        return $this;
    }

    public function char(): self
    {
        $this->scope = Scope::CHAR;

        return $this;
    }

    public function actor(string $actor): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = "actor $actor";

        return $this;
    }

    public function tActor(string $actor): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::MIXIN);
        $this->modifiers[] = "t_actor $actor";

        return $this;
    }

    public function noActor(string $actor): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = "no_actor $actor";

        return $this;
    }

    public function noTActor(string $actor): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::MIXIN);
        $this->modifiers[] = "no_tactor $actor";

        return $this;
    }

    public function anyStyle(): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = 'anystyle';

        return $this;
    }

    public function all(): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = 'all';

        return $this;
    }

    public function noText(): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = 'notext';

        return $this;
    }

    public function noBlank(): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = 'noblank';

        return $this;
    }

    public function style(string $style): self
    {
        $this->modifiers[] = "style $style";

        return $this;
    }

    public function loop(string $name, int $times): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = "loop $name $times";

        return $this;
    }

    public function inlineFx(string $fx): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = "inlinefx $fx";

        return $this;
    }

    public function when(string $expression): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = "cond $expression";

        return $this;
    }

    public function unless(string $expression): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::TEMPLATE, Component::MIXIN);
        $this->modifiers[] = "unless $expression";

        return $this;
    }

    public function onlyLayer(int $layer): self
    {
        $this->assertAllowedComponent(__FUNCTION__, Component::MIXIN);
        $this->modifiers[] = "layer $layer";

        return $this;
    }

    public function buildEffect(): string
    {
        return implode(' ', [
            $this->component->value,
            $this->scope?->value,
            ...$this->modifiers,
        ]);
    }

    private function assertAllowedComponent(string $method, Component ...$allowedComponents): void
    {
        if (!\in_array($this->component, $allowedComponents, true)) {
            $allowedNames = array_map(fn (Component $component): string => "\"{$component->value}\"", $allowedComponents);
            $componentWord = \count($allowedComponents) > 1 ? 'components' : 'component';
            $message = \sprintf(
                'The "%s" method can only be used with the %s %s.',
                $method,
                implode(' or ', $allowedNames),
                $componentWord
            );
            throw new LogicException($message);
        }
    }
}
