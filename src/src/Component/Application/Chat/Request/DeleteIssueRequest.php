<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class DeleteIssueRequest
{
    private int $issueId;

    public function __construct(int $issueId)
    {
        $this->issueId = $issueId;
    }

    public function getIssueId(): int
    {
        return $this->issueId;
    }

}