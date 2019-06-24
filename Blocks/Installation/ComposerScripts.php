<?php
declare(strict_types=1);

namespace Blocks\Installation;

use \Composer\Script\Event;
use \League\Flysystem\Filesystem;
use \League\Flysystem\Adapter\Local;

/**
 *  COMPOSER SCRIPTS
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 *
 *  @see \Composer\Script\Event
 *  @see \League\Flysystem\Filesystem
 *  @see \League\Flysystem\Adapter\Local
 */
final class ComposerScripts {

    /**
     *  @const string ROOT_PATH
     */
    const ROOT_PATH = __DIR__ . "/../../../../../";

    /**
     *  @const string PACKAGE_PATH
     */
    const PACKAGE_PATH = "vendor/sonusgeneration/fat-free-blocks/";

    /**
     *  Blocks Install
     *  @since v1.0.0
     *
     *  @param \Composer\Script\Event $event
     */
    public static function blocksInstall(Event $event) {
        require_once($event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php');

        # Create the filesystem...
        $filesystem = new Filesystem(new Local(self::ROOT_PATH, LOCK_EX, Local::DISALLOW_LINKS, [
            'file' => [
                'public'  => 0644,
                'private' => 0700
            ],
            'dir'  => [
                'public'  => 0755,
                'private' => 0700
            ]
        ]));
        
        # Scaffold project directories...
        $filesystem->createDir("Models");

        # Scaffold "tmp" directories...
        $filesystem->createDir("tmp");
        $filesystem->createDir("tmp/cache");
        $filesystem->createDir("tmp/logs");
        $filesystem->createDir("tmp/uploads");

        # Setup "config" directory and contents...
        $filesystem->createDir("config");
        $filesystem->copy(self::PACKAGE_PATH . "config/app.cfg", "config/app.cfg");

        # Setup "Controllers" directory and contents...
        $filesystem->createDir("Controllers");
        $filesystem->copy(self::PACKAGE_PATH . "Controllers/BaseController.php", "Controllers/BaseController.php");
        $filesystem->copy(self::PACKAGE_PATH . "Controllers/HomeController.php", "Controllers/HomeController.php");

        # Setup "Views" directory and contents...
        $filesystem->createDir("Views");
        $filesystem->copy(self::PACKAGE_PATH . "Views/sample-view.html", "Views/sample-view.html");

        # Copy root files...
        $filesystem->copy(self::PACKAGE_PATH . ".htaccess", ".htaccess");
        $filesystem->copy(self::PACKAGE_PATH . "bootstrap.php", "bootstrap.php");
        $filesystem->copy(self::PACKAGE_PATH . "constants.php", "constants.php");
        $filesystem->copy(self::PACKAGE_PATH . "humans.txt", "humans.txt");
        $filesystem->copy(self::PACKAGE_PATH . "index.php", "index.php");
        $filesystem->copy(self::PACKAGE_PATH . "prerequisites.php", "prerequisites.php");
        $filesystem->copy(self::PACKAGE_PATH . "robots.txt", "robots.txt");
        $filesystem->copy(self::PACKAGE_PATH . "routes.php", "routes.php");
    }

    /**
     *  Blocks Uninstall
     *  @since v1.0.0
     *
     *  @param \Composer\Script\Event $event
     */
    public static function blocksUninstall(Event $event) {
        require_once($event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php');

        # Create the filesystem...
        $filesystem = new Filesystem(new Local(self::ROOT_PATH));

        # Remove the files...
        $filesystem->delete(".htaccess");
        $filesystem->delete("bootstrap.php");
        $filesystem->delete("constants.php");
        $filesystem->delete("humans.txt");
        $filesystem->delete("index.php");
        $filesystem->delete("prerequisites.php");
        $filesystem->delete("robots.txt");
        $filesystem->delete("routes.php");

        # Remove the directories...
        $filesystem->deleteDir("Controllers");
        $filesystem->deleteDir("Models");
        $filesystem->deleteDir("Views");
        $filesystem->deleteDir("tmp");
        $filesystem->deleteDir("config");
    }
}