<?php


namespace LetEmTalk\Bundle\Api\Service;


use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseHeadersListener
{
    public function onKernelResponse(ResponseEvent $event)
    {
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('Access-Control-Allow-Origin', 'http://localhost:8080');
        $responseHeaders->set('Access-Control-Allow-Credentials', 'true');
        $responseHeaders->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
    }
}