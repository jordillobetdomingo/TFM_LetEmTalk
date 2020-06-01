<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\UseCase\ReadRolesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ReadRolesController
{
    private ReadRolesUseCase $readRolesUseCase;
    private SessionInterface $session;

    public function __construct(ReadRolesUseCase $readRolesUseCase, SessionInterface $session)
    {
        $this->readRolesUseCase = $readRolesUseCase;
        $this->session = $session;
    }

    public function execute(): Response
    {
        return new JsonResponse($this->readRolesUseCase->execute()->getRolesAsArray(), 200);
    }
}