<?php


namespace LetEmTalk\Component\Domain\Authorization\Service;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Entity\Room;

class UserPermission
{
    private UserAuthorization $userAuthorization;
    private int $userId;

    public function __construct(UserAuthorization $userAuthorization, int $userId)
    {
        $this->userAuthorization = $userAuthorization;
        if (!$this->userAuthorization->existUser($userId)) {
            throw new \InvalidArgumentException();
        }
        $this->userId = $userId;
    }

    public function hasReadPillPermission(Pill $pill): bool
    {
        return $this->userAuthorization->hasIssueAccess(
            $this->userId,
            $pill->getIssue()->getId(),
            UserAuthorization::ACTION_READ
        );
    }

    public function hasCreatePillPermission(Issue $issue): bool
    {
        return $this->userAuthorization->hasIssueAccess(
            $this->userId,
            $issue->getId(),
            UserAuthorization::ACTION_WRITE
        );
    }

    public function hasUpdatePillPermission(Pill $pill): bool
    {
        return $this->userAuthorization->hasIssueAccess(
                $this->userId,
                $pill->getIssue()->getId(),
                UserAuthorization::ACTION_MANAGE
            ) || ($this->userAuthorization->hasIssueAccess(
                    $this->userId,
                    $pill->getIssue()->getId(),
                    UserAuthorization::ACTION_WRITE
                ) && ($this->userId == $pill->getAuthor()->getId()));
    }

    public function hasDeletePillPermission(Pill $pill): bool
    {
        // if the pill is the first of the issue it isn't be able to delete
        if ($pill === $pill->getIssue()->getFirstPill()) return false;

        return $this->userAuthorization->hasIssueAccess(
                $this->userId,
                $pill->getIssue()->getId(),
                UserAuthorization::ACTION_MANAGE
            ) || ($this->userAuthorization->hasIssueAccess(
                    $this->userId,
                    $pill->getIssue()->getId(),
                    UserAuthorization::ACTION_WRITE
                ) && ($this->userId == $pill->getAuthor()->getId()));
    }

    public function hasReadIssuePermission(Issue $issue): bool
    {
        return $this->userAuthorization->hasIssueAccess($this->userId, $issue->getId(), UserAuthorization::ACTION_READ);
    }

    public function hasCreateIssuePermission(Room $room): bool
    {
        return $this->userAuthorization->hasRoomAccess(
            $this->userId,
            $room->getId(),
            UserAuthorization::ACTION_WRITE
        );
    }

    public function hasUpdateIssuePermission(Issue $issue): bool
    {
        return $this->userAuthorization->hasIssueAccess(
                $this->userId,
                $issue->getId(),
                UserAuthorization::ACTION_MANAGE
            ) || ($this->userAuthorization->hasIssueAccess(
                    $this->userId,
                    $issue->getId(),
                    UserAuthorization::ACTION_WRITE
                ) && ($this->userId == $issue->getFirstPill()->getAuthor()->getId()));
    }

    public function hasDeleteIssuePermission(Issue $issue): bool
    {
        return $this->userAuthorization->hasIssueAccess(
                $this->userId,
                $issue->getId(),
                UserAuthorization::ACTION_MANAGE
            ) || ($this->userAuthorization->hasIssueAccess(
                    $this->userId,
                    $issue->getId(),
                    UserAuthorization::ACTION_WRITE
                ) && ($this->userId == $issue->getFirstPill()->getAuthor()->getId()));
    }

    public function hasReadRoomPermission(Room $room): bool
    {
        return $this->userAuthorization->hasRoomAccess($this->userId, $room->getId(), UserAuthorization::ACTION_READ);
    }
}