<?php
declare(strict_types=1);

if(!defined('BLOCKS_KEY')) {
    exit("Access denied.");
}

/**
 *  Constants
 *
 *  Let's define our constants that will be used throughout
 *  the application. We'll define them in the following
 *  order:
 *
 *  - Filenames
 *  - Directory Names
 *  - Absolute Paths
 */

# Filenames
defined('FILENAME_DISPATCHER')
    OR define('FILENAME_DISPATCHER', "index.php");
defined('FILENAME_AUTOLOAD')
    OR define('FILENAME_AUTOLOAD', "autoload.php");
defined('FILENAME_KERNEL')
    OR define('FILENAME_KERNEL', "Kernel.php");
defined('FILENAME_SYSTEM_LOG')
    OR define('FILENAME_SYSTEM_LOG', "system." . date('Y-m-d') . ".log");
defined('FILENAME_ERROR_LOG')
    OR define('FILENAME_ERROR_LOG', "error." . date('Y-m-d') . ".log");
defined('FILENAME_ROUTES')
    OR define('FILENAME_ROUTES', "routes.php");
defined('FILENAME_SITE_CONFIG')
    OR define('FILENAME_SITE_CONFIG', "site.cfg");
defined('FILENAME_COOKIE_CONFIG')
    OR define('FILENAME_COOKIE_CONFIG', "cookie.cfg");
defined('FILENAME_DB_CONFIG')
    OR define('FILENAME_DATABASE_CONFIG', "database.cfg");
defined('FILENAME_CACHE_CONFIG')
    OR define('FILENAME_CACHE_CONFIG', "cache.cfg");
defined('FILENAME_PREREQUISITES')
    OR define('FILENAME_PREREQUISITES', "prerequisites.php");

# Directory Names
defined('DIRNAME_CORE')
    OR define('DIRNAME_CORE', "Blocks");
defined('DIRNAME_FOUNDATION')
    OR define('DIRNAME_FOUNDATION', "Foundation");
defined('DIRNAME_VENDOR')
    OR define('DIRNAME_VENDOR', "vendor");
defined('DIRNAME_TEMP')
    OR define('DIRNAME_TEMP', "tmp");
defined('DIRNAME_LOGS')
    OR define('DIRNAME_LOGS', "logs");
defined('DIRNAME_CACHE')
    OR define('DIRNAME_CACHE', "cache");
defined('DIRNAME_CONFIG')
    OR define('DIRNAME_CONFIG', "config");
defined('DIRNAME_UPLOADS')
    OR define('DIRNAME_UPLOADS', "uploads");

# Absolute Paths
defined('ABS_PATH_ROOT')
    OR define('ABS_PATH_ROOT', str_replace(DIRECTORY_SEPARATOR, "/", dirname($_SERVER['SCRIPT_FILENAME'])) . "/");
defined('ABS_PATH_BASE')
    OR define('ABS_PATH_BASE', str_replace(DIRECTORY_SEPARATOR, "/", __DIR__) . "/");
defined('ABS_PATH_TEMP')
    OR define('ABS_PATH_TEMP', ABS_PATH_BASE . DIRNAME_TEMP . "/");
defined('ABS_PATH_TEMP_LOGS')
    OR define('ABS_PATH_TEMP_LOGS', ABS_PATH_TEMP . DIRNAME_LOGS . "/");
defined('ABS_PATH_CORE')
    OR define('ABS_PATH_CORE', ABS_PATH_BASE . DIRNAME_CORE . "/");
defined('ABS_PATH_CORE_FOUNDATION')
    OR define('ABS_PATH_CORE_FOUNDATION', ABS_PATH_CORE . DIRNAME_FOUNDATION . "/");
defined('ABS_PATH_VENDOR')
    OR define('ABS_PATH_VENDOR', ABS_PATH_BASE . DIRNAME_VENDOR . "/");
defined('ABS_PATH_CONFIG')
    OR define('ABS_PATH_CONFIG', ABS_PATH_BASE . DIRNAME_CONFIG . "/");
defined('ABS_PATH_TEMP_UPLOADS')
    OR define('ABS_PATH_TEMP_UPLOADS', ABS_PATH_TEMP . DIRNAME_UPLOADS . "/");

# Table Names
defined('TABLE_SESSION')
    OR define('TABLE_SESSION', "SESSION");