<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisKey;
use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class RedisPillRepository extends RedisRepository implements PillRepository
{
    const KEY_PILL_NAME = array("pill");
    const KEY_PILL_BY_ISSUE_NAME = array("pillsIssue");

    private PillRepository $pillRepository;

    public function __construct(PillRepository $pillRepository)
    {
        parent::__construct();
        $this->pillRepository = $pillRepository;
    }

    public function save(Pill $pill): void
    {
        $this->pillRepository->save($pill);
        $this->set(new RedisKey(self::KEY_PILL_NAME, array($pill->getId())), $pill);
    }

    public function getPill(int $pillId): Pill
    {
        $key = new RedisKey(self::KEY_PILL_NAME, array($pillId));
        if($this->exists($key)) {
            return $this->get($key);
        } else {
            $pill = $this->pillRepository->getPill($pillId);
            $this->set($key, $pill);
            return $pill;
        }
    }

    public function getPillsByIssue(Issue $issue): array
    {
        $key = new RedisKey(self::KEY_PILL_NAME, array($issue->getId()));
        if($this->exists($key)) {
            return $this->get($key);
        } else {
            $pill = $this->pillRepository->getPillsByIssue($issue);
            $this->set($key, $pill);
            return $pill;
        }
    }

    public function delete(int $pillId): void
    {
        $this->del(new RedisKey(self::KEY_PILL_NAME, array($pillId)));
        $this->pillRepository->delete($pillId);
    }
}