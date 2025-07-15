<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Components;

use RainbowRush\KaraTemplater\Enum\Component;

final class Code extends AbstractComponent
{
    public function __construct()
    {
        $this->component = Component::CODE;
    }
}
