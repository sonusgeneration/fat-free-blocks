<?php
namespace Blocks\Installation;

use \Composer\Script\Event;
use \League\Flysystem\Filesystem;
use \League\Flysystem\Adapter\Local;

class ComposerScripts {

    const ROOT_PATH = __DIR__ . "/../../../../../";
    const PACKAGE_PATH = "vendor/sonusgeneration/fat-free-blocks/";

    public static function postInstall(Event $event) {
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
        $filesystem->createDir("Controllers");
        $filesystem->createDir("Models");
        $filesystem->createDir("Views");

        # Scaffold "tmp" directories...
        $filesystem->createDir("tmp");
        $filesystem->createDir("tmp/cache");
        $filesystem->createDir("tmp/logs");
        $filesystem->createDir("tmp/uploads");

        # Setup "config" directory and contents...
        $filesystem->createDir("config");
        $filesystem->copy(self::PACKAGE_PATH . "config/cache.cfg", "config/cache.cfg");
        $filesystem->copy(self::PACKAGE_PATH . "config/cookie.cfg", "config/cookie.cfg");
        $filesystem->copy(self::PACKAGE_PATH . "config/database.cfg", "config/database.cfg");
        $filesystem->copy(self::PACKAGE_PATH . "config/site.cfg", "config/site.cfg");

        # Copy app files...
        $filesystem->copy(self::PACKAGE_PATH . ".htaccess", ".htaccess");
        $filesystem->copy(self::PACKAGE_PATH . "bootstrap.php", "bootstrap.php");
        $filesystem->copy(self::PACKAGE_PATH . "constants.php", "constants.php");
        $filesystem->copy(self::PACKAGE_PATH . "humans.txt", "humans.txt");
        $filesystem->copy(self::PACKAGE_PATH . "index.php", "index.php");
        $filesystem->copy(self::PACKAGE_PATH . "prerequisites.php", "prerequisites.php");
        $filesystem->copy(self::PACKAGE_PATH . "robots.txt", "robots.txt");
        $filesystem->copy(self::PACKAGE_PATH . "routes.php", "routes.php");
    }

}