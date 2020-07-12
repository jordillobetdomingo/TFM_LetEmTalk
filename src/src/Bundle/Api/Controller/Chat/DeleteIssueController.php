<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\DeleteIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\DeleteIssueUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security;

class DeleteIssueController
{
    private DeleteIssueUseCase $deleteIssueUseCase;
    private Security $security;

    public function __construct(DeleteIssueUseCase $deleteIssueUseCase, Security $security)
    {
        $this->deleteIssueUseCase = $deleteIssueUseCase;
        $this->security = $security;
    }

    public function execute(int $issueId): Response
    {
        $user = $this->security->getUser();
        if (!$user) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
        try {
            $this->deleteIssueUseCase->execute(
                new DeleteIssueRequest($issueId, $user->getUserId())
            );
            return new Response('', Response::HTTP_NO_CONTENT);
        } catch (\InvalidArgumentException $argumentException) {
            return new Response('', Response::HTTP_UNAUTHORIZED);
        }
    }

}