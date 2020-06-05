<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\UpdateIssueRequest;
use LetEmTalk\Component\Application\Chat\Response\UpdateIssueResponse;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class UpdateIssueUseCase
{
    private IssueRepository $issueRepository;
    private UserRepository $userRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(
        IssueRepository $issueRepository,
        UserRepository $userRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->issueRepository = $issueRepository;
        $this->userRepository = $userRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(UpdateIssueRequest $request): void
    {
        $user = $this->userRepository->getUser($request->getUserId());
        if ($user == null) {
            throw new \InvalidArgumentException();
        }

        if (!$this->userAuthorization->hasIssueAccess($user, $request->getIssueId(), UserAuthorization::ACTION_WRITE)) {
            throw new \InvalidArgumentException();
        }

        $issue = $this->issueRepository->getIssue($request->getIssueId());
        $issue->setTitle($request->getTitle());
        $this->issueRepository->save($issue);
    }
}