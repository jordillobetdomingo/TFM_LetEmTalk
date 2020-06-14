<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\User\Request\ReadUserRequest;
use LetEmTalk\Component\Application\User\UseCase\ReadUserUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class ReadUserController
{
    private ReadUserUseCase $readUserUseCase;
    private Security $security;

    public function __construct(ReadUserUseCase $readUserUseCase, Security $security)
    {
        $this->readUserUseCase = $readUserUseCase;
        $this->security = $security;
    }

    public function execute(): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        try {
            $response = $this->readUserUseCase->execute(new ReadUserRequest($user->getUserId()));
            return new JsonResponse($response->getUserAsArray(), Response::HTTP_OK);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
    }
}