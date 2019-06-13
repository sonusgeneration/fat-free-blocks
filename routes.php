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
    echo "<pre>";
    print_r(Kernel::getCore());
})->setRoute('GET /json', function () {
    $JsonResponse = JsonResponse::instance();
    $JsonResponse->setContent(['status' => "Success."]);
    $JsonResponse->send(JsonResponse::PRETTY_PRINT);
})->setRoute('GET /xml', function () {
    $XmlResponse = XmlResponse::instance();

    $data = [];
    $data[] = [
        'id'       =>  '001',
        'name'     =>  'Mifas',
        'subjects' => ['English','Maths','IT']
    ];
    $data[] = [
        'id'    =>  '002',
        'name'  =>  'Ijas',
        'subjects'  => ['Science','History','Social']

    ];

    $XmlResponse->setContent($data);
    $XmlResponse->send();
});