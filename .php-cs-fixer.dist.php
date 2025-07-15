<?php

declare(strict_types=1);

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->append([__FILE__])
    ->exclude(['vendor']);

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'void_return' => true,
        'ordered_class_elements' => true,
        'php_unit_method_casing' => true,
        'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
        'global_namespace_import' => true,
        'declare_strict_types' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder);
