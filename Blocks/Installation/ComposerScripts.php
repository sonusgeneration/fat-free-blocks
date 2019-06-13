<?php
namespace Blocks\Installation;

use \Composer\Script\Event;

class ComposerScripts {

    public static function postInstall(Event $event) {
        require_once($event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php');
        Nette\Utils\FileSystem::createDir(__DIR__ . DIRECTORY_SEPARATOR . "Controllers", 0755);
    }

}