<?php

declare(strict_types=1);

namespace App\Service\Normalizer;

interface DenormalizerInterface
{
    public function denormalize(object $data): array;
}
