<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use Doctrine\ORM\EntityRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class DoctrineIssueRepository extends EntityRepository implements IssueRepository
{

    public function save(Issue $issue): void
    {
        $this->getEntityManager()->persist($issue);
        $this->getEntityManager()->flush();
    }

    public function getIssue(int $issueId): Issue
    {
        return $this->findOneBy(["id" => $issueId]);
    }

    public function getIssuesByRoom(Room $room): array
    {
        return $this->findBy(["room" => $room]);
    }

    public function delete(int $issueId): void
    {
        $issueReference = $this->getEntityManager()->getReference($this->getClassName(), $issueId);
        $this->getEntityManager()->remove($issueReference);
        $this->getEntityManager()->flush();
    }
}