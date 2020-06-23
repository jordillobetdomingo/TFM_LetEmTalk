<?php


namespace LetEmTalk\Bundle\Api\Persistence\Repository\Chat;


use LetEmTalk\Bundle\Api\Persistence\Repository\RedisRepository;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class RedisPillRepository extends RedisRepository implements PillRepository
{
    const KEY_PILL = "pill";

    private PillRepository $pillRepository;

    public function __construct(PillRepository $pillRepository)
    {
        parent::__construct();
        $this->pillRepository = $pillRepository;
    }

    public function save(Pill $pill): void
    {
        $this->pillRepository->save($pill);
        $this->set($pill->getId(), $pill);
    }

    public function getPill(int $pillId, bool $noCache = false): Pill
    {
        if ($noCache) {
            return $this->pillRepository->getPill($pillId);
        }
        if($this->exists($pillId)) {
            return $this->get($pillId);
        } else {
            $pill = $this->pillRepository->getPill($pillId);
            $this->set($pillId, $pill);
            return $pill;
        }
    }

    public function getPillsByIssue(Issue $issue): array
    {
        return $this->pillRepository->getPillsByIssue($issue);
    }

    public function delete(int $pillId): void
    {
        $this->del($pillId);
        $this->pillRepository->delete($pillId);
    }

    protected function getKey(int $id): string
    {
        return self::KEY_PILL . strval($id);
    }
}