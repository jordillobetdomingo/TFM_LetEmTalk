<?php


namespace LetEmTalk\Component\Domain\Authorization\Entity;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\User\Entity\User;

class UserToIssuePermission
{
    private User $user;
    private Issue $issue;
    private bool $permissionRead;
    private bool $permissionWrite;
    private bool $permissionManage;

    public function __construct(User $user, Issue $issue, Role $role)
    {
        $this->user = $user;
        $this->issue = $issue;
        $this->permissionRead = $role->getPermissionIssueRead();
        $this->permissionWrite = $role->getPermissionIssueWrite();
        $this->permissionManage = $role->getPermissionIssueManage();
    }

}