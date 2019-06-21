<?php
declare(strict_types=1);

namespace Controllers;

use \Blocks\Foundation\Kernel;

/**
 *  BASE CONTROLLER
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Kernel
 */
abstract class BaseController {

    /**
     *  @property \Blocks\Foundation\Http\Request $_Request
     */
    protected $_Request = NULL;

    /**
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {
        $this->_Request = Kernel::getRequest();
    }

    /**
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() {
        $this->_Request = NULL;
    }

}