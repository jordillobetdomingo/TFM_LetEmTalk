<?php


namespace LetEmTalk\Component\Domain\Authorization\Service;

use LetEmTalk\Component\Domain\Authorization\Entity\UserToIssuePermission;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;

class ManageIssuePermission
{
    const PERMISSION_READ_ISSUE_OWNER_DEFAULT = true;
    const PERMISSION_WRITE_ISSUE_OWNER_DEFAULT = true;
    const PERMISSION_MANAGE_ISSUE_OWNER_DEFAULT = false;
    const PERMISSION_READ_ISSUE_MANAGER_DEFAULT = true;
    const PERMISSION_WRITE_ISSUE_MANAGER_DEFAULT = true;
    const PERMISSION_MANAGE_ISSUE_MANAGER_DEFAULT = true;

    private UserToIssuePermissionRepository $userTotIssuePermissionRepository;
    private UserToRoomPermissionRepository $userToRoomPermissionRepository;

    public function __construct(
        UserToIssuePermissionRepository $userToIssuePermissionRepository,
        UserToRoomPermissionRepository $userToRoomPermissionRepository
    ) {
        $this->userTotIssuePermissionRepository = $userToIssuePermissionRepository;
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
    }

    public function addIssuePermissions(Issue $issue): void
    {
        $userToIssuePermission = new UserToIssuePermission(
            $issue->getFirstPill()->getAuthor(),
            $issue,
            self::PERMISSION_READ_ISSUE_OWNER_DEFAULT,
            self::PERMISSION_WRITE_ISSUE_OWNER_DEFAULT,
            self::PERMISSION_MANAGE_ISSUE_OWNER_DEFAULT
        );
        $this->userTotIssuePermissionRepository->save($userToIssuePermission);

        $this->addIssuePermissionsByManagerRoom($issue);
    }

    private function addIssuePermissionsByManagerRoom(Issue $issue): void
    {
        $userToRoomPermissions = $this->userToRoomPermissionRepository->getUserByManageRoom($issue->getRoom());
        foreach ($userToRoomPermissions as $userToRoomPermission) {
            $userToIssuePermission = new UserToIssuePermission(
                $userToRoomPermission->getUser(),
                $issue,
                self::PERMISSION_READ_ISSUE_MANAGER_DEFAULT,
                self::PERMISSION_WRITE_ISSUE_MANAGER_DEFAULT,
                self::PERMISSION_MANAGE_ISSUE_MANAGER_DEFAULT
            );

            $this->userTotIssuePermissionRepository->save($userToIssuePermission);
        }
    }
}