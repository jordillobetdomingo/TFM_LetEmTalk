<?php


namespace LetEmTalk\Component\Domain\Authorization\UserAuthorization;


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
        switch ($action) {
            case self::ACTION_READ:
                return $this->userToRoomPermissionRepository->exist($user->getId(), $roomId);
            case self::ACTION_WRITE:
                return $this->userToRoomPermissionRepository->getRoomPermission(
                    $user->getId(),
                    $roomId
                )->hasRoomWritePermission();
            case self::ACTION_MANAGE:
                return $this->userToRoomPermissionRepository->getRoomPermission(
                    $user->getId(),
                    $roomId
                )->hasRoomManagePermission();
            default:
                throw new \InvalidArgumentException();
        }
    }

    public function hasIssueAccess(User $user, int $issueId, int $action): bool
    {
        switch ($action) {
            case self::ACTION_READ:
                return $this->userToIssuePermissionRepository->getIssuePermission(
                    $user->getId(),
                    $issueId
                )->hasIssueReadPermission();
            case self::ACTION_WRITE:
                return $this->userToIssuePermissionRepository->getIssuePermission(
                    $user->getId(),
                    $issueId
                )->hasIssueWritePermission();
            case self::ACTION_MANAGE:
                return $this->userToIssuePermissionRepository->getIssuePermission(
                    $user->getId(),
                    $issueId
                )->hasIssueManagePermission();
            default:
                throw new \InvalidArgumentException();
        }
    }
}