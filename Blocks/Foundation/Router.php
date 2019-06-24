<?php
declare(strict_types=1);

namespace Blocks\Foundation;

use \Base;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/**
 *  ROUTER
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Base
 */
final class Router {     

    /**
     *  @property \Base $_Base
     */
    private $_Base = NULL;

    /**
     *  @const string GET
     */
    const GET = "GET";

    /**
     *  @const string POST
     */
    const POST = "POST";

    /**
     *  @const string PUT
     */
    const PUT = "PUT";

    /**
     *  @const string DELETE
     */
    const DELETE = "DELETE";

    /**
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct(Base $Base) {
        $this->_Base = $Base;
    }

    /**
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {
        $this->_Base = NULL;
    }

    /**
     *  Set Route
     *  @since v1.0.0
     *
     *  @param string $route
     *  @param string $pattern
     *  @param callable $callable
     *  @param string|NULL $name
     *  @return Router
     */
    private function setRoute(string $route, string $pattern, callable $callback, ?string $name = NULL) : void {
        if(!empty($name)) {
            $route .= "@" . $name . ": ";
        }
        $route .= "/" . ltrim(str_replace(["{", "}"], ["@", ""], $pattern), "/");

        $this->_Base->route($route, $callback);
    }

    /**
     *  Get
     *  @since v1.0.0
     *
     *  @param string $pattern
     *  @param callable $callback
     *  @param string|NULL $name
     *  @return Router
     */
    public function get(string $pattern, callable $callback, ?string $name = NULL) : Router {
        $this->setRoute(self::GET . " ", $pattern, $callback, $name);
        return $this;
    }

    /**
     *  Post
     *  @since v1.0.0
     *
     *  @param string $pattern
     *  @param callable $callback
     *  @param string|NULL $name
     *  @return Router
     */
    public function post(string $pattern, callable $callback, ?string $name = NULL) : Router {
        $this->setRoute(self::POST . " ", $pattern, $callback, $name);
        return $this;
    }

    /**
     *  Put
     *  @since v1.0.0
     *
     *  @param string $pattern
     *  @param callable $callback
     *  @param string|NULL $name
     *  @return Router
     */
    public function put(string $pattern, callable $callback, ?string $name = NULL) : Router {
        $this->setRoute(self::PUT . " ", $pattern, $callback, $name);
        return $this;
    }

    /**
     *  Delete
     *  @since v1.0.0
     *
     *  @param string $pattern
     *  @param callable $callback
     *  @param string|NULL $name
     *  @return Router
     */
    public function delete(string $pattern, callable $callback, ?string $name = NULL) : Router {
        $this->setRoute(self::DELETE . " ", $pattern, $callback, $name);
        return $this;
    }

    /**
     *  Get Matched Pattern
     *  @since v1.0.0
     *  
     *  @return string
     */
    public function getMatchedPattern() : string {
        return $this->_Base->get('PATTERN');
    }

    /**
     *  Get Path
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getPath() : string {
        return $this->_Base->get('PATH');
    }
 
}