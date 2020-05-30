<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\DeletePillRequest;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class DeletePillUseCase
{
    private PillRepository $pillRepository;

    public function __construct(PillRepository $pillRepository)
    {
        $this->pillRepository = $pillRepository;
    }

    public function execute(DeletePillRequest $request): void
    {
        $this->pillRepository->delete($request->getPillId());
    }
}