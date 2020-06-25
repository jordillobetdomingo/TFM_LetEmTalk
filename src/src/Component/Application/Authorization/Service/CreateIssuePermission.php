<?php


namespace LetEmTalk\Component\Application\Authorization\Service;

use LetEmTalk\Component\Domain\Authorization\Entity\UserToIssuePermission;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;

class CreateIssuePermission
{
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
        $userToRoomPermission = $this->userToRoomPermissionRepository->getRoomPermission(
            $issue->getFirstPill()->getAuthor()->getId(),
            $issue->getRoom()->getId()
        );
        $userToIssuePermission = new UserToIssuePermission(
            $issue->getFirstPill()->getAuthor(),
            $issue,
            $userToRoomPermission->getRole()->getPermissionIssueRead(),
            $userToRoomPermission->getRole()->getPermissionIssueWrite(),
            $userToRoomPermission->getRole()->getPermissionIssueManage()
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
                $userToRoomPermission->getRole()->getPermissionIssueRead(),
                $userToRoomPermission->getRole()->getPermissionIssueWrite(),
                $userToRoomPermission->getRole()->getPermissionIssueManage()
            );

            $this->userTotIssuePermissionRepository->save($userToIssuePermission);
        }
    }
}