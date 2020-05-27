<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\UpdateIssueRequest;
use LetEmTalk\Component\Application\Chat\Response\UpdateIssueResponse;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class UpdateIssueUseCase
{
    private IssueRepository $issueRepository;
    private PillRepository $pillRepository;

    public function __construct(IssueRepository $issueRepository, PillRepository $pillRepository)
    {
        $this->issueRepository = $issueRepository;
        $this->pillRepository = $pillRepository;
    }

    public function execute(UpdateIssueRequest $request): void
    {
        $issue = $this->issueRepository->getIssue($request->getIssueId());
        $issue->setTitle($request->getTitle());
        $this->issueRepository->save($issue);
        if ($request->getTextFirstPill() != null) {
            $pill = $issue->getFirstPill();
            $pill->setText($request->getTextFirstPill());
            $this->pillRepository->save($pill);
        }
    }
}