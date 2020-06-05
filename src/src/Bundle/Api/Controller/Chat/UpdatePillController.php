<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\UpdatePillRequest;
use LetEmTalk\Component\Application\Chat\UseCase\UpdatePillUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class UpdatePillController
{
    const INPUT_TEXT = "text";

    private UpdatePillUseCase $updatePillUseCase;
    private Security $security;

    public function __construct(UpdatePillUseCase $updatePillUseCase, Security $security)
    {
        $this->updatePillUseCase = $updatePillUseCase;
        $this->security = $security;
    }

    public function execute(Request $request, int $pillId): Response
    {
        $json = json_decode($request->getContent(), true);

        $text = $json[self::INPUT_TEXT];
        $userId = $this->security->getUser()->getUserId();
        try {
            $this->updatePillUseCase->execute(new UpdatePillRequest($pillId, $text, $userId));
        } catch (\InvalidArgumentException $argumentException) {
            return new Response("", Response::HTTP_UNAUTHORIZED);
        }
        return new Response("Has been updated the pill", 204);
    }

}