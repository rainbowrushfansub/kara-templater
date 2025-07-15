<?php

declare(strict_types=1);

namespace RainbowRush\KaraTemplater\Core;

use RuntimeException;
use SplFileInfo;

final readonly class TemplateWriter
{
    public function __construct(
        private string $outputDir,
        private string $baseFilePath,
    ) {
        if (false === is_file($baseFilePath) || false === is_readable($baseFilePath)) {
            throw new RuntimeException('File base not found or not readable.');
        }
    }

    public function write(KaraTemplater $template): SplFileInfo
    {
        $this->ensureDirectoryExists($this->outputDir);

        $content = $template->buildTemplate();
        $fileName = $template->getName().'.ass';
        $fullPath = $this->outputDir.\DIRECTORY_SEPARATOR.$fileName;

        $baseFile = file_get_contents($this->baseFilePath);

        if (false === \is_string($baseFile)) {
            throw new RuntimeException('Could not read the base file.');
        }

        $finalContent = str_replace('__FILE_CONTENTS__', $content, $baseFile);

        $bytesWritten = file_put_contents($fullPath, $finalContent);

        if (false === $bytesWritten) {
            throw new RuntimeException('Could not save the template.');
        }

        return new SplFileInfo($fullPath);
    }

    private function ensureDirectoryExists(string $directory): void
    {
        if (false === is_dir($directory) && false === mkdir($directory, 0775, true)) {
            throw new RuntimeException('Could not create directory.');
        }
    }
}
