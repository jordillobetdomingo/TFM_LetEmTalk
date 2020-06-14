<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\User\Request\ReadUsersRequest;
use LetEmTalk\Component\Application\User\UseCase\ReadUsersUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class ReadUsersController
{
    private ReadUsersUseCase $readUsersUseCase;
    private Security $security;

    public function __construct(ReadUsersUseCase $readUsersUseCase, Security $security)
    {
        $this->readUsersUseCase = $readUsersUseCase;
        $this->security = $security;
    }

    public function execute(): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        try {
            $response = $this->readUsersUseCase->execute(new ReadUsersRequest($user->getUserId()));
            return new JsonResponse($response->getUsersAsArray(), Response::HTTP_OK);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
    }
}