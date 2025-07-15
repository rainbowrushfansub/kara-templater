<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Enum;

enum Mode: string
{
    case PRELINE = 'preline';

    case LINE = 'line';

    case START2SYL = 'start2syl';

    case PRESYL = 'presyl';

    case SYL = 'syl';

    case POSTSYL = 'postsyl';

    case SYL2END = 'syl2end';

    case POSTLINE = 'postline';
}
