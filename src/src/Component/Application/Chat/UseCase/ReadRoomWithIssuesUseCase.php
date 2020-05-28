<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomWithIssuesRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadRoomWithIssuesResponse;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class ReadRoomWithIssuesUseCase
{
    private RoomRepository $roomRepository;
    private IssueRepository $issueRepository;

    public function __construct(RoomRepository $roomRepository, IssueRepository $issueRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->issueRepository = $issueRepository;
    }

    public function execute(ReadRoomWithIssuesRequest $request): ReadRoomWithIssuesResponse
    {
        $room = $this->roomRepository->getRoom($request->getRoomId());
        $issues = $this->issueRepository->getIssuesByRoom($room);
        return new ReadRoomWithIssuesResponse($room, $issues);
    }

}