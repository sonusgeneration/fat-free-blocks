<?php
declare(strict_types=1);

namespace Blocks\Foundation\Http;

use \Blocks\Foundation\Http\Response;

if(!defined('BLOCKS_KEY')) {
    exit('Access denied.');
}

/*
 *  IRESPONSE
 *  @since v1.0.0
 *  @author Christopher Rains <christopher.rains@sonusgeneration.com>
 */
interface IResponse {

    /*
     *  Set Content
     *  @since v1.0.0
     *
     *  @param mixed $content
     *  @return \Blocks\Foundation\Http\Response
     */
    public function setContent($content) : Response;

}