<?php


namespace LetEmTalk\Component\Domain\Authorization\Entity;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\User\Entity\User;

class UserToIssuePermission
{
    private User $user;
    private Issue $issue;
    private bool $readPermission;
    private bool $writePermission;
    private bool $managePermission;

    public function __construct(User $user, Issue $issue, bool $readPermission, bool $writePermission, bool $managePermission)
    {
        $this->user = $user;
        $this->issue = $issue;
        $this->readPermission = $readPermission;
        $this->writePermission = $writePermission;
        $this->managePermission = $managePermission;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getIssue(): Issue
    {
        return $this->issue;
    }

    public function hasIssueReadPermission(): bool
    {
        return $this->readPermission;
    }

    public function hasIssueWritePermission(): bool
    {
        return $this->writePermission;
    }

    public function hasIssueManagePermission(): bool
    {
        return $this->managePermission;
    }

}