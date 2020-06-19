<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;

use LetEmTalk\Component\Application\Chat\Request\UpdatePillRequest;
use LetEmTalk\Component\Domain\Authorization\Service\UserAuthorization;
use LetEmTalk\Component\Domain\Authorization\Service\UserPermission;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class UpdatePillUseCase
{
    private PillRepository $pillRepository;
    private UserAuthorization $userAuthorization;

    public function __construct(PillRepository $pillRepository, UserAuthorization $userAuthorization)
    {
        $this->pillRepository = $pillRepository;
        $this->userAuthorization = $userAuthorization;
    }

    public function execute(UpdatePillRequest $request): void
    {
        $userPermission = $this->userAuthorization->forUser($request->getUserId());

        $pill = $this->pillRepository->getPill($request->getPillId());

        if (!$userPermission->hasUpdatePillPermission($pill)) {
            throw new \InvalidArgumentException();
        }

        $pill->setText($request->getText());
        $this->pillRepository->save($pill);
    }
}