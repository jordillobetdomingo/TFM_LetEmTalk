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

    public function getRoom(int $roomId): Room
    {
        return $this->findOneBy(["id" => $roomId]);
    }

    public function delete(int $roomId): void
    {
        $roomReference = $this->getEntityManager()->getReference($this->getClassName(), $roomId);
        $this->getEntityManager()->remove($roomReference);
        $this->getEntityManager()->flush();
    }
}