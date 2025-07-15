<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Enum;

enum Scope: string
{
    case ONCE = 'once';

    case LINE = 'line';

    case SYL = 'syl';

    case WORD = 'word';

    case CHAR = 'char';
}
