<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\DeletePillRequest;
use LetEmTalk\Component\Application\Chat\UseCase\DeletePillUseCase;
use Symfony\Component\HttpFoundation\Response;

class DeletePillController
{
    private DeletePillUseCase $deletePillUseCase;

    public function __construct(DeletePillUseCase $deletePillUseCase)
    {
        $this->deletePillUseCase = $deletePillUseCase;
    }

    public function execute(int $pillId): Response
    {
        $this->deletePillUseCase->execute(new DeletePillRequest($pillId));

        return new Response("Has been deleted the pill");
    }

}