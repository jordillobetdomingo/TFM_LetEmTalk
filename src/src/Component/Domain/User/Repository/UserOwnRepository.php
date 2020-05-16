<?php


namespace LetEmTalk\Component\Domain\User\Repository;

use LetEmtalk\Component\Domain\User\Entity\User;

interface UserOwnRepository
{
    public function save(User $user): void;

    public function delete(int $userId): void;

    public function findAllUsers(): array;
}