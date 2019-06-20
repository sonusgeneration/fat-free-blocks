<?php
declare(strict_types=1);

namespace Blocks\Foundation\Http;

use \Base;
use \JsonSerializable;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/**
 *  HTTP REQUEST
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Prefab
 *  @see \Base
 *  @see \JsonSerializable
 */
final class Request implements JsonSerializable {

    /**
     *  @const int OUTPUT_RAW
     */
    const OUTPUT_RAW = 1;

    /**
     *  @const int OUTPUT_JSON
     */
    const OUTPUT_JSON = 2;

    /**
     *  @property string $_absolute_url
     */
    private $_absolute_url = "";

    /**
     *  @property array $_accept
     */
    private $_accept = [];

    /**
     *  @property array $_accept_language
     */
    private $_accept_language = [];

    /**
     *  @property int $_content_length
     */
    private $_content_length = 0;

    /**
     *  @property array $_cookies
     */
    private $_cookies = [];

    /**
     *  @property array $_headers
     */
    private $_headers = [];

    /**
     *  @property string $_http_method
     */
    private $_http_method = "";

    /**
     *  @property string $_input_stream
     */
    private $_input_stream = "";

    /**
     *  @property array $_params
     */
    private $_params = [];

    /**
     *  @property array $_payload
     */
    private $_payload = [];

    /**
     *  @property array $_query_string
     */
    private $_query_string = [];
    
    /**
     *  @property string $_referrer
     */
    private $_referer = "";

    /**
     *  @property string $_relative_url 
     */
    private $_relative_url = "";

    /**
     *  @property string $_remote_host_address
     */
    private $_remote_host_address = "";

    /**
     *  @property string $_server_protocol
     */
    private $_server_protocol = "";

    /**
     *  @property string $_user_agent
     */
    private $_user_agent = "";

    /**
     *  Class Constructor
     *  @since v1.0.0
     *
     *  @param \Base $Base
     */
    public function __construct(Base $Base) {
        # Absolute Url
        $this->_absolute_url = (($Base->exists('SERVER.HTTPS') AND $Base->get('SERVER.HTTPS') === "on") 
            ? "https://" : "http://") . $Base->get('SERVER.HTTP_HOST') . $Base->get('SERVER.REQUEST_URI');

        # Accept Type
        $accepts = explode(",", $Base->get('HEADERS.Accept'));
        foreach($accepts as $accept) {
            $type = explode(";", $accept);

            if(2 === count($type)) {
                $this->_accept[$type[0]] = floatval(explode("=", $type[1])[1]);
            } else {
                $this->_accept[$type[0]] = floatval(1);
            }
        }
        arsort($this->_accept);

        # Accept Language
        $accept_languages = explode(",", $Base->get('HEADERS.Accept-Language'));
        foreach($accept_languages as $language) {
            $type = explode(";", $language);

            if(2 === count($type)) {
                $this->_accept_language[$type[0]] = floatval(explode("=", $type[1])[1]);
            } else {
                $this->_accept_language[$type[0]] = floatval(1);
            }
        }
        arsort($this->_accept_language);

        # Content Length
        $this->_content_length = ($Base->exists('HEADERS.Content-Length')) ? intval($Base->get('SERVER.Content-Length')) : 0;

        # Cookies
        $this->_cookies = $Base->get('COOKIE');

        # Headers
        $this->_headers = $Base->get('HEADERS');

        # Http Method
        $this->_http_method = $Base->get('VERB');

        # Input Stream
        $this->_input_stream = $Base->get('BODY');

        # Params
        $this->_params = $Base->get('POST');

        # Payload
        $this->_payload = $Base->get('REQUEST');

        # Query String
        $this->_query_string = $Base->get('GET');

        # Referer
        $this->_referer = ($Base->exists('SERVER.HTTP_REFERER')) ? $Base->get('SERVER.HTTP_REFERER') : "";

        # Relative Url
        $this->_relative_url = $Base->get('SERVER.REQUEST_URI');

        # Remote Host Address
        $this->_remote_host_address = $Base->ip();

        # Server Protocol
        $this->_server_protocol = $Base->get('SERVER.SERVER_PROTOCOL');

        # User Agent
        $this->_user_agent = ($Base->exists('SERVER.HTTP_USER_AGENT')) ? $Base->get('SERVER.HTTP_USER_AGENT') : "";
    }

    /**
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {}

    /**
     *  Json Serialize
     *  @since v1.0.0
     *
     *  @return array
     */
    public function jsonSerialize() : array {
        return [
            'absolute_url'        => $this->_absolute_url,
            'accept'              => $this->_accept,
            'accept_language'     => $this->_accept_language,
            'content_length'      => $this->_content_length,
            'cookies'             => $this->_cookies,
            'headers'             => $this->_headers,
            'http_method'         => $this->_http_method,
            'params'              => $this->_params,
            'payload'             => $this->_payload,
            'query_string'        => $this->_query_string,
            'referer'             => $this->_referer,
            'relative_url'        => $this->_relative_url,
            'remote_host_address' => $this->_remote_host_address,
            'server_protocol'     => $this->_server_protocol,
            'user_agent'          => $this->_user_agent
        ];
    }

    /**
     *  Get Absolute Url
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getAbsoluteUrl() : string {
        return $this->_absolute_url;
    }

    /**
     *  Get Accept
     *  @since v1.0.0
     *  
     *  @return array
     */
    public function getAccept() : array {
        return $this->_accept;
    }

    /**
     *  Get Accept Language
     *  @since v1.0.0
     *
     *  @return array
     */
    public function getAcceptLanguage() : array {
        return $this->_accept_language;
    }

    /**
     *  Get Content Length
     *  @since v1.0.0
     *
     *  @return int
     */
    public function getContentLength() : int {
        return $this->_content_length;
    }

    /**
     *  Get Cookies
     *  @since v1.0.0
     *
     *  @return array
     */
    public function getCookies() : array {
        return $this->_cookies;
    }

    /**
     *  Get Cookie
     *  @since v1.0.0
     *  
     *  @param string $name
     *  @return string|NULLABLE
     */
    public function getCookie(string $name) : ?string {
        return (isset($this->_cookies[$name])) ? $this->_cookies[$name] : NULL;
    }

    /**
     *  Get Headers
     *  @since v1.0.0
     *
     *  @return array
     */
    public function getHeaders() : array {
        return $this->_headers;
    }

    /**
     *  Get Header
     *  @since v1.0.0
     *
     *  @param string $name
     *  @return string|NULLABLE
     */
    public function getHeader(string $name) : ?string {
        return (isset($this->_headers[$name])) ? $this->_headers[$name] : NULL;
    }

    /**
     *  Get Http Method
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getHttpMethod() : string {
        return mb_strtoupper($this->_http_method);
    }

    /**
     *  Get Input Stream
     *  @since v1.0.0
     *
     *  @param int $output
     *  @return mixed
     */
    public function getInputStream(int $output = self::OUTPUT_RAW) {
        switch($output) {
            case self::OUTPUT_JSON:
                return json_decode($this->_input_stream, TRUE);
                break;
            default:
                return $this->_input_stream;
                break;
        }
    }

    /**
     *  Get Params
     *  @since v1.0.0
     *
     *  @return array
     */
    public function getParams() : array {
        return $this->_params;
    }

    /**
     *  Get Param
     *  @since v1.0.0
     *  
     *  @param string $name
     *  @return string|NULLABLE
     */
    public function getParam(string $name) : ?string {
        return (isset($this->_params[$name])) ? $this->_params[$name] : NULL;
    }

    /**
     *  Get Payload
     *  @since v1.0.0
     *
     *  @return array
     */
    public function getPayload() : array {
        return $this->_payload;
    }

    /**
     *  Get Payload Value
     *  @since v1.0.0
     *
     *  @param string $name
     *  @return string|NULLABLE
     */
    public function getPayloadValue(string $name) : ?string {
        return (isset($this->_payload[$name])) ? $this->_payload[$name] : NULL;
    }

    /**
     *  Get Query String
     *  @since v1.0.0
     *
     *  @return array
     */
    public function getQueryString() : array {
        return $this->_query_string;
    }

    /**
     *  Get Query String Value
     *  @since v1.0.0
     *
     *  @param string $name
     *  @return string|NULLABLE
     */
    public function getQueryStringValue(string $name) : ?string {
        return (isset($this->_query_string[$name])) ? $this->_query_string[$name] : NULL;
    }

    /**
     *  Get Referer
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getReferer() : string {
        return $this->_referer;
    }

    /**
     *  Get Relative Url
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getRelativeUrl() : string {
        return $this->_relative_url;
    }

    /**
     *  Get Remote Host Address
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getRemoteHostAddress() : string {
        return $this->_remote_host_address;
    }

    /**
     *  Get Server Protocol
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getServerProtocol() : string {
        return $this->_server_protocol;
    }

    /**
     *  Get User Agent
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getUserAgent() : string {
        return $this->_user_agent;
    }

}