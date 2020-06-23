<?php


namespace LetEmTalk\Component\Domain\User\Repository;

use LetEmtalk\Component\Domain\User\Entity\User;

interface UserRepository
{
    public function save(User $user): void;

    public function delete(int $userId): void;

    public function findAllUsers(): array;

    public function getUser(int $userId, bool $noCache = false): ?User;
}