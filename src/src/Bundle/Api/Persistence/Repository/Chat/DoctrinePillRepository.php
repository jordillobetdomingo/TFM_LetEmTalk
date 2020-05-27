<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class DoctrinePillRepository extends EntityRepository implements PillRepository
{

    public function save(Pill $pill): void
    {
        $this->getEntityManager()->persist($pill);
        $this->getEntityManager()->flush();
    }

    public function getPill(int $pillId): Pill
    {
        return $this->findOneBy(["id" => $pillId]);
    }
}