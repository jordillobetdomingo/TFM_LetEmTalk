<?php


namespace LetEmTalk\Bundle\Api\Controller\Authentication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{

    public function login(): Response
    {
        $user = $this->getUser();


        return new JsonResponse(
            [
                'userId' => $user->getUserId(),
                'username' => $user->getUsername()
            ],
            Response::HTTP_OK
        );
    }

    public function logout(): Response
    {
        return new Response('', Response::HTTP_NO_CONTENT);
    }

}