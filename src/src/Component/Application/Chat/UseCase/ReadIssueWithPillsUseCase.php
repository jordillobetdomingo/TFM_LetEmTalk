<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\ReadIssueWithPillsRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadIssueWithPillsResponse;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Authorization\Service\UserPermission;
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
        $userPermission = $this->userAuthorization->forUser($request->getUserId());

        $issue = $this->issueRepository->getIssue($request->getIssueId());

        if (!$userPermission->hasReadIssuePermission($issue)) {
            throw new \InvalidArgumentException();
        }
        $pills = $this->pillRepository->getPillsByIssue($issue);

        return new ReadIssueWithPillsResponse($issue, $pills, $userPermission);
    }
}