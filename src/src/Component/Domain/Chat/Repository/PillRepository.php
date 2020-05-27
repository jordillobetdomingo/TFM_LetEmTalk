<?php


namespace LetEmTalk\Component\Domain\Chat\Repository;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;

interface PillRepository
{
    public function save(Pill $pill): void;

    public function getPill(int $pillId): Pill;

    public function getPillsByIssue(Issue $issue): array;

    public function delete(int $pillId): void;
}