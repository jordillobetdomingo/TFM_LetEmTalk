<?php


namespace LetEmTalk\Bundle\Api\Controller\Authentication;


use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /*public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }*/

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

    public function logout()
    {
        //
    }

}