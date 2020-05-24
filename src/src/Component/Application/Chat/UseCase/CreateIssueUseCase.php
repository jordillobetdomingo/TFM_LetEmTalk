<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\CreateIssueRequest;
use LetEmTalk\Component\Domain\Chat\Entity\Issue;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class CreateIssueUseCase
{
    private IssueRepository $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function execute(CreateIssueRequest $request)
    {
        $issue = new Issue($request->getRoom(), $request->getTitle());
        $this->issueRepository->save($issue);
    }
}