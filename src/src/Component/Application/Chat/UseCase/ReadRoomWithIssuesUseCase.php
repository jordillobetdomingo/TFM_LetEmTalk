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
        if (!$this->userAuthorization->hasRoomAccess(
            $request->getUserId(),
            $request->getRoomId(),
            UserAuthorization::ACTION_READ
        )) {
            throw new \InvalidArgumentException();
        }

        $room = $this->roomRepository->getRoom($request->getRoomId());
        if ($this->userAuthorization->hasRoomAccess(
            $request->getUserId(),
            $request->getRoomId(),
            UserAuthorization::ACTION_MANAGE
        )) {
            $issues = $this->issueRepository->getIssuesByRoom($room);
        } else {
            $issues = $this->userAuthorization->getIssuesFromRoom($request->getUserId(), $room);
        }
        return new ReadRoomWithIssuesResponse($room, $issues);
    }

}