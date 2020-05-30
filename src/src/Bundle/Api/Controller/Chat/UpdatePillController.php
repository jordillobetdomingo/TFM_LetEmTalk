<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\UpdatePillRequest;
use LetEmTalk\Component\Application\Chat\UseCase\UpdatePillUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdatePillController
{
    private UpdatePillUseCase $updatePillUseCase;

    public function __construct(UpdatePillUseCase $updatePillUseCase)
    {
        $this->updatePillUseCase = $updatePillUseCase;
    }

    public function execute(Request $request, int $pillId): Response
    {
        $json = json_decode($request->getContent(), true);

        $text = $json["text"];
        $this->updatePillUseCase->execute(new UpdatePillRequest($pillId, $text));

        return new Response("Has been updated the pill", 204);
    }

}