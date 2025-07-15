<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Components;

use RainbowRush\KaraTemplater\Enum\Component;

final class Template extends AbstractComponent
{
    public function __construct()
    {
        $this->component = Component::TEMPLATE;
    }
}
