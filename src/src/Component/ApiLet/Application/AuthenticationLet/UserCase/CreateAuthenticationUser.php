<?php


namespace App\Component\ApiLet\Application\AuthenticationLet\UserCase;


use App\Component\ApiLet\Application\AuthenticationLet\Request\CreateAuthenticationRequest;
use App\Component\ApiLet\Domain\AuthenticationLet\Entity\Authentication;

class CreateAuthenticationUser
{
    private $authenticationRepository;

    public function __construct(Authentication $authentication)
    {
        $this->authenticationRepository = $authentication;
    }

    public function execute(CreateAuthenticationRequest $request): void
    {
        $authentication = new Authentication($request->getUsername(), $request->getPassword(), $request->getUser());
        $this->authenticationRepository->save($authentication);
    }
}