<?php


namespace LetEmTalk\Bundle\Api\Controller\Authorization;


use LetEmTalk\Component\Application\Authorization\UseCase\ReadRolesUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReadRolesController
{
    private ReadRolesUseCase $readRolesUseCase;

    public function __construct(ReadRolesUseCase $readRolesUseCase)
    {
        $this->readRolesUseCase = $readRolesUseCase;
    }

    public function execute(): Response
    {
        return new JsonResponse($this->readRolesUseCase->execute()->getRolesAsArray(), 200);
    }
}