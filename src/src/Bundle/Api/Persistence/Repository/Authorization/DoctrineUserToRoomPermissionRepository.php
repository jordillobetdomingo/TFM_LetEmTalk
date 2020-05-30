<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToRoomPermission;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;

class DoctrineUserToRoomPermissionRepository extends EntityRepository implements UserToRoomPermissionRepository
{
    public function save(UserToRoomPermission $userToRoomPermission): void
    {
        $this->getEntityManager()->persist($userToRoomPermission);
        $this->getEntityManager()->flush();
    }

    public function delete(int $userId, int $roomId): void
    {
        $userToRoomPermission = $this->findOneBy(["user" => $userId, "room" => $roomId]);
        $this->getEntityManager()->remove($userToRoomPermission);
        $this->getEntityManager()->flush();
    }
}