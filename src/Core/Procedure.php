<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use Override;
use RainbowRush\KaraTemplater\Components\Code;
use RainbowRush\KaraTemplater\Enum\Scope;
use Stringable;

final class Procedure implements Stringable
{
    private Scope $scope = Scope::ONCE;

    public function __construct(private readonly string $content)
    {
    }

    #[Override]
    public function __toString(): string
    {
        $code = (new Code())->procedure(minify_lua($this->content));

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
