<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\UpdateIssueRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class UpdateIssueUseCase
{
    private IssueRepository $issueRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(
        IssueRepository $issueRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->issueRepository = $issueRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(UpdateIssueRequest $request): void
    {
        $userPermissions = $this->userAuthorization->forUser($request->getUserId());

        $issue = $this->issueRepository->getIssue($request->getIssueId());

        if (!$userPermissions->allowUpdateIssue($issue)) {
            throw new \InvalidArgumentException();
        }

        $issue->setTitle($request->getTitle());
        $this->issueRepository->save($issue);
    }
}