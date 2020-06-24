<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\User;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmtalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class RedisUserRepository extends RedisRepository implements UserRepository
{
    const KEY_USER_NAME = array("user");

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function save(User $user): void
    {
        $this->userRepository->save($user);
        $this->set(new RedisKey(self::KEY_USER_NAME, array($user->getId())), $user);
    }

    public function delete(int $userId): void
    {
        $this->userRepository->delete($userId);
        $this->del(new RedisKey(self::KEY_USER_NAME, array($userId)));
    }

    public function findAllUsers(): array
    {
        return $this->userRepository->findAllUsers();
    }

    public function getUser(int $userId, bool $noCache = false): ?User
    {
        $key = new RedisKey(self::KEY_USER_NAME, array($userId));
        if ($this->exists($key) && !$noCache) {
            return $this->get($key);
        } else {
            $user = $this->userRepository->getUser($userId);
            $this->set($key, $user);
            return $user;
        }
    }
}