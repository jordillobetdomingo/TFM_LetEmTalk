<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class DeletePillRequest
{
    private int $pillId;

    public function __construct(int $pillId)
    {
        $this->pillId = $pillId;
    }

    public function getPillId(): int
    {
        return $this->pillId;
    }

}