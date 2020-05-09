<?php


namespace App\Bundle\ApiLet\Persistence\Repository\User;


use App\Component\ApiLet\Domain\User\Entity\User;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
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