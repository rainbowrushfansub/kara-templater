<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Traits;

trait Functionable
{
    /**
     * @var array<string, string>
     */
    private array $functions = [];

    /**
     * @param scalar $value
     */
    public function set(string $name, mixed $value): self
    {
        $this->functions['set_'.md5($name)] = \sprintf('!set("%s", %s)!', $name, $value);

        return $this;
    }

    public function retime(string $mode, int|float|string $startAdjustment = 0, int|float|string $endAdjustment = 0): self
    {
        $this->functions['retime_'.md5($mode)] = \sprintf('!retime("%s",%s,%s)!', $mode, $startAdjustment, $endAdjustment);

        return $this;
    }

    public function relayer(int|string $position): self
    {
        $this->functions['relayer_'.md5($position)] = \sprintf('!relayer(%s)!', $position);

        return $this;
    }

    public function require(string $name, string $file): self
    {
        $this->functions['require_'.md5($name)] = \sprintf("%s = _G.require '%s'", $name, $file);

        return $this;
    }

    public function invoke(string $expression): self
    {
        $this->functions['invoke_'.md5($expression)] = $expression;

        return $this;
    }

    public function procedure(string $code): self
    {
        $this->functions['procedure_'.md5($code)] = $code;

        return $this;
    }
}
