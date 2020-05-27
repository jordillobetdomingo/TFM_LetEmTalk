<?php


namespace LetEmTalk\Component\Application\Chat\UseCase;


use LetEmTalk\Component\Application\Chat\Request\CreatePillRequest;
use LetEmTalk\Component\Domain\Chat\Entity\Pill;
use LetEmTalk\Component\Domain\Chat\Repository\PillRepository;

class CreatePillUseCase
{
    private PillRepository $pillRepository;

    public function __construct(PillRepository $pillRepository)
    {
        $this->pillRepository = $pillRepository;
    }

    public function execute(CreatePillRequest $request): void
    {
        $pill = new Pill($request->getIssue(), $request->getText(), $request->getAuthor());
        $this->pillRepository->save($pill);
    }
}