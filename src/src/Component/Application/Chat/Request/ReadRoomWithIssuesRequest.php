<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class ReadRoomWithIssuesRequest
{
    private int $roomId;
    private int $userId;

    public function __construct(int $roomId, int $userId)
    {
        $this->roomId = $roomId;
        $this->userId = $userId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

}