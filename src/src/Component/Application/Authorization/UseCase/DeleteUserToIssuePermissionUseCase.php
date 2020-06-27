<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToIssuePermissionRequest;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Service\AdminAuthorization;

class DeleteUserToIssuePermissionUseCase
{
    private UserToIssuePermissionRepository $userToIssuePermissionRepository;
    private AdminAuthorization $adminAuthorization;

    public function __construct(
        UserToIssuePermissionRepository $userToIssuePermissionRepository,
        AdminAuthorization $adminAuthorization
    ) {
        $this->userToIssuePermissionRepository = $userToIssuePermissionRepository;
        $this->adminAuthorization = $adminAuthorization;
    }

    public function execute(DeleteUserToIssuePermissionRequest $request)
    {
        if (!$this->adminAuthorization->isAdmin($request->getUserIdentified())) {
            throw new \InvalidArgumentException();
        }
        $this->userToIssuePermissionRepository->delete($request->getUserId(), $request->getIssueId());
    }

}