<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class RedisInvalidateIssueRepository extends RedisRepository implements IssueRepository
{
    const KEY_ISSUE_NAME = array("issue");
    const KEY_ISSUES_ROOM_NAME = array("issuesRoom");

    private IssueRepository $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        parent::__construct();
        $this->issueRepository = $issueRepository;
    }

    public function save(Issue $issue): void
    {
        $this->issueRepository->save($issue);
        $this->del(new RedisKey(self::KEY_ISSUE_NAME, array($issue->getId())));
        $this->del(new RedisKey(self::KEY_ISSUES_ROOM_NAME, array($issue->getRoom()->getId())));
    }

    public function getIssue(int $issueId): Issue
    {
        return $this->issueRepository->getIssue($issueId);
    }

    public function getIssuesByRoom(Room $room): array
    {
        return $this->issueRepository->getIssuesByRoom($room);
    }

    public function delete(int $issueId): void
    {
        $this->del(new RedisKey(self::KEY_ISSUE_NAME, array($issueId)));
        $issue = $this->issueRepository->getIssue($issueId);
        $this->del(new RedisKey(self::KEY_ISSUES_ROOM_NAME, array($issue->getRoom()->getId())));
        $this->issueRepository->delete($issueId);
    }
}