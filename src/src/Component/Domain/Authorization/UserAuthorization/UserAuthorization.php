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
    private User $user;

    public function __construct(
        UserToRoomPermissionRepository $userToRoomPermissionRepository,
        UserToIssuePermissionRepository $userToIssuePermissionRepository,
        User $user
    ) {
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
        $this->userToIssuePermissionRepository = $userToIssuePermissionRepository;
        $this->user = $user;
    }

    public function hasRoomAccess(int $roomId, int $action): bool
    {
        if ($action == self::ACTION_READ) {
            return $this->userToRoomPermissionRepository->exist($this->user->getId(), $roomId);
        }
        if ($action == self::ACTION_WRITE) {
            return $this->userToRoomPermissionRepository->getRoomPermission(
                $this->user->getId(),
                $roomId
            )->hasRoomWritePermission();
        }
        if ($action == self::ACTION_MANAGE) {
            return $this->userToRoomPermissionRepository->getRoomPermission(
                $this->user->getId(),
                $roomId
            )->hasRoomManagePermission();
        }
        throw new \InvalidArgumentException();
    }

    public function hasIssueAccess(int $issueId, int $action): bool
    {
        if ($action == self::ACTION_READ) {
            return $this->userToIssuePermissionRepository->getIssuePermission(
                $this->user->getId(),
                $issueId
            )->hasIssueReadPermission();
        }
        if ($action == self::ACTION_WRITE) {
            return $this->userToIssuePermissionRepository->getIssuePermission(
                $this->user->getId(),
                $issueId
            )->hasIssueWritePermission();
        }
        if ($action == self::ACTION_MANAGE) {
            return $this->userToIssuePermissionRepository->getIssuePermission(
                $this->user->getId(),
                $issueId
            )->hasIssueManagePermission();
        }
        throw new \InvalidArgumentException();
    }
}