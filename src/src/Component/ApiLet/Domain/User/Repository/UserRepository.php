<?php


namespace App\Component\ApiLet\Domain\User\Repository;


use App\Component\ApiLet\Domain\User\Entity\User;

interface UserRepository
{
    public function save(User $user);
}