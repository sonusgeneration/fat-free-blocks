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
})->get('json', function ($app, $params) {
    # Sample JSON response...
    $Response = (new HomeController())->ActionJson();
    $Response->send($Response::PRETTY_PRINT);
})->get('xml', function () {
    #Sample XML response...
    $Response = (new HomeController())->ActionXml();
    $Response->send();
});