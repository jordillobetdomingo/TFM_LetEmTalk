<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeleteIssueRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class DeleteIssueUseCase
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

    public function execute(DeleteIssueRequest $request): void
    {
        $userPermission = $this->userAuthorization->forUser($request->getUserId());

        $issue = $this->issueRepository->getIssue($request->getIssueId());

        if (!$userPermission->hasDeleteIssuePermission($issue)) {
            throw new \InvalidArgumentException();
        }

        $this->issueRepository->delete($request->getIssueId());
    }

}