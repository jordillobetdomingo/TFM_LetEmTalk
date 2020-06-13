<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeleteIssueRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Authorization\Service\UserPermissions;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

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

    public function execute(DeleteIssueRequest $request)
    {
        $userPermissions = new UserPermissions($this->userAuthorization, $request->getUserId());

        $issue = $this->issueRepository->getIssue($request->getIssueId());

        if (!$userPermissions->allowDeleteIssue($issue)) {
            throw new \InvalidArgumentException();
        }

        $this->issueRepository->delete($request->getIssueId());
    }

}