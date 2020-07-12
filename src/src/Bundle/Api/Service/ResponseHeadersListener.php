<?php


namespace LetEmTalk\Bundle\Api\Service;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseHeadersListener
{
    public function onKernelResponse(ResponseEvent $event)
    {
        if ($event->getRequest()->getMethod() === 'OPTIONS') {
            $event->setResponse(
                new Response('', 204, [
                    'Access-Control-Allow-Origin' => $_ENV['HEADER_ACCESS_CONTROL_ALLOW_ORIGIN'],
                    'Access-Control-Allow-Credentials' => 'true',
                    'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers' => 'DNT, X-User-Token, Keep-Alive, User-Agent, X-Requested-With, If-Modified-Since, Cache-Control, Content-Type',
                    'Access-Control-Max-Age' => 1728000,
                    'Content-Type' => 'text/plain charset=UTF-8',
                    'Content-Length' => 0
                ])
            );
            return ;
        } else {
            $response = $event->getResponse();

            $response->headers->set(
                'Access-Control-Allow-Headers',
                'X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method'
            );
            $response->headers->set('Access-Control-Allow-Origin', $_ENV['HEADER_ACCESS_CONTROL_ALLOW_ORIGIN']);
            $response->headers->set('Access-Control-Allow-Credentials', 'false');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        }
    }
}