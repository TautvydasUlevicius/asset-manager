<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Response\ErrorResponse;
use App\Entity\User;
use App\Exception\ApiException;
use App\Service\Normalizer\ErrorResponseNormalizer;
use App\Service\Normalizer\UserNormalizer;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private LoggerInterface $logger;
    private UserNormalizer $userNormalizer;
    private EntityManagerInterface $entityManager;
    private ErrorResponseNormalizer $errorResponseNormalizer;

    public function __construct(
        UserNormalizer $userNormalizer,
        EntityManagerInterface $entityManager,
        ErrorResponseNormalizer $errorResponseNormalizer,
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
        $this->entityManager = $entityManager;
        $this->userNormalizer = $userNormalizer;
        $this->errorResponseNormalizer = $errorResponseNormalizer;
    }

    /**
     * @Route("/v1/users", name="create_user", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        // TODO: ApiException here could be thrown also if we add handling of such exception to listeners
        try {
            $createUserRequest = $this->userNormalizer->normalize($request->getContent());
        } catch (ApiException $exception) {
            $errorResponse = new ErrorResponse(Response::HTTP_BAD_REQUEST, $exception->getMessage());

            return new JsonResponse($this->errorResponseNormalizer->denormalize($errorResponse), Response::HTTP_BAD_REQUEST);
        }

        $user = new User($createUserRequest->getEmail());
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (UniqueConstraintViolationException $exception) {
            $errorResponse = new ErrorResponse(Response::HTTP_BAD_REQUEST, 'Failed to create user');

            return new JsonResponse($this->errorResponseNormalizer->denormalize($errorResponse), Response::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            $this->logger->error('Failed to create user: ' . $exception->getMessage());
            $errorResponse = new ErrorResponse(Response::HTTP_BAD_REQUEST, 'Failed to create user');

            return new JsonResponse($this->errorResponseNormalizer->denormalize($errorResponse), Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse($this->userNormalizer->denormalize($user), Response::HTTP_CREATED);
    }
}
