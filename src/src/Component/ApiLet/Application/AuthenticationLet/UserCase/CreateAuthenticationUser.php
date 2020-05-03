<?php


namespace App\Component\ApiLet\Application\AuthenticationLet\UserCase;


use App\Component\ApiLet\Application\AuthenticationLet\Request\CreateAuthenticationRequest;
use App\Component\ApiLet\Domain\AuthenticationLet\Entity\Authentication;
use App\Component\ApiLet\Domain\AuthenticationLet\Repository\AuthenticationRepository;

class CreateAuthenticationUser
{
    private $authenticationRepository;

    public function __construct(AuthenticationRepository $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function execute(CreateAuthenticationRequest $request): void
    {
        $authentication = new Authentication($request->getUsername(), $request->getPassword(), $request->getUser());
        $this->authenticationRepository->save($authentication);
    }
}