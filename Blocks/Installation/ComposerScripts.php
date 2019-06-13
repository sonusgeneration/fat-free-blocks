<?php
namespace Blocks\Installation;

use \Composer\Script\Event;

class ComposerScripts {

    public static function postInstall(Event $event) {
        require_once($event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php');

        define('APP_PATH', __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".."
            . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".."
            . DIRECTORY_SEPARATOR);

        Nette\Utils\FileSystem::createDir(APP_PATH . "Controllers", 0755);
    }

}