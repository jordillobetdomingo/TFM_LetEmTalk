<?php


namespace LetEmTalk\Component\Application\Chat\Request;


class ReadRoomWithIssuesRequest
{
    private int $roomId;

    public function __construct(int $roomId)
    {
        $this->roomId = $roomId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

}