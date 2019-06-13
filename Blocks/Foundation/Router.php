<?php
declare(strict_types=1);

namespace Blocks\Foundation;

use \Base;
use \Nette\SmartObject;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/**
 *  ROUTER
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Base
 *  @see \Prefab
 */
final class Router {

    /**
     *  @see \Nette\SmartObject
     */
    use SmartObject;
     

    /**
     *  @property \Base $_Base
     */
    private $_Base = NULL;

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
     *  @param string $pattern
     *  @param callable $callable
     *  @return Router
     */
    public function setRoute(string $pattern, callable $callback) : Router {
        $this->_Base->route($pattern, $callback);
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
     *  return string
     */
    public function getPath() : string {
        return $this->_Base->get('PATH');
    }
 
}