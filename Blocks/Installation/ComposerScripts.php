<?php
namespace Blocks\Installation;

use \Composer\Script\Event;

class ComposerScripts {

    const APP_PATH = __DIR__ . "/../../../../../";
    const PACKAGE_PATH = __DIR__ . "/../../";

    public static function postInstall(Event $event) {
        require_once($event->getComposer()->getConfig()->get('vendor-dir').'/autoload.php');
    }

}
