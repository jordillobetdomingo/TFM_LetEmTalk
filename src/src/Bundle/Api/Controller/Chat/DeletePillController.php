<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\DeletePillRequest;
use LetEmTalk\Component\Application\Chat\UseCase\DeletePillUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeletePillController
{
    private DeletePillUseCase $deletePillUseCase;
    private Security $security;

    public function __construct(DeletePillUseCase $deletePillUseCase, Security $security)
    {
        $this->deletePillUseCase = $deletePillUseCase;
        $this->security = $security;
    }

    public function execute(int $pillId): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        try {
            $this->deletePillUseCase->execute(new DeletePillRequest($pillId, $user->getUserId()));
            return new Response('', Response::HTTP_NO_CONTENT);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
    }

}