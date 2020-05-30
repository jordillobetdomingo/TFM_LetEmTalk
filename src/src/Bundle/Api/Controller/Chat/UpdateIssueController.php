<?php


namespace LetEmTalk\Bundle\Api\Controller\Chat;


use LetEmTalk\Component\Application\Chat\Request\UpdateIssueRequest;
use LetEmTalk\Component\Application\Chat\UseCase\UpdateIssueUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateIssueController
{
    private UpdateIssueUseCase $updateIssueUseCase;

    public function __construct(UpdateIssueUseCase $updateIssueUseCase)
    {
        $this->updateIssueUseCase = $updateIssueUseCase;
    }

    public function execute(Request $request, int $issueId): Response
    {
        $json = json_decode($request->getContent(), true);

        $title = $json["title"];

        if (!isset($json["textFirstPill"])) {
            $this->updateIssueUseCase->execute(new UpdateIssueRequest($issueId, $title));
        } else {
            $textFirstPill = $json["textFirstPill"];
            $this->updateIssueUseCase->execute(new UpdateIssueRequest($issueId, $title, $textFirstPill));
        }

        return new Response("Issue has been updated", 204);
    }

}