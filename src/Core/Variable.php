<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use Override;
use RainbowRush\KaraTemplater\Enum\Scope;
use Stringable;

final class Variable implements Stringable
{
    private Scope $scope = Scope::ONCE;

    /**
     * @param scalar $value
     */
    public function __construct(
        private readonly string $name,
        private readonly mixed $value,
    ) {
    }

    #[Override]
    public function __toString(): string
    {
        $value = $this->value;

        if (str_contains((string) $value, '#') || str_contains((string) $value, '&')) {
            $value = '"'.$this->value.'"';
        }

        $line = Line::comment()
            ->effect("code {$this->scope->value}")
            ->content(\sprintf('%s = %s', $this->name, $value));

        return (string) $line;
    }

    public function once(): self
    {
        $this->scope = Scope::ONCE;

        return $this;
    }

    public function line(): self
    {
        $this->scope = Scope::LINE;

        return $this;
    }
}
