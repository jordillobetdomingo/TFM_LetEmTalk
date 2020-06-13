<?php


namespace LetEmTalk\Bundle\Api\Service;


use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseHeadersListener
{
    public function onKernelResponse(ResponseEvent $event)
    {
        $responseHeaders = $event->getResponse()->headers;

        $responseHeaders->set('Access-Control-Allow-Origin', $_ENV['HEADER_ACCESS_CONTROL_ALLOW_ORIGIN']);
        $responseHeaders->set('Access-Control-Allow-Credentials', 'true');
        $responseHeaders->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
    }
}