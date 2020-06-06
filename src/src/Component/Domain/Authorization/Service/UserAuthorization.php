<?php


namespace LetEmTalk\Component\Domain\Authorization\Service;


use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToRoomPermissionRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Room;
use LetEmTalk\Component\Domain\User\Entity\User;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class UserAuthorization
{
    const ACTION_READ = 1;
    const ACTION_WRITE = 2;
    const ACTION_MANAGE = 3;

    private UserToRoomPermissionRepository $userToRoomPermissionRepository;
    private UserToIssuePermissionRepository $userToIssuePermissionRepository;
    private UserRepository $userRepository;

    public function __construct(
        UserToRoomPermissionRepository $userToRoomPermissionRepository,
        UserToIssuePermissionRepository $userToIssuePermissionRepository,
        UserRepository $userRepository
    ) {
        $this->userToRoomPermissionRepository = $userToRoomPermissionRepository;
        $this->userToIssuePermissionRepository = $userToIssuePermissionRepository;
        $this->userRepository = $userRepository;
    }

    public function hasRoomAccess(int $userId, int $roomId, int $action): bool
    {
        if (!$this->existUser($userId)) {
            return false;
        }
        $roomPermission = $this->userToRoomPermissionRepository->getRoomPermission($userId, $roomId);
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

    public function hasIssueAccess(int $userId, int $issueId, int $action): bool
    {
        if (!$this->existUser($userId)) {
            return false;
        }
        $issuePermission = $this->userToIssuePermissionRepository->getIssuePermission($userId, $issueId);
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

    public function getIssuesFromRoom(int $userId, Room $room): array
    {
        $userToIssuePermissions = $this->userToIssuePermissionRepository->getIssuesPermissionByUser($userId);
        $issues = array();
        foreach ($userToIssuePermissions as $userToIssuePermission) {
            if ($userToIssuePermission->getIssue()->getRoom() == $room) {
                $issues[] = $userToIssuePermission->getIssue();
            }
        }
        return $issues;
    }

    private function existUser(int $userId): bool
    {
        return $this->userRepository->getUser($userId) != null;
    }
}