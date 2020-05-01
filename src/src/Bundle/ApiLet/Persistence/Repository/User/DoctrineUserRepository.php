<?php


namespace App\Bundle\ApiLet\Persistence\Repository\User;


use App\Component\ApiLet\Domain\User\Entity\User;
use App\Component\ApiLet\Domain\User\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function save(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}