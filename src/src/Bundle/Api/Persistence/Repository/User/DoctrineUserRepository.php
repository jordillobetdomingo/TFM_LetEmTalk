<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\User;


use LetEmTalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\Repository\UserOwnRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserOwnRepository
{
    public function save(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function delete(int $userId): void
    {
        $userReference = $this->getEntityManager()->getReference($this->getClassName(), $userId);
        $this->getEntityManager()->remove($userReference);
        $this->getEntityManager()->flush();
    }

    public function findAllUsers(): array
    {
        $users = $this->findAll();
        return $users;
    }
}