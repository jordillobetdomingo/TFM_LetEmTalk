<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeletePillRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;
use LetEmTalk\Component\Domain\User\Repository\UserRepository;

class DeletePillUseCase
{
    private PillRepository $pillRepository;
    private UserAuthorization $userAuthorzation;

    public function __construct(
        PillRepository $pillRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->pillRepository = $pillRepository;
        $this->userAuthorzation = $userAuthorization;
    }

    public function execute(DeletePillRequest $request): void
    {
        if (!$this->userAuthorzation->hasIssueAccess(
            $request->getUserId(),
            $this->pillRepository->getPill($request->getPillId())->getIssue()->getId(),
            UserAuthorization::ACTION_MANAGE
        )) {
            throw new \InvalidArgumentException();
        }

        $this->pillRepository->delete($request->getPillId());
    }
}