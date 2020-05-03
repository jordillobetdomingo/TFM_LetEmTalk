<?php


namespace App\Component\ApiLet\Application\User\UseCase;


use App\Component\ApiLet\Application\User\Request\LoginRequest;
use App\Component\ApiLet\Domain\User\Entity\User;

interface Login
{
    public function login(LoginRequest $loginRequest): User;
}