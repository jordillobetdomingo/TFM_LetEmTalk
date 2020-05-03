<?php


namespace App\Component\ApiLet\Application\UseCase;


use App\Component\ApiLet\Application\Request\DeleteUserRequest;
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