<?php


namespace LetEmTalk\Component\Domain\AuthenticationLet\Repository;


use LetEmTalk\Component\Domain\AuthenticationLet\Entity\Authentication;

interface AuthenticationRepository
{
    public function save(Authentication $authentication): void;

    public function getAuthentication(string $username, string $password): ?Authentication;
}