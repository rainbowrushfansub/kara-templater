<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use Override;
use RainbowRush\KaraTemplater\Components\Code;
use Stringable;

final readonly class Requirement implements Stringable
{
    public function __construct(
        private string $name,
        private string $file,
    ) {
    }

    #[Override]
    public function __toString(): string
    {
        return (string) (new Code())->once()->require($this->name, $this->file);
    }
}
