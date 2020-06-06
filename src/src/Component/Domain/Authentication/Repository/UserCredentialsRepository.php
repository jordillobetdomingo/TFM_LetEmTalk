<?php


namespace LetEmTalk\Component\Domain\Authentication\Repository;


use LetEmTalk\Component\Domain\Authentication\Entity\UserCredentials;

interface UserCredentialsRepository
{
    public function save(UserCredentials $userCredentials): void;

    public function getUserCredentialsByUsername(string $username): ?UserCredentials;
}