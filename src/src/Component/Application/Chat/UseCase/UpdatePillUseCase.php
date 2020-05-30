<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;

use LetEmTalk\Component\Application\Chat\Request\UpdatePillRequest;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class UpdatePillUseCase
{
    private PillRepository $pillRepository;

    public function __construct(PillRepository $pillRepository)
    {
        $this->pillRepository = $pillRepository;
    }

    public function execute(UpdatePillRequest $request): void
    {
        $pill = $this->pillRepository->getPill($request->getPillId());
        $pill->setText($request->getText());
        $this->pillRepository->save($pill);
    }
}