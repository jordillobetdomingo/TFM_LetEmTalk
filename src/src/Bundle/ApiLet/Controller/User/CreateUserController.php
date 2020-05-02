<?php


namespace App\Bundle\ApiLet\Controller\User;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function execute(): Response
    {
        return new Response("Hello", 200);
    }

}