<?php
$directories = [
    __DIR__ . '/src',
];

$finder = (new PhpCsFixer\Finder())
    ->in($directories)
    ->exclude(['var', '_data', '_output', '_generated'])
;

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        '@PSR12' => true,
        'yoda_style' => [
            'equal' => false,
            'identical' => false,
            'less_and_greater' => false,
        ],
        'increment_style' => [
            'style' => 'post',
        ],
        'single_line_throw' => false,
        'concat_space' => ['spacing' => 'one'],
        'no_superfluous_phpdoc_tags' => false,
        'phpdoc_align' => false,
        'phpdoc_summary' => false,
        'phpdoc_to_comment' => false,
        'ordered_class_elements' => [
            'order' => [
                'use_trait',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
            ],
        ],
        'phpdoc_order' => true,
        'logical_operators' => true,
        'global_namespace_import' => ['import_classes' => true, 'import_constants' => true, 'import_functions' => true],
        'no_useless_sprintf' => true,
        'phpdoc_line_span' => ['property' => 'multi'],
        'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
        'multiline_comment_opening_closing' => true,
        'array_indentation' => true,
        'operator_linebreak' => ['position' => 'beginning'],
        'no_superfluous_elseif' => true,
        'return_assignment' => true,
        'simplified_if_return' => true,
        'no_useless_else' => true,
    ])
    ->setFinder($finder)
    ->setCacheFile('.php-cs-fixer.cache') // forward compatibility with 3.x line
    ->setRiskyAllowed(true)
    ;
