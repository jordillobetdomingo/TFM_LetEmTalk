<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;



use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class DoctrineRoomRepository extends EntityRepository implements RoomRepository
{

    public function save(Room $room): void
    {
        $this->getEntityManager()->persist($room);
        $this->getEntityManager()->flush();
    }
}