<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Enum;

enum Component: string
{
    case CODE = 'code';

    case TEMPLATE = 'template';

    case MIXIN = 'mixin';
}
