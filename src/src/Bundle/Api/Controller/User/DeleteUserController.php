<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\User\Request\DeleteUserRequest;
use LetEmTalk\Component\Application\User\UseCase\DeleteUserUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeleteUserController
{
    private DeleteUserUseCase $deleteUserUseCase;
    private Security $security;

    public function __construct(DeleteUserUseCase $deleteUserUseCase, Security $security)
    {
        $this->deleteUserUseCase = $deleteUserUseCase;
        $this->security = $security;
    }

    public function execute(int $id): Response
    {
        $userIdentified = $this->security->getUser()->getUserId();
        try {
            $this->deleteUserUseCase->execute(new DeleteUserRequest($id, $userIdentified));
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
        return new Response('The user has been deleted', Response::HTTP_NO_CONTENT);
    }

}