<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\CreateIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\CreateIssueUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateIssueController
{
    private CreateIssueUseCase $createIssueUseCase;

    public function __construct(CreateIssueUseCase $createIssueUseCase)
    {
        $this->createIssueUseCase = $createIssueUseCase;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $roomId = $json["roomId"];
        $title = $json["title"];
        $text = $json["text"];
        $authorId = $json["authorId"];

        $this->createIssueUseCase->execute(new CreateIssueRequest($roomId, $title, $text, $authorId));

        return new Response("Issue has been created", 204);
    }

}