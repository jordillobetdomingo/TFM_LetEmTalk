<?php


namespace LetEmTalk\Component\Domain\User\Entity;


class Role
{
    private int $id;
    private string $name;
    private bool $permissionRepositoryWrite;
    private bool $permissionRepositoryManage;
    private bool $permissionIssueRead;
    private bool $permissionIssueWrite;
    private bool $permissionIssueManage;
    private bool $createRepository;
}