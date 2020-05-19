<?php


namespace LetEmTalk\Component\Application\User\UseCase;


use LetEmTalk\Component\Application\User\Request\LoginRequest;
use LetEmTalk\Component\Domain\User\Entity\User;

interface Login
{
    public function login(LoginRequest $loginRequest): ?User;
}