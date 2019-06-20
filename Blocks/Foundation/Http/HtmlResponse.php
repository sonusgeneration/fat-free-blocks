<?php
declare(strict_types=1);

namespace Blocks\Foundation\Http;

use \Blocks\Foundation\Http\Response;
use \Blocks\Foundation\Http\IResponse;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/*
 *  JSON RESPONSE
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @uses \Blocks\Foundation\Http\Response
 *  @uses \Blocks\Foundation\Http\IResponse
 */
final class HtmlResponse extends Response implements IResponse {

    /*
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {
        $this->_content_type = "text/html; charset=utf-8";
        parent::__construct();
    }

    /*
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {
        parent::__destruct();
    }

    /*
     *  Send Content
     *  @since v1.0.0
     */
    protected final function _sendContent() : void {
        echo $this->_content;
    }

    /*
     *  Set Content
     *  @since v1.0.0
     */
    public final function setContent($content) : Response {
        $this->_content = $content;
        return $this;
    }

}