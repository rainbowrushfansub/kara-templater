<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Traits;

use LogicException;

trait Taggable
{
    private ?int $a = null;

    private ?int $an = null;

    private int|string|float|null $be = null;

    private int|string|float|null $bord = null;

    private int|string|float|null $shad = null;

    private int|string|float|null $blur = null;

    private int|string|float|null $fscx = null;

    private int|string|float|null $fscy = null;

    private int|string|float|null $frz = null;

    private int|string|float|null $frx = null;

    private int|string|float|null $fry = null;

    private int|string|float|null $fax = null;

    private int|string|float|null $fay = null;

    private int|string|float|null $fsvp = null;

    private ?string $jitter = null;

    /**
     * @var array{x: int|float|string, y: int|float|string}
     */
    private array $pos = [];

    /**
     * @var array{
     *     x1: int|float|string,
     *     y1: int|float|string,
     *     x2: int|float|string,
     *     y2: int|float|string,
     *     startTime: int|float|string,
     *     endTime: int|float|string
     * }
     */
    private array $move = [];

    /**
     * @var array{
     *     1: string,
     *     2: string,
     *     3: string,
     *     4: string
     * }
     */
    private array $colors = [];

    /**
     * @var array{
     *     1: string,
     *     2: string,
     *     3: string,
     *     4: string
     * }
     */
    private array $gradients = [];

    /**
     * @var array{
     *     0: int|string,
     *     1: int|string,
     *     2: int|string,
     *     3: int|string,
     *     4: int|string
     * }
     */
    private array $alphas = [];

    /**
     * @var array{
     *     startTime: int|float|string,
     *     endTime: int|float|string
     * }[]
     */
    private array $fades = [];

    public function a(int $value): self
    {
        $this->a = $value;

        return $this;
    }

    public function an(int $value): self
    {
        $this->an = $value;

        return $this;
    }

    public function be(int|string|float $value): self
    {
        $this->be = $value;

        return $this;
    }

    public function bord(int|string|float $value): self
    {
        $this->bord = $value;

        return $this;
    }

    public function shad(int|string|float $value): self
    {
        $this->shad = $value;

        return $this;
    }

    public function blur(int|string|float $value): self
    {
        $this->blur = $value;

        return $this;
    }

    public function fscx(int|string|float $fscx): self
    {
        $this->fscx = $fscx;

        return $this;
    }

    public function fscy(int|string|float $fscy): self
    {
        $this->fscy = $fscy;

        return $this;
    }

    public function frz(int|string|float $frz): self
    {
        $this->frz = $frz;

        return $this;
    }

    public function frx(int|string|float $frx): self
    {
        $this->frx = $frx;

        return $this;
    }

    public function fry(int|string|float $fry): self
    {
        $this->fry = $fry;

        return $this;
    }

    public function fax(int|string|float $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function fay(int|string|float $fay): self
    {
        $this->fay = $fay;

        return $this;
    }

    public function fsvp(int|string|float $fsvp): self
    {
        $this->fsvp = $fsvp;

        return $this;
    }

    public function jitter(int $left, int $right, int $up, int $down, int $period): self
    {
        $this->jitter = \sprintf('%s,%s,%s,%s,%s', $left, $right, $up, $down, $period);

        return $this;
    }

    public function noJitter(): self
    {
        $this->jitter = '0,0,0,0,0';

        return $this;
    }

    public function pos(int|string|float $x, int|string|float $y): self
    {
        $this->pos['x'] = $x;
        $this->pos['y'] = $y;

        return $this;
    }

    public function move(int|string|float $x1, int|string|float $y1, int|string|float $x2, int|string|float $y2, int|string|float $startTime, int|string|float $endTime): self
    {
        $this->move['x1'] = $x1;
        $this->move['y1'] = $y1;
        $this->move['x2'] = $x2;
        $this->move['y2'] = $y2;
        $this->move['startTime'] = $startTime;
        $this->move['endTime'] = $endTime;

        return $this;
    }

    public function color1(string $color): self
    {
        $this->colors[1] = $color;

        return $this;
    }

    public function color2(string $color): self
    {
        $this->colors[2] = $color;

        return $this;
    }

    public function color3(string $color): self
    {
        $this->colors[3] = $color;

        return $this;
    }

    public function color4(string $color): self
    {
        $this->colors[4] = $color;

        return $this;
    }

    public function gradient1(string $color = '', string $leftTop = '', string $rightTop = '', string $leftBottom = '', string $rightBottom = ''): self
    {
        $this->gradients[1] = $this->gradient($color, $leftTop, $rightTop, $leftBottom, $rightBottom);
        $this->gradients[1] = str_replace('__X__', '1', $this->gradients[1]);

        return $this;
    }

    public function gradient2(string $color = '', string $leftTop = '', string $rightTop = '', string $leftBottom = '', string $rightBottom = ''): self
    {
        $this->gradients[2] = $this->gradient($color, $leftTop, $rightTop, $leftBottom, $rightBottom);
        $this->gradients[2] = str_replace('__X__', '2', $this->gradients[2]);

        return $this;
    }

    public function gradient3(string $color = '', string $leftTop = '', string $rightTop = '', string $leftBottom = '', string $rightBottom = ''): self
    {
        $this->gradients[3] = $this->gradient($color, $leftTop, $rightTop, $leftBottom, $rightBottom);
        $this->gradients[3] = str_replace('__X__', '3', $this->gradients[3]);

        return $this;
    }

    public function gradient4(string $color = '', string $leftTop = '', string $rightTop = '', string $leftBottom = '', string $rightBottom = ''): self
    {
        $this->gradients[4] = $this->gradient($color, $leftTop, $rightTop, $leftBottom, $rightBottom);
        $this->gradients[4] = str_replace('__X__', '4', $this->gradients[4]);

        return $this;
    }

    public function alpha(int|string $alpha): self
    {
        $this->alphas[0] = $alpha;

        return $this;
    }

    public function alpha1(int|string $alpha): self
    {
        $this->alphas[1] = $alpha;

        return $this;
    }

    public function alpha2(int|string $alpha): self
    {
        $this->alphas[2] = $alpha;

        return $this;
    }

    public function alpha3(int|string $alpha): self
    {
        $this->alphas[3] = $alpha;

        return $this;
    }

    public function alpha4(int|string $alpha): self
    {
        $this->alphas[4] = $alpha;

        return $this;
    }

    public function fade(int|float|string $startTime, int|float|string $endTime): self
    {
        $this->fades[] = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];

        return $this;
    }

    public function buildTags(): string
    {
        $output = '';

        if (null !== $this->a) {
            $output .= '\\a'.$this->a;
        }

        if (null !== $this->an) {
            $output .= '\\an'.$this->an;
        }

        if (null !== $this->be) {
            $output .= '\\be'.$this->be;
        }

        if (null !== $this->bord) {
            $output .= '\\bord'.$this->bord;
        }

        if (null !== $this->shad) {
            $output .= '\\shad'.$this->shad;
        }

        if (null !== $this->blur) {
            $output .= '\\blur'.$this->blur;
        }

        if (null !== $this->fscx) {
            $output .= '\\fscx'.$this->fscx;
        }

        if (null !== $this->fscy) {
            $output .= '\\fscy'.$this->fscy;
        }

        if (null !== $this->frz) {
            $output .= '\\frz'.$this->frz;
        }

        if (null !== $this->frx) {
            $output .= '\\frx'.$this->frx;
        }

        if (null !== $this->fry) {
            $output .= '\\fry'.$this->fry;
        }

        if (null !== $this->fax) {
            $output .= '\\fax'.$this->fax;
        }

        if (null !== $this->fay) {
            $output .= '\\fay'.$this->fay;
        }

        if (null !== $this->fsvp) {
            $output .= '\\fsvp'.$this->fsvp;
        }

        if (null !== $this->jitter) {
            $output .= "\\jitter($this->jitter)";
        }

        if (isset($this->pos['x'], $this->pos['y'])) {
            $output .= \sprintf('\\pos(%s,%s)', $this->pos['x'], $this->pos['y']);
        }

        if (isset(
            $this->move['x1'],
            $this->move['y1'],
            $this->move['x2'],
            $this->move['y2']
        )) {
            $hasTime = isset($this->move['startTime'], $this->move['endTime']);

            if ($hasTime) {
                $output .= \sprintf(
                    '\\move(%s,%s,%s,%s,%s,%s)',
                    $this->move['x1'],
                    $this->move['y1'],
                    $this->move['x2'],
                    $this->move['y2'],
                    $this->move['startTime'],
                    $this->move['endTime']
                );
            } else {
                $output .= \sprintf(
                    '\\move(%s,%s,%s,%s)',
                    $this->move['x1'],
                    $this->move['y1'],
                    $this->move['x2'],
                    $this->move['y2']
                );
            }
        }

        foreach ($this->colors as $i => $color) {
            $output .= \sprintf('\\%dc%s', $i, $color);
        }

        foreach ($this->gradients as $i => $gradient) {
            $output .= \sprintf('\\%dvc(%s)', $i, $gradient);
        }

        foreach ($this->alphas as $i => $alpha) {
            if (\is_int($alpha)) {
                $value = 255 - (int) round($alpha * 2.55);
                $hex = strtoupper(str_pad(dechex($value), 2, '0', \STR_PAD_LEFT));
                $tag = (0 === $i) ? '\\alpha' : \sprintf('\\%da', $i);
                $output .= \sprintf('%s&H%s&', $tag, $hex);
            } else {
                $tag = (0 === $i) ? '\\alpha' : \sprintf('\\%da', $i);
                $output .= \sprintf('%s%s', $tag, $alpha);
            }
        }

        foreach ($this->fades as $fade) {
            $output .= \sprintf('\\fade(%s,%s)', $fade['startTime'], $fade['endTime']);
        }

        return $output;
    }

    private function gradient(string $color = '', string $leftTop = '', string $rightTop = '', string $leftBottom = '', string $rightBottom = ''): string
    {
        if (false === ('' === $color || '0' === $color)) {
            return $color;
        }

        if (('' === $leftTop || '0' === $leftTop) && ('' === $rightTop || '0' === $rightTop) && ('' === $leftBottom || '0' === $leftBottom) && ('' === $rightBottom || '0' === $rightBottom)) {
            throw new LogicException('You must provide all four corners of the gradient or a color.');
        }

        return \sprintf('\\__X__vc(%s,%s,%s,%s)', color($leftTop), color($rightTop), color($leftBottom), color($rightBottom));
    }
}
