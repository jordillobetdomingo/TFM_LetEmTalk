<?php


namespace App\Component\ApiLet\Application\AuthenticationLet\UserCase;


use App\Component\ApiLet\Application\User\Request\LoginRequest;
use App\Component\ApiLet\Application\User\UseCase\Login;
use App\Component\ApiLet\Domain\AuthenticationLet\Repository\AuthenticationRepository;
use App\Component\ApiLet\Domain\User\Entity\User;

class LoginAuthenticationLet implements Login
{
    private $authenticationRepository;

    public function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function login(LoginRequest $request): User
    {
        $authentication = $this->authenticationRepository->getAuthentication($request->getUsername(), $request->getPassword());
        if (!$authentication == null) return null;
        return $authentication->getUser();
    }
}