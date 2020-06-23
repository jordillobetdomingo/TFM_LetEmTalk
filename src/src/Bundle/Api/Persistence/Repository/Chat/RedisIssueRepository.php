<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class RedisIssueRepository extends RedisRepository implements IssueRepository
{
    const KEY_ISSUE = "issue";

    private IssueRepository $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        parent::__construct();
        $this->issueRepository = $issueRepository;
    }

    public function save(Issue $issue): void
    {
        $this->issueRepository->save($issue);
        $this->set($issue->getId(), $issue);
    }

    public function getIssue(int $issueId, bool $noCache = false): Issue
    {
        if ($noCache) {
            return $this->issueRepository->getIssue($issueId);
        }
        if($this->exists($issueId)) {
            return $this->get($issueId);
        }
        else {
            $issue = $this->issueRepository->getIssue($issueId);
            $this->set($issueId, $issue);
            return $issue;
        }
    }

    public function getIssuesByRoom(Room $room): array
    {
        echo "roomid" . $room->getId() . "<br>";
        return $this->issueRepository->getIssuesByRoom($room);
    }

    public function delete(int $issueId): void
    {
        $this->del($issueId);
        $this->issueRepository->delete($issueId);
    }

    protected function getKey(int $id): string
    {
        return self::KEY_ISSUE . strval($id);
    }
}