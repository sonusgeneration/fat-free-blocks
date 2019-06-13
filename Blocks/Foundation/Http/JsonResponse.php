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
final class JsonResponse extends Response implements IResponse {

    /*
     *  @const Pretty Print JSON
     */
    const PRETTY_PRINT = TRUE;

    /*
     *  @property Pretty Print
     */
    private $_pretty_print = FALSE;

    /*
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {
        $this->_content_type = "application/json";
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
     *  Send
     *  @since v1.0.0
     */
    public final function send(bool $pretty_print = FALSE) {
        $this->_pretty_print = $pretty_print;
        parent::send();
    }

    /*
     *  Send Content
     *  @since v1.0.0
     */
    protected final function _sendContent() {
        echo (self::PRETTY_PRINT === $this->_pretty_print) 
                ? json_encode($this->_content, JSON_PRETTY_PRINT) : json_encode($this->_content);
    }

    /*
     *  Set Content
     *  @since v1.0.0
     */
    public final function setContent($content) : Response {
        if(is_array($content)) {
            $this->_content = $content;
        }
        return $this;
    }

}