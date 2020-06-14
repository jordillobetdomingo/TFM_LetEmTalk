<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\CreateUserToIssuePermissionRequest;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToIssuePermission;
use LetEmTalk\Component\Domain\Authorization\Repository\RoleRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreateUserToIssuePermissionUseCase
{
    private UserToIssuePermissionRepository $userToIssuePermissionRepository;
    private UserRepository $userRepository;
    private IssueRepository $issueRepository;
    private RoleRepository $roleRepository;

    public function __construct(
        UserToIssuePermissionRepository $userToIssuePermissionRepository,
        UserRepository $userRepository,
        IssueRepository $issueRepository,
        RoleRepository $roleRepository
    ) {
        $this->userToIssuePermissionRepository = $userToIssuePermissionRepository;
        $this->userRepository = $userRepository;
        $this->issueRepository = $issueRepository;
        $this->roleRepository = $roleRepository;
    }

    public function execute(CreateUserToIssuePermissionRequest $request): void
    {
        $user = $this->userRepository->getUser($request->getUserId());
        $issue = $this->issueRepository->getIssue($request->getIssueId());
        $role = $this->roleRepository->getRole($request->getRoleId());
        $userToIssuePermission = new UserToIssuePermission(
            $user,
            $issue,
            $role->getPermissionIssueRead(),
            $role->getPermissionIssueWrite(),
            $role->getPermissionIssueManage()
        );
        $this->userToIssuePermissionRepository->save($userToIssuePermission);
    }

}