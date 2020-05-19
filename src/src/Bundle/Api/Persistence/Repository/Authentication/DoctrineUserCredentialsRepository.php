<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authentication;


use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Authentication\Entity\UserCredentials;
use LetEmTalk\Component\Domain\Authentication\Repository\UserCredentialsRepository;

class DoctrineUserCredentialsRepository extends EntityRepository implements UserCredentialsRepository
{

    public function save(UserCredentials $userCredentials): void
    {
        $this->getEntityManager()->persist($userCredentials);
        $this->getEntityManager()->flush();
    }
}