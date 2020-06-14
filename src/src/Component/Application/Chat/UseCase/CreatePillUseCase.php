<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;

use LetEmTalk\Component\Application\Chat\Request\CreatePillRequest;
use LetEmTalk\Component\Application\Chat\Response\CreatePillResponse;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class CreatePillUseCase
{
    private PillRepository $pillRepository;
    private IssueRepository $issueRepository;
    private UserRepository $userRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(
        PillRepository $pillRepository,
        IssueRepository $issueRepository,
        UserRepository $userRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->pillRepository = $pillRepository;
        $this->issueRepository = $issueRepository;
        $this->userRepository = $userRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(CreatePillRequest $request): CreatePillResponse
    {
        $userPermission = $this->userAuthorization->forUser($request->getUserId());

        $issue = $this->issueRepository->getIssue($request->getIssueId());


        if (!$userPermission->allowCreatePill($issue)) {
            throw new \InvalidArgumentException();
        }

        $pill = new Pill(
            $issue,
            $request->getText(),
            $this->userRepository->getUser($request->getAuthorId())
        );
        $this->pillRepository->save($pill);

        return new CreatePillResponse($pill, $userPermission);
    }
}