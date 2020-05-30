<?php


namespace LetEmTalk\Bundle\Api\Controller\User;


use LetEmTalk\Component\Application\User\Request\DeleteUserRequest;
use LetEmTalk\Component\Application\User\UseCase\DeleteUserUseCase;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController
{
    private DeleteUserUseCase $deleteUserUseCase;

    public function __construct(DeleteUserUseCase $deleteUserUseCase)
    {
        $this->deleteUserUseCase = $deleteUserUseCase;
    }

    public function execute(int $id): Response
    {
        $this->deleteUserUseCase->execute(new DeleteUserRequest($id));
        return new Response('The user has been deleted', 204);
    }

}