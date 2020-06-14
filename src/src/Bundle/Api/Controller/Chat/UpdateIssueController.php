<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\UpdateIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\UpdateIssueUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class UpdateIssueController
{
    const INPUT_TITLE = "title";

    private UpdateIssueUseCase $updateIssueUseCase;
    private Security $security;

    public function __construct(UpdateIssueUseCase $updateIssueUseCase, Security $security)
    {
        $this->updateIssueUseCase = $updateIssueUseCase;
        $this->security = $security;
    }

    public function execute(Request $request, int $issueId): Response
    {
        $json = json_decode($request->getContent(), true);

        if(!isset($json[self::INPUT_TITLE])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $user = $this->security->getUser();
        if (!$user) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }

        $title = $json[self::INPUT_TITLE];

        try {
            $this->updateIssueUseCase->execute(new UpdateIssueRequest($issueId, $title, $user->getUserId()));
            return new Response("", Response::HTTP_NO_CONTENT);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
    }

}