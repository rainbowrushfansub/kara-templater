<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Traits;

use RainbowRush\KaraTemplater\Enum\Mode;

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

    public function retime(Mode $mode, int|float|string $startAdjustment = 0, int|float|string $endAdjustment = 0): self
    {
        $this->functions['retime_'.md5($mode->value)] = \sprintf('!retime("%s",%s,%s)!', $mode->value, $startAdjustment, $endAdjustment);

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

    public function position(int $a = 5, int $an = 5, int|float|string $xoffset = 0, float|string $yoffset = 0): self
    {
        $this->functions['pos_'.md5($a.$an.$xoffset.$yoffset)] = \sprintf('ln.tag.pos(%s, %s, %s, %s)', $a, $an, $xoffset, $yoffset);

        return $this;
    }

    public function movement(int|string|float $xoff0 = 0, int|string|float $yoff0 = 0, int|string|float $xoff1 = 0, int|string|float $yoff1 = 0, int|string|float $time0 = 0, int|string|float $time1 = 0, int|string|float $a = 5, int|string|float $an = 5): self
    {
        $this->functions['move_'.md5($xoff0.$yoff0.$xoff1.$yoff1.$time0.$time1.$a.$an)] = \sprintf('ln.tag.move(%s, %s, %s, %s, %s, %s, %s, %s)', $xoff0, $yoff0, $xoff1, $yoff1, $time0, $time1, $a, $an);

        return $this;
    }
}
