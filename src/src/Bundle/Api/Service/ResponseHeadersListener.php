<?php


namespace LetEmTalk\Bundle\Api\Service;


use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseHeadersListener
{
    public function onKernelResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();

        $response->headers->set('Access-Control-Allow-Headers', 'X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method');
        $response->headers->set('Access-Control-Allow-Origin', $_ENV['HEADER_ACCESS_CONTROL_ALLOW_ORIGIN']);
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        $response->headers->set('Allow', 'GET, POST, OPTIONS, PUT, DELETE');
    }
}