<?php


namespace LetEmTalk\Component\Application\Authorization\UseCase;


use LetEmTalk\Component\Application\Authorization\Request\DeleteUserToIssuePermissionRequest;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;

class DeleteUserToIssuePermissionUseCase
{
    private UserToIssuePermissionRepository $userToIssuePermissionRepository;

    public function __construct(UserToIssuePermissionRepository $userToIssuePermissionRepository)
    {
        $this->userToIssuePermissionRepository = $userToIssuePermissionRepository;
    }

    public function execute(DeleteUserToIssuePermissionRequest $request)
    {
        $this->userToIssuePermissionRepository->delete($request->getUserId(), $request->getIssueId());
    }

}