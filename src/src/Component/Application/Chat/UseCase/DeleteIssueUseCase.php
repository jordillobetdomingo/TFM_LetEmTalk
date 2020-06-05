<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeleteIssueRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\IssueRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class DeleteIssueUseCase
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

    public function execute(DeleteIssueRequest $request)
    {
        $user = $this->userRepository->getUser($request->getUserId());
        if ($user == null) {
            throw new \InvalidArgumentException();
        }

        if (!$this->userAuthorization->hasIssueAccess($user, $request->getIssueId(), UserAuthorization::ACTION_MANAGE)) {
            throw new \InvalidArgumentException();
        }

        $this->issueRepository->delete($request->getIssueId());
    }

}