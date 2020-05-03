<?php


namespace App\Component\ApiLet\Domain\User\Entity;


class Role
{
    private $id;
    private $name;
    private $permission_repository_write;
    private $permission_repository_manage;
    private $permission_issue_read;
    private $permission_issue_write;
    private $permission_issue_manage;
}