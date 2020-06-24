<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authentication;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Authentication\Entity\UserCredentials;
use LetEmTalk\Component\Domain\Authentication\Repository\UserCredentialsRepository;

class RedisUserCredentialsRepository extends RedisRepository implements UserCredentialsRepository
{
    const KEY_CREDENTIALS_NAME = array("userCredentials");

    private UserCredentialsRepository $userCredentialsRepository;

    public function __construct(UserCredentialsRepository $userCredentialsRepository)
    {
        parent::__construct();
        $this->userCredentialsRepository = $userCredentialsRepository;
    }

    public function save(UserCredentials $userCredentials): void
    {
        $this->userCredentialsRepository->save($userCredentials);
        $this->set(new RedisKey(self::KEY_CREDENTIALS_NAME, array($userCredentials->getUsername())), $userCredentials);
    }

    public function getUserCredentialsByUsername(string $username): ?UserCredentials
    {
        $key = new RedisKey(self::KEY_CREDENTIALS_NAME, array($username));
        if ($this->exists($key)) {
            return $this->get($key);
        } else {
            $userCredentials = $this->userCredentialsRepository->getUserCredentialsByUsername($username);
            $this->set($key, $userCredentials);
            return $userCredentials;
        }
    }
}