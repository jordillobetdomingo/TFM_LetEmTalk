<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\UpdatePillRequest;
use LetEmTalk\Component\Application\Chat\UseCase\UpdatePillUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class UpdatePillController
{
    const INPUT_TEXT = 'text';

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

        if (!isset($json[self::INPUT_TEXT])) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }

        $text = $json[self::INPUT_TEXT];

        try {
            $this->updatePillUseCase->execute(new UpdatePillRequest($pillId, $text, $user->getUserId()));
            return new Response('', Response::HTTP_NO_CONTENT);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
    }

}