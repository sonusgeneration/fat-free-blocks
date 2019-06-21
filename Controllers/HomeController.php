<?php
declare(strict_types=1);

namespace Controllers;

use \Controllers\BaseController;
use \Blocks\Foundation\Http\Response;
use \League\Flysystem\Filesystem;
use \League\Flysystem\Adapter\Local;
use \Blocks\Foundation\Http\HtmlResponse;
use \Blocks\Foundation\Http\JsonResponse;
use \Blocks\Foundation\Http\XmlResponse;

/**
 *  HOME CONTROLLER
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Kernel
 */
final class HomeController extends BaseController {

    /**
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {
        parent::__destruct();
    }

    /**
     *  Action Html
     *  @since v1.0.0
     *
     *  @return Response
     */
    public function ActionHtml() : Response {
        # Create the filesystem...
        $filesystem = new FileSystem(new Local(__DIR__));

        # Create the response...
        $Response = new HtmlResponse();
        $Response->setContent($filesystem->read('Views/sample-view.html'));

        # Return the response...
        return $Response;
    }

    /**
     *  Action Json
     *  @since v1.0.0
     *
     *  @return Response
     */
    public function ActionJson() : Response {
        # Create the response...
        $Response = new JsonResponse();
        $Response->setContent([
            'status'        => "success",
            'response_type' => "json"
        ]);
        
        # Return the response...
        return $Response;
    }

    /**
     *  Action Xml
     *  @since v1.0.0
     *
     *  @return Response
     */
    public function ActionXml() : Response {
        # Create the response...
        $Response = new XmlResponse();
        $Response->setContent([
            'status'        =>  'success',
            'response_type' =>  'xml',
        ]);

        # Return the response...
        return $Response;
    }

}