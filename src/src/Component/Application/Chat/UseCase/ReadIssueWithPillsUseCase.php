<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\ReadIssueWithPillsRequest;
use LetEmTalk\Component\Application\Chat\Response\ReadIssueWithPillsResponse;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class ReadIssueWithPillsUseCase
{
    private IssueRepository $issueRepository;
    private PillRepository $pillRepository;

    public function __construct(IssueRepository $issueRepository, PillRepository $pillRepository)
    {
        $this->issueRepository = $issueRepository;
        $this->pillRepository = $pillRepository;
    }

    public function execute(ReadIssueWithPillsRequest $request): ReadIssueWithPillsResponse
    {
        $issue = $this->issueRepository->getIssue($request->getIssueId());
        $pills = $this->pillRepository->getPillsByIssue($issue);
        return new ReadIssueWithPillsResponse($issue, $pills);
    }
}