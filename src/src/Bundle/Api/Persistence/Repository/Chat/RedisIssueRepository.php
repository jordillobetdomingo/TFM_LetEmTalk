<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class RedisIssueRepository extends RedisRepository implements IssueRepository
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
        $this->set(new RedisKey(self::KEY_ISSUE_NAME, array($issue->getId())), $issue);
    }

    public function getIssue(int $issueId, bool $noCache = false): Issue
    {
        $key = new RedisKey(self::KEY_ISSUE_NAME, array($issueId));
        if($this->exists($key) && !$noCache) {
            return $this->get($key);
        }
        else {
            $issue = $this->issueRepository->getIssue($issueId);
            $this->set($key, $issue);
            return $issue;
        }
    }

    public function getIssuesByRoom(Room $room): array
    {
        $key = new RedisKey(self::KEY_ISSUES_ROOM_NAME, array($room->getId()));
        if($this->exists($key)) {
            return $this->get($key);
        } else {
            $listIssuesByRoom = $this->issueRepository->getIssuesByRoom($room);
            $this->setList($key, $listIssuesByRoom);
            return $listIssuesByRoom;
        }
    }

    public function delete(int $issueId): void
    {
        $this->del(new RedisKey(self::KEY_ISSUE_NAME, array($issueId)));
        $this->issueRepository->delete($issueId);
    }
}