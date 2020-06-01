<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;

use LetEmTalk\Component\Application\Chat\Request\CreateIssueRequest;
use LetEmTalk\Component\Domain\Authorization\UserAuthorization\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;
use LetEmTalk\Component\Domain\Chat\Repository\RoomRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreateIssueUseCase
{
    private IssueRepository $issueRepository;
    private RoomRepository $roomRepository;
    private PillRepository $pillRepository;
    private UserRepository $userRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(
        IssueRepository $issueRepository,
        RoomRepository $roomRepository,
        PillRepository $pillRepository,
        UserRepository $userRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->issueRepository = $issueRepository;
        $this->roomRepository = $roomRepository;
        $this->pillRepository = $pillRepository;
        $this->userRepository = $userRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(CreateIssueRequest $request)
    {
        $user = $this->userRepository->getUser($request->getAuthorId());
        if ($user == null) {
            throw new \InvalidArgumentException();
        }

        if (!$this->userAuthorization->hasRoomAccess($user, $request->getRoomId(), UserAuthorization::ACTION_WRITE)) {
            throw new \InvalidArgumentException();
        }

        $issue = new Issue($this->roomRepository->getRoom($request->getRoomId()), $request->getTitle());
        $this->issueRepository->save($issue);
        $firstPill = new Pill($issue, $request->getText(), $user);
        $this->pillRepository->save($firstPill);
        $issue->setFirstPill($firstPill);
        $this->issueRepository->save($issue);
    }
}