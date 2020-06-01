<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\User\UseCase\ReadUsersUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReadUsersController
{
    private ReadUsersUseCase $readUsersUseCase;

    private SessionInterface $session;

    public function __construct(ReadUsersUseCase $readUsersUseCase, SessionInterface $session)
    {
        $this->readUsersUseCase = $readUsersUseCase;
        $this->session = $session;
    }

    public function execute(Request $request): Response
    {
        $response = $this->readUsersUseCase->execute();
        return new JsonResponse($response->getUsersAsArray(), 200);
    }
}