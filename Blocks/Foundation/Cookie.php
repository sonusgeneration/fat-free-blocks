<?php
declare(strict_types=1);

namespace Blocks\Foundation;

use \Blocks\Foundation\Kernel;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/**
 *  COOKIE
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 */
final class Cookie {     

    private $_name = "";

    private $_value = "";

    private $_expire = 0;

    private $_path = "";

    private $_domain = "";

    private $_secure = FALSE;

    private $_http_only = FALSE;

    /**
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct(string $name = "", string $value = "") {
        $Base = Kernel::getCore();

        $this->_name = (!empty($name)) ? $name : "";
        $this->_value = (!empty($value)) ? $value : "";

        # Set cookie properties from application defaults...
        $this->_expire = $Base->get('JAR.expire');
        $this->_path = $Base->get('JAR.path');
        $this->_domain = $Base->get('JAR.path');
        $this->_secure = $Base->get('JAR.secure');
        $this->_http_only = $Base->get('JAR.httponly');
    }

    /**
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {}

    /**
     *  Get Name
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getName() : string {
        return $this->_name;
    }   

    /**
     *  Set Name
     *  @since v1.0.0
     *  
     *  @param string $name
     *  @return Cookie
     */
    public function setName(string $name) : Cookie {
        $this->_name = $name;
        return $this;
    }

    /**
     *  Get Value
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getValue() : string {
        return $this->_value;
    }

    /**
     *  Set Value
     *  @since v1.0.0
     *
     *  @param string $value
     *  @return Cookie
     */
    public function setValue(string $value) : Cookie {
        $this->_value = $value;
        return $this;
    }

    /**
     *  Get Expiration
     *  @since v1.0.0
     *
     *  @return int
     */
    public function getExpiration() : int {
        return $this->_expire;
    }

    /**
     *  Set Expiration
     *  @since v1.0.0
     *
     *  @param int $expire
     *  @return Cookie
     */
    public function setExpiration(int $expire) : Cookie {
        $this->_expire = $expire;
        return $this;
    }

    /**
     *  Get Path
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getPath() : string {
        return $this->_path;
    }

    /**
     *  Set Path
     *  @since v1.0.0
     *
     *  @param string $path
     *  @return Cookie
     */
    public function setPath(string $path) : Cookie {
        $this->_path = $path;
        return $this;
    }

    /**
     *  Get Domain
     *  @since v1.0.0
     *
     *  @return string
     */
    public function getDomain() : string {
        return $this->_domain;
    }

    /**
     *  Set Domain
     *  @since v1.0.0
     *
     *  @param string $domain
     *  @return Cookie
     */
    public function setDomain(string $domain) : Cookie {
        $this->_domain = $domain;
        return $this;
    }

    /**
     *  Get Secure
     *  @since v1.0.0
     *
     *  @return bool
     */
    public function getSecure() : bool {
        return $this->_secure;
    }

    /**
     *  Set Secure
     *  @since v1.0.0
     *
     *  @param bool $secure
     *  @return Cookie
     */
    public function setSecure(bool $secure) : Cookie {
        $this->_secure = $secure;
        return $this;
    }

    /**
     *  Get Http Only
     *  @since v1.0.0
     *
     *  @return bool
     */
    public function getHttpOnly() : bool {
        return $this->_http_only;
    }

    /**
     *  Set Http Only
     *  @since v1.0.0
     *
     *  @param bool $http_only
     *  @return Cookie
     */
    public function setHttpOnly(bool $http_only) : Cookie {
        $this->_http_only = $http_only;
        return $this;
    }

    /**
     *  Save
     *  @since v1.0.0
     */
    public function save() : void {
        # Get the core...
        $Base = Kernel::getCore();

        # Backup the jar...
        $jar = $Base->get('JAR');

        # Set the new jar and cookie...
        $Base->set('JAR', [
            'expire'   => $this->_expire,
            'path'     => $this->_path,
            'domain'   => $this->_domain,
            'secure'   => $this->_secure,
            'httponly' => $this->_http_only
        ]);
        $Base->set('COOKIE.' . $this->_name, $this->_value);

        # Reset the jar to the defaults...
        $Base->set('JAR', $jar);
    }
 
}