<?php
declare(strict_types=1);

use \Blocks\Foundation\Kernel;

# Define the key...
defined('BLOCKS_KEY') 
    OR define('BLOCKS_KEY', sha1(uniqid("", TRUE)));
defined('FILENAME_CONSTANTS') 
    OR define('FILENAME_CONSTANTS', "constants.php");

# Require the constants...
require_once(FILENAME_CONSTANTS);

# Prerequisites...
require_once(FILENAME_PREREQUISITES);

/*
 *  Composer
 *
 *  Composer is nice enough to create an autoload.php
 *  PSR-4/7 compatible autoloader for us to load our
 *  required dependencies. Let's go ahead and include
 *  it here.
 */
require_once(ABS_PATH_VENDOR . FILENAME_AUTOLOAD);

# Initialize the Kernel...
Registry::set("Kernel", Kernel::instance());

# Load routes...
require_once(FILENAME_ROUTES);

# Run the application...
(Kernel::instance())->run();