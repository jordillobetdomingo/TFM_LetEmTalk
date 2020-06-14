<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\ReadRoomWithIssuesRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadRoomWithIssuesResponse;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;

class ReadRoomWithIssuesUseCase
{
    private RoomRepository $roomRepository;
    private IssueRepository $issueRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(
        RoomRepository $roomRepository,
        IssueRepository $issueRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->roomRepository = $roomRepository;
        $this->issueRepository = $issueRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(ReadRoomWithIssuesRequest $request): ReadRoomWithIssuesResponse
    {
        $userPermission = $this->userAuthorization->forUser($request->getUserId());

        $room = $this->roomRepository->getRoom($request->getRoomId());

        if (!$userPermission->allowReadRoom($room)) {
            throw new \InvalidArgumentException();
        }
        $issues = $this->userAuthorization->getIssuesFromRoom($request->getUserId(), $room);
        return new ReadRoomWithIssuesResponse($room, $issues, $userPermission);
    }

}