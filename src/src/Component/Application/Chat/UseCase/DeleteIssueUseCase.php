<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeleteIssueRequest;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;

class DeleteIssueUseCase
{
    private IssueRepository $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function execute(DeleteIssueRequest $request)
    {
        $this->issueRepository->delete($request->getIssueId());
    }

}