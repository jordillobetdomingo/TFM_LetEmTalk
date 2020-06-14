<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeletePillRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class DeletePillUseCase
{
    private PillRepository $pillRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(
        PillRepository $pillRepository,
        UserAuthorization $userAuthorization
    ) {
        $this->pillRepository = $pillRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(DeletePillRequest $request): void
    {
        $userPermissions = $this->userAuthorization->forUser($request->getUserId());

        $pill = $this->pillRepository->getPill($request->getPillId());

        if (!$userPermissions->allowDeletePill($pill)) {
            throw new \InvalidArgumentException();
        }

        $this->pillRepository->delete($request->getPillId());
    }
}