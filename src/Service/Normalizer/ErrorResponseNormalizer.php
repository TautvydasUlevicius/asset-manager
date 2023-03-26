<?php

declare(strict_types=1);

namespace App\Service\Normalizer;

use App\Controller\Response\ErrorResponse;

class ErrorResponseNormalizer implements DenormalizerInterface
{
    /**
     * @param ErrorResponse $data
     *
     * @return array
     */
    public function denormalize(object $data): array
    {
        return [
            'code' => $data->getCode(),
            'message' => $data->getMessage(),
        ];
    }
}
