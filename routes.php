<?php
declare(strict_types=1);

use \Blocks\Foundation\Kernel;
use \Blocks\Foundation\Http\JsonResponse;
use \Blocks\Foundation\Http\XmlResponse;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/*
 *  Routes
 *
 *  Here lies the core of the application. If we haven't hit
 *  any routes by now, the Kernel will spin up the entire
 *  CMS and begin to build the requested page.
 *
 *  Here we go!
 */
(Kernel::getRouter())->setRoute('GET /', function () {
    # Sample HTML response...
    echo "<pre>";
    print_r(Kernel::getCore());

})->setRoute('GET /json', function () {
    # Sample JSON response...
    $JsonResponse = new JsonResponse();
    $JsonResponse->setContent([
        'status'        => "success",
        'response_type' => "json"
    ]);
    $JsonResponse->send(JsonResponse::PRETTY_PRINT);

})->setRoute('GET /xml', function () {
    #Sample XML response...
    $XmlResponse = new XmlResponse();
    $XmlResponse->setContent([
        'status'        =>  'success',
        'response_type' =>  'xml',
    ]);
    $XmlResponse->send();

});