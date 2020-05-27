<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\UseCase\CreatePillUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreatePillController
{
    private CreatePillUseCase $createPillUseCase;

    public function __construct(CreatePillUseCase $createPillUseCase)
    {
        $this->createPillUseCase = $createPillUseCase;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $issueId = $json["issueId"];
        $text = $json["text"];
        $authorId = $json["authorId"];



        return new Response("Pill has been created");
    }

}