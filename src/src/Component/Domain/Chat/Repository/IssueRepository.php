<?php


namespace LetEmTalk\Component\Domain\Chat\Repository;


use LetEmTalk\Component\Domain\Chat\Entity\Issue;

Interface IssueRepository
{
    public function save(Issue $issue): void;
}