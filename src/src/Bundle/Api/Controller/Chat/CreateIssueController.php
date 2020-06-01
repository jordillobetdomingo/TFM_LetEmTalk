<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\CreateIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\CreateIssueUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class CreateIssueController
{
    private CreateIssueUseCase $createIssueUseCase;
    private Security $security;

    public function __construct(CreateIssueUseCase $createIssueUseCase, Security $security)
    {
        $this->createIssueUseCase = $createIssueUseCase;
        $this->security = $security;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        $roomId = $json["roomId"];
        $title = $json["title"];
        $text = $json["text"];
        $authorId = $this->security->getUser()->getUserId();

        $this->createIssueUseCase->execute(new CreateIssueRequest($roomId, $title, $text, $authorId));

        return new Response("Issue has been created", 204);
    }

}