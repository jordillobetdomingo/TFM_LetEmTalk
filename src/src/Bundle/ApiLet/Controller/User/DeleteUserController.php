<?php


namespace App\Bundle\ApiLet\Controller\User;


use App\Component\ApiLet\Application\User\Request\DeleteUserRequest;
use App\Component\ApiLet\Application\User\UseCase\DeleteUser;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController
{
    private $deleteUser;

    public function __construct(DeleteUser $deleteUser)
    {
        $this->deleteUser = $deleteUser;
    }

    public function execute(int $id): Response
    {
        $this->deleteUser->execute(new DeleteUserRequest($id));
        return new Response('The user has been deleted');
    }

}