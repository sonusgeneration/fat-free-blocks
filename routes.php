<?php
declare(strict_types=1);

use \Blocks\Foundation\Kernel;
use \Controllers\HomeController;

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
(Kernel::getRouter())->get('/', function () {
    # Sample HTML response...
    $Response = (new HomeController())->ActionHtml();
    $Response->send();
})->get('json/{print}', function ($app, $params) {
    # Sample JSON response...
    $Response = (new HomeController())->ActionJson();
    switch(intval($params['print'])) {
        case 1:
            $Response->send();
            break;
        case 2:
            $Response->send($Response::PRETTY_PRINT);
            break;
    }
})->get('xml', function () {
    #Sample XML response...
    $Response = (new HomeController())->ActionXml();
    $Response->send();
});