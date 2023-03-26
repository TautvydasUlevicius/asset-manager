<?php

declare(strict_types=1);

namespace App\Service\Normalizer;

interface NormalizerInterface
{
    public function normalize(string $json): object;
}
