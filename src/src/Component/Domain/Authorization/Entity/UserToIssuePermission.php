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

}