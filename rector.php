<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/src',
        __DIR__.'/tests',
    ])
    ->withPhpSets(php84: true)
    ->withCodeQualityLevel(100)
    ->withImportNames(removeUnusedImports: true)
    ->withTypeCoverageLevel(100);
