<?php


namespace App\Component\ApiLet\Application\User\UseCase;


use App\Component\ApiLet\Application\User\Request\DeleteUserRequest;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;

class DeleteUser
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(DeleteUserRequest $request)
    {
        $this->userRepository->delete($request->getUserId());
    }
}