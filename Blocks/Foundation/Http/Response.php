<?php
declare(strict_types=1);

namespace Blocks\Foundation\Http;

use \Blocks\Foundation\Kernel;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/*
 *  HTTP RESPONSE
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @uses \Prefab
 *  @uses \Blocks\Foundation\Kernel
 */
abstract class Response {

    /*
     *  @property int $_code
     *  @since v1.0.0
     */
    protected $_code = 200;

    /*
     *  @property int $_cache
     *  @since v1.0.0
     */
    protected $cache = 0;

    /*
     *  @property string $_content_type
     *  @since v1.0.0
     */
    protected $_content_type = "";

    /*
     *  @property string $_content
     *  @since v1.0.0
     */
    protected $_content = NULL;

    /*
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {}

    /*
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {}

    /*
     *  Abort
     *  @since v1.0.0
     */
    public final function abort() {
        (Kernel::getCore())->abort();
    }

    /*
     *  Send
     *  @since v1.0.0
     */
    public function send() {
        $this->_sendHeaders();
        $this->_sendContent();
    }

    /*
     *  Send Headers
     *  @since v1.0.0
     */
    protected final function _sendHeaders() {
        header('Content-Type: ' . $this->_content_type);
    }

    /*
     *  Get Content
     *  @since v1.0.0
     *
     *  @return mixed
     */
    public function getContent() {
        return $this->_content;
    }

    /*
     *  Send Content
     *  @since v1.0.0
     */
    abstract protected function _sendContent();

    /*
     *  Set Content
     *  @since v1.0.0
     *
     *  @return \Blocks\Foundation\Http\Response
     */
    abstract public function setContent($content) : Response;

}