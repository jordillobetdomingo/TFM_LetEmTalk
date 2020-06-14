<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\CreatePillRequest;
use LetEmTalk\Component\Application\Chat\UseCase\CreatePillUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class CreatePillController
{
    const INPUT_ISSUE_ID = "issueId";
    const INPUT_TEXT = "text";
    const INPUT_AUTHOR_ID = "authorId";

    private CreatePillUseCase $createPillUseCase;
    private Security $security;

    public function __construct(CreatePillUseCase $createPillUseCase, Security $security)
    {
        $this->createPillUseCase = $createPillUseCase;
        $this->security = $security;
    }

    public function execute(Request $request): Response
    {
        $json = json_decode($request->getContent(), true);

        if (!isset($json[self::INPUT_ISSUE_ID]) || !isset($json[self::INPUT_TEXT])
            || !isset($json[self::INPUT_AUTHOR_ID])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $issueId = $json[self::INPUT_ISSUE_ID];
        $text = $json[self::INPUT_TEXT];
        $authorId = $json[self::INPUT_AUTHOR_ID];

        try {
            $response = $this->createPillUseCase->execute(
                new CreatePillRequest($issueId, $text, $authorId, $user->getUserId())
            );
            return new JSONResponse($response->getPillAsArray(), Response::HTTP_OK);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
    }

}