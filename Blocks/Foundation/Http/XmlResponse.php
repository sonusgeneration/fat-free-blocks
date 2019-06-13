<?php
declare(strict_types=1);

namespace Blocks\Foundation\Http;

use \Blocks\Foundation\Http\Response;
use \Blocks\Foundation\Http\IResponse;
use \SimpleXMLElement;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/*
 *  XML RESPONSE
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @uses \Blocks\Foundation\Http\Response
 *  @uses \Blocks\Foundation\Http\IResponse
 */
final class XmlResponse extends Response implements IResponse {

    private $_root_element = "<data></data>";

    /*
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {
        $this->_content_type = "text/xml";
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
     *  Array to Xml
     *  @since v1.0.0
     */
    private function _build_xml($data, &$xml) {
        foreach($data as $key => $value) {
            if(is_array($value)) {
                $key = is_numeric($key) ? "item" . $key : $key;
                $subnode = $xml->addChild($key);
                $this->_build_xml($value, $subnode);
            }
            else {
                $key = is_numeric($key) ? "item" . $key : $key;
                $xml->addChild($key, $value);
            }
        }
    }

    /*
     *  Send Content
     *  @since v1.0.0
     */
    protected final function _sendContent() {
        $xml = new SimpleXMLElement("<?xml version=\"1.0\"?>" . $this->_root_element);
        $this->_build_xml($this->_content, $xml);

        echo $xml->asXML();
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