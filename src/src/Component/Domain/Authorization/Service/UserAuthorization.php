<?php


namespace LetEmTalk\Component\Domain\Authorization\Service;


use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\User\Entity\User;

class UserAuthorization
{
    const ACTION_READ = 1;
    const ACTION_WRITE = 2;
    const ACTION_MANAGE = 3;

    private UserToRoomPermissionRepository $userToRoomPermissionRepository;
    private UserToIssuePermissionRepository $userToIssuePermissionRepository;

    public function __construct(
        UserToRoomPermissionRepository $userToRoomPermissionRepository,
        UserToIssuePermissionRepository $userToIssuePermissionRepository
    ) {
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
        $this->userToIssuePermissionRepository = $userToIssuePermissionRepository;
    }

    public function hasRoomAccess(User $user, int $roomId, int $action): bool
    {
        $roomPermission = $this->userToRoomPermissionRepository->getRoomPermission($user->getId(), $roomId);
        if ($roomPermission == null) {
            return false;
        }
        switch ($action) {
            case self::ACTION_READ:
                return true;
            case self::ACTION_WRITE:
                return $roomPermission->hasRoomWritePermission();
            case self::ACTION_MANAGE:
                return $roomPermission->hasRoomManagePermission();
            default:
                throw new \InvalidArgumentException();
        }
    }

    public function hasIssueAccess(User $user, int $issueId, int $action): bool
    {
        $issuePermission = $this->userToIssuePermissionRepository->getIssuePermission($user->getId(), $issueId);
        if ($issuePermission == null) {
            return false;
        }
        switch ($action) {
            case self::ACTION_READ:
                return $issuePermission->hasIssueReadPermission();
            case self::ACTION_WRITE:
                return $issuePermission->hasIssueWritePermission();
            case self::ACTION_MANAGE:
                return $issuePermission->hasIssueManagePermission();
            default:
                throw new \InvalidArgumentException();
        }
    }
}