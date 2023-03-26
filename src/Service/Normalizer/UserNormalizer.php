<?php

declare(strict_types=1);

namespace App\Service\Normalizer;

use App\Controller\Request\CreateUserRequest;
use App\Entity\User;
use App\Exception\ApiException;

class UserNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param string $json
     *
     * @return CreateUserRequest
     *
     * @throws ApiException
     */
    public function normalize(string $json): CreateUserRequest
    {
        $decoded = json_decode($json, true);

        if (!is_array($decoded)) {
            throw new ApiException('Failed to parse request body');
        }

        if (!isset($decoded['email'])) {
            throw new ApiException('Missing required field \'email\'');
        }

        return new CreateUserRequest($decoded['email']);
    }

    /**
     * @param User $data
     *
     * @return array
     */
    public function denormalize(object $data): array
    {
        return [
            'id' => $data->getUuid(),
            'email' => $data->getEmail(),
            'created_at' => $data->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $data->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
