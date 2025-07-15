<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use Override;
use RainbowRush\KaraTemplater\Components\Code;
use RainbowRush\KaraTemplater\Enum\Scope;
use Stringable;

final class Invocable implements Stringable
{
    private Scope $scope = Scope::ONCE;

    public function __construct(private readonly string $expression)
    {
    }

    #[Override]
    public function __toString(): string
    {
        $code = (new Code())->invoke($this->expression);

        if (Scope::ONCE === $this->scope) {
            $code->once();
        }

        return (string) $code;
    }

    public function once(): self
    {
        $this->scope = Scope::ONCE;

        return $this;
    }
}
