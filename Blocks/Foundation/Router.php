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
     *  Add Name
     *  @since v1.0.0
     *
     *  @param string $name
     *  @return string
     */
    private function addName(string $name) : string {
        return "@" . $name . ": ";
    }

    /**
     *  Add Pattern
     *  @since v1.0.0
     *
     *  @param string $pattern
     *  @return string
     */
    private function addPattern(string $pattern) : string {
        return "/" . ltrim(str_replace(["{:", "}"], ["@", ""], $pattern), "/");
    }

    /**
     *  Set Route
     *  @since v1.0.0
     *
     *  @param string $pattern
     *  @param callable $callable
     *  @return Router
     */
    private function setRoute(string $pattern, callable $callback) : void {
        $this->_Base->route($pattern, $callback);
    }

    /**
     *  Get
     *  @since v1.0.0
     *
     *  @param string $pattern
     *  @param callable $callback
     *  @param ?string $name
     *  @return Router
     */
    public function get(string $pattern, callable $callback, ?string $name = NULL) : Router {
        # Start route...
        $route = self::GET . " ";
        
        # Add name...
        if(!empty($name)) {
            $route .= $this->addName($name);
        }

        # Add Pattern
        $route .= $this->addPattern($pattern);

        # Set route...
        $this->setRoute($route, $callback);

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