<?php
declare(strict_types=1);

namespace Blocks\Foundation;

use \Base;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/**
 *  SESSION
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Base
 */
final class Session {

    /**
     *  @const string PREFIX
     */
    const PREFIX = "SESSION";

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
     *  Get
     *  @since v1.0.0
     *
     *  @param string $name
     *  @return mixed|NULLABLE
     */
    public function get(string $name) : ?mixed {
        return ($this->_Base->exists(self::PREFIX . "." . $name)) 
            ? $this->_Base->get(self::PREFIX . "." . $name) : NULL;
    }

    /**
     *  Get Multiple
     *  @since v1.0.0
     *
     *  @param array $names
     *  @return array
     */
    public function mget(array $names) : array {
        $values = [];

        foreach($names as $name) {
            $values[$name] = ($this->_Base->exists(self::PREFIX . "." . $name)) 
                ? $this->_Base->get(self::PREFIX . "." . $name) : NULL;
        }

        return $values;
    }

    /**
     *  Set
     *  @since v1.0.0
     *
     *  @param string $name
     *  @param mixed $value
     *  @return Session
     */
    public function set(string $name, mixed $value) : Session {
        $this->_Base->set(self::PREFIX . "." . $name, $value);

        return $this;
    }

    /**
     *  Set Multiple
     *  @since v1.0.0
     *
     *  @param array $props
     *  @return Session
     */
    public function mset(array $props) : Session {
        foreach($props as $name => $value) {
            $this->_Base->set(self::PREFIX . "." . $name, $value);
        }

        return $this;
    }

    /**
     *  Remove
     *  @since v1.0.0
     *
     *  @param string $name
     *  @return Session
     */
    public function clear(string $name) : Session {
        $this->_Base->clear(self::PREFIX . "." . $name);

        return $this;
    }

    /**
     *  Flush
     *  @since v1.0.0
     *
     *  @return Session
     */
    public function flush() : Session {
        $this->_Base->set(self::PREFIX, []);

        return $this;
    }

}