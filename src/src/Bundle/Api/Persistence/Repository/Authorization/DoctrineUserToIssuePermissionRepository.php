<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToIssuePermission;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;

class DoctrineUserToIssuePermissionRepository extends EntityRepository implements UserToIssuePermissionRepository
{

    public function save(UserToIssuePermission $userToIssuePermission): void
    {
        $this->getEntityManager()->persist($userToIssuePermission);
        $this->getEntityManager()->flush();
    }

    public function delete(int $userId, int $issueId): void
    {
        $userToIssuePermission = $this->findOneBy(["user" => $userId, "issue" => $issueId]);
        $this->getEntityManager()->remove($userToIssuePermission);
        $this->getEntityManager()->flush();
    }

    public function getIssuePermission(int $userId, int $issueId): ?UserToIssuePermission
    {
        return $this->findOneBy(["user" => $userId, "issue" => $issueId]);
    }

    public function getIssuesPermissionByUser(int $userId): array
    {
        return $this->findBy(["user" => $userId]);
    }
}