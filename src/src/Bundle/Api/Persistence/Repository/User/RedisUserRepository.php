<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\User;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmtalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class RedisUserRepository extends RedisRepository implements UserRepository
{
    const KEY_USER = "user:{id}";
    const USER_ID_KEY = "{id}";

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    public function save(User $user): void
    {
        $this->userRepository->save($user);
        $this->set($user->getId(), $user);
    }

    public function delete(int $userId): void
    {
        $this->userRepository->delete($userId);
        $this->del($userId);
    }

    public function findAllUsers(): array
    {
        return $this->userRepository->findAllUsers();
    }

    public function getUser(int $userId): ?User
    {
        if ($this->exists($userId)) {
            return $this->get($userId);
        } else {
            $user = $this->userRepository->getUser($userId);
            $this->set($userId, $user);
            return $user;
        }
    }

    protected function getKey(int $id): string
    {
        return str_replace(self::USER_ID_KEY, strval($id), self::KEY_USER);
    }
}