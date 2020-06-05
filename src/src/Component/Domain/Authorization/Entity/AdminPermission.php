<?php


namespace LetEmTalk\Component\Domain\Authorization\Entity;


use LetEmTalk\Component\Domain\User\Entity\User;

class AdminPermission
{
    private User $user;
    private bool $adminPermission;

    public function getAdminPermission(): bool
    {
        return $this->adminPermission;
    }
}