<?php


namespace LetEmTalk\Component\Domain\Chat\Repository;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Room;

Interface IssueRepository
{
    public function save(Issue $issue): void;

    public function getIssue(int $issueId, bool $noCache = false): Issue;

    public function getIssuesByRoom(Room $room): array;

    public function delete(int $issueId): void;
}