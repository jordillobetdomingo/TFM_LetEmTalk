<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Authorization;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Authorization\Entity\UserToIssuePermission;
use LetEmTalk\Component\Domain\Authorization\Repository\UserToIssuePermissionRepository;

class RedisUserToIssuePermissionRepository extends RedisRepository implements UserToIssuePermissionRepository
{
    const KEY_NAMES = array("userIssuePermission", "issuePermission");

    private UserToIssuePermissionRepository $userToIssuePermissionRepository;

    public function __construct(UserToIssuePermissionRepository $userToIssuePermissionRepository)
    {
        parent::__construct();
        $this->userToIssuePermissionRepository = $userToIssuePermissionRepository;
    }

    public function save(UserToIssuePermission $userToIssuePermission): void
    {
        $this->userToIssuePermissionRepository->save($userToIssuePermission);
        $this->set(
            new RedisKey(
                self::KEY_NAMES,
                array($userToIssuePermission->getUser()->getId(), $userToIssuePermission->getIssue()->getId())
            ),
            $userToIssuePermission
        );
    }

    public function delete(int $userId, int $issueId): void
    {
        $this->userToIssuePermissionRepository->delete($userId, $issueId);
        $this->del(new RedisKey(self::KEY_NAMES, array($userId, $issueId)));
    }

    public function getIssuePermission(int $userId, int $issueId): ?UserToIssuePermission
    {
        $key = new RedisKey(self::KEY_NAMES, array($userId, $issueId));
        if ($this->exists($key)) {
            return $this->get($key);
        } else {
            $userToIssuePermission = $this->userToIssuePermissionRepository->getIssuePermission($userId, $issueId);
            $this->set($key, $userToIssuePermission);
            return $userToIssuePermission;
        }
    }

    public function getIssuesPermissionByUser(int $userId): array
    {
        return $this->userToIssuePermissionRepository->getIssuesPermissionByUser($userId);
    }
}