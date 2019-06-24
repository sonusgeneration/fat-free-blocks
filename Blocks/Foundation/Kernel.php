<?php
declare(strict_types=1);

namespace Blocks\Foundation;

use \Prefab;
use \Base;
use \Registry;
use \Log;
use \Cache;
use \PDO;
use \DB\SQL;
use \DB\SQL\Session as SessionHandler;
use \Blocks\Foundation\Router;
use \Blocks\Foundation\Http\Request;
use \Blocks\Foundation\Session;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/**
 *  KERNEL
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Prefab
 *  @see \Base
 *  @see \Registry
 *  @see \Log
 *  @see \Cache
 *  @see \PDO
 *  @see \Blocks\Foundation\Router
 *  @see \Blocks\Foundation\Http\Request
 *  @see \Blocks\Foundation\Session
 */
final class Kernel extends Prefab {

    /**
     *  Class Constructor
     *  @since v1.0.0
     */
    public function __construct() {
        $Base = Base::instance();

        # Load Application configs
        $files = array_filter(glob(ABS_PATH_CONFIG . "*.{cfg}", GLOB_BRACE), 'is_file');
        foreach($files as $file) {
            $Base->config($file);
        }
        
        # Set system settings
        $Base->mset([
            # Core settings
            'AUTOLOAD'    => ABS_PATH_BASE,
            'CACHE'       => "folder=" . ABS_PATH_TEMP . $Base->get('appp.cache.folder'),
            'CASELESS'    => TRUE,
            'DEBUG'       => 3,
            'ENCODING'    => 'UTF-8',
            'HALT'        => TRUE,
            'CORS.Origin' => $Base->get('HEADER.Origin'),
            'JAR'         => [
                'expire'   => (int)$Base->get('app.cookie.expire'),
                'path'     => $Base->get('app.cookie.path'),
                'domain'   => $Base->get('app.cookie.domain'),
                'secure'   => (bool)$Base->get('app.cookie.secure'),
                'httponly' => (bool)$Base->get('app.cookie.httponly')
            ],
            'LOGS'        => ABS_PATH_TEMP_LOGS,
            'PACKAGE'     => "Fat-Free Blocks",
            'QUIET'       => FALSE,
            'RAW'         => TRUE,
            'TEMP'        => ABS_PATH_TEMP,
            'TZ'          => $Base->get('app.site.timezone'),
            'UPLOADS'     => ABS_PATH_TEMP_UPLOADS
        ]);

        # Create the Router
        Registry::set("Router", new Router($Base));

        # Create the System Logger
        Registry::set("SystemLogger", new Log(FILENAME_SYSTEM_LOG));

        # Create the Error Logger
        Registry::set("ErrorLogger", new Log(FILENAME_ERROR_LOG));

        # Create the Database
        Registry::set("Database", new SQL($Base->get('app.database.dsn'),
            $Base->get('app.database.user'), 
            $Base->get('app.database.password'),
            [
                PDO::ATTR_ERRMODE          => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => FALSE
            ]));
        
        new SessionHandler(Registry::get("Database"), TABLE_SESSION, TRUE, NULL, "CSRF");

        # Create the Http Request
        Registry::set("Request", new Request($Base));

        # Create the Session
        Registry::set("Session", new Session($Base));
    }

    /**
     *  Class Destructor
     *  @since v1.0.0
     */
    public function __destruct() { }

    #------------------------#
    #    Kernel Functions    #
    #------------------------#

    /**
     *  Run
     *  @since v1.0.0
     *
     *  @return void
     */
    public function run() : void {
        (Base::instance())->run();
    }

    #----------------------#
    #    Kernel Objects    #
    #----------------------#

    /**
     *  Get Core
     *  @since v1.0.0
     *
     *  @return \Base
     */
    public static function getCore() : Base {
        return Registry::get("Base");
    }

    /**
     *  Get Router
     *  @since v1.0.0
     *
     *  @return \Blocks\Foundation\Router
     */
    public static function getRouter() : Router {
        return Registry::get("Router");
    }

    /**
     *  Get System Logger
     *  @since v1.0.0
     *
     *  @return \Log
     */
    public static function getSystemLogger() : Log {
        return Registry::get("SystemRouter");
    }

    /**
     *  Get Error Logger
     *  @since v1.0.0
     *
     *  @return \Log
     */
    public static function getErrorLogger() : Log {
        return Registry::get("ErrorLogger");
    }

    /**
     *  Get Database
     *  @since v1.0.0
     *
     *  @return \DB\SQL
     */
    public static function getDatabase() : SQL {
        return Registry::get("Database");
    }

    /**
     *  Get Request
     *  @since v1.0.0
     *
     *  @return \Blocks\Foundation\Http\Request
     */
    public static function getRequest() : Request {
        return Registry::get("Request");
    }

    /**
     *  Get Session
     *  @since v1.0.0
     *
     *  @return \Blocks\Foundation\Session
     */
    public static function getSession() : Session {
        return Registry::get("Session"); 
    }

    /**
     *  Get Cache (Lazy Loaded)
     *  @since v1.0.0
     *
     *  @return \Cache
     */
    public static function getCache() : Cache {
        return Cache::instance();
    }

    /**
     *  Get Web Client
     *  @since v1.0.0
     *
     *  @return \Web
     */
    public static function getHttpClient() : Web {
        return Web::instance();
    }

}