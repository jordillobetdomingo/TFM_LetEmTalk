<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\CreateIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\CreateIssueUseCase;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;

class CreateIssueController
{
    const INPUT_ROOM_ID = "roomId";
    const INPUT_TITLE = "title";
    const INPUT_TEXT = "text";
    const INPUT_AUTHOR_ID = "authorId";

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

        if (!isset($json[self::INPUT_ROOM_ID]) || !isset($json[self::INPUT_TITLE]) || !isset($json[self::INPUT_TEXT])
            || !isset($json[self::INPUT_AUTHOR_ID])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $roomId = $json[self::INPUT_ROOM_ID];
        $title = $json[self::INPUT_TITLE];
        $text = $json[self::INPUT_TEXT];
        $authorId = $json[self::INPUT_AUTHOR_ID];
        try {
            $response = $this->createIssueUseCase->execute(
                new CreateIssueRequest($roomId, $title, $text, $authorId, $user->getUserId())
            );
            return new JsonResponse($response->getIssueAsArray(), Response::HTTP_OK);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
    }
}