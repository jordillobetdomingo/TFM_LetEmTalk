<?php


namespace App\Component\ApiLet\Application\UseCase;


use App\Component\ApiLet\Application\Request\CreateUserRequest;
use App\Component\ApiLet\Domain\User\Entity\User;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;

class CreateUser
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request)
    {
        $user = new User($request->getId(), $request->getFirstName(), $request->getLastName(), $request->getEmail());

        $this->userRepository->save($user);
    }
}