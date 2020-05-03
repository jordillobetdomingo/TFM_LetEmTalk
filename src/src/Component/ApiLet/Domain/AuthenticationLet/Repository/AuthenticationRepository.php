<?php


namespace App\Component\ApiLet\Domain\AuthenticationLet\Repository;


use App\Component\ApiLet\Domain\AuthenticationLet\Entity\Authentication;

interface AuthenticationRepository
{
    public function save(Authentication $authentication): void;

    public function getAuthentication(string $username, string $password): ?Authentication;
}