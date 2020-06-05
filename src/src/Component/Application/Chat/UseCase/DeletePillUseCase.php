<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeletePillRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class DeletePillUseCase
{
    private PillRepository $pillRepository;
    private UserRepository $userRepository;
    private UserAuthorization $userAuthorzation;

    public function __construct(
        PillRepository $pillRepository,
        UserRepository $userRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->pillRepository = $pillRepository;
        $this->userRepository = $userRepository;
        $this->userAuthorzation = $userAuthorization;
    }

    public function execute(DeletePillRequest $request): void
    {
        $user = $this->userRepository->getUser($request->getUserId());
        if ($user == null) {
            throw new \InvalidArgumentException();
        }

        if (!$this->userAuthorzation->hasIssueAccess(
            $user,
            $this->pillRepository->getPill($request->getPillId())->getIssue()->getId(),
            UserAuthorization::ACTION_MANAGE
        )) {
            throw new \InvalidArgumentException();
        }

        $this->pillRepository->delete($request->getPillId());
    }
}