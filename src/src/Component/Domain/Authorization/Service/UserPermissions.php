<?php


namespace LetEmTalk\Component\Domain\Authorization\Service;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Entity\Room;

class UserPermissions
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

    public function allowReadPill(Pill $pill): bool
    {
        return $this->userAuthorization->hasIssueAccess(
            $this->userId,
            $pill->getIssue()->getId(),
            UserAuthorization::ACTION_READ
        );
    }

    public function allowCreatePill(Issue $issue): bool
    {
        return $this->userAuthorization->hasIssueAccess(
            $this->userId,
            $issue->getId(),
            UserAuthorization::ACTION_WRITE
        );
    }

    public function allowUpdatePill(Pill $pill): bool
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

    public function allowDeletePill(Pill $pill): bool
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

    public function allowReadIssue(Issue $issue): bool
    {
        return $this->userAuthorization->hasIssueAccess($this->userId, $issue->getId(), UserAuthorization::ACTION_READ);
    }

    public function allowCreateIssue(Room $room): bool
    {
        return $this->userAuthorization->hasRoomAccess(
            $this->userId,
            $room->getId(),
            UserAuthorization::ACTION_WRITE
        );
    }

    public function allowUpdateIssue(Issue $issue): bool
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

    public function allowDeleteIssue(Issue $issue): bool
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

    public function allowReadRoom(Room $room): bool
    {
        return $this->userAuthorization->hasRoomAccess($this->userId, $room->getId(), UserAuthorization::ACTION_READ);
    }
}