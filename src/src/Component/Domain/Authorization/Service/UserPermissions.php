<?php


namespace LetEmTalk\Component\Domain\Authorization\Service;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;

class UserPermissions
{
    private UserAuthorization $userAuthorization;
    private int $userId;

    public function __construct(UserAuthorization $userAuthorization, int $userId)
    {
        $this->userAuthorization = $userAuthorization;
        $this->userId = $userId;
    }

    public function getEditPill(Pill $pill): bool
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

    public function getAddPill(Issue $issue): bool
    {
        return $this->userAuthorization->hasIssueAccess(
            $this->userId,
            $issue->getId(),
            UserAuthorization::ACTION_WRITE
        );
    }
    
    public function getEditIssue(Issue $issue): bool
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
}