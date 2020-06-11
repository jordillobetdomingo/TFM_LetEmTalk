<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\ReadIssueWithPillsRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadIssueWithPillsResponse;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Authorization\Service\UserPermissions;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class ReadIssueWithPillsUseCase
{
    private IssueRepository $issueRepository;
    private PillRepository $pillRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(
        IssueRepository $issueRepository,
        PillRepository $pillRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->issueRepository = $issueRepository;
        $this->pillRepository = $pillRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(ReadIssueWithPillsRequest $request): ReadIssueWithPillsResponse
    {
        if (!$this->userAuthorization->hasIssueAccess(
            $request->getUserId(),
            $request->getIssueId(),
            UserAuthorization::ACTION_READ
        )) {
            throw new \InvalidArgumentException();
        }

        $issue = $this->issueRepository->getIssue($request->getIssueId());
        $pills = $this->pillRepository->getPillsByIssue($issue);
        $userPermissions = new UserPermissions($this->userAuthorization, $request->getUserId());
        return new ReadIssueWithPillsResponse($issue, $pills, $userPermissions);
    }
}