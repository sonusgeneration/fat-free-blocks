<?php
declare(strict_types=1);

if(!defined('BLOCKS_KEY')) {
    exit("Access denied.");
}

/*
 *  Prerequisites
 *
 *  We have a few requirements to run the application
 *  successfully. Let's double check that our environment
 *  is configured correctly.
 */

# PHP Version > 7
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 70100) {
    exit("Fat-Free Blocks requires PHP 7.1.0+ to run.<br />You are running PHP " . PHP_VERSION);
}

# "mbstring" extension is a must for UTF-8...
if(!extension_loaded('mbstring')) {
    exit("Fat-Free Blocks requires the Multibyte String (mbstring) extension.");
}

# "json_encode" extension is required for serialization...
if(!extension_loaded('json')) {
    exit("Fat-Free Blocks requires the JSON (json) extension.");
}

# "pdo" extension is required for database access...
if(!extension_loaded('pdo') OR !extension_loaded('pdo_mysql')) {
    exit("Fat-Free Blocks requires the PDO (pdo) and PDO MySQL (pdo_mysql) extensions.");
}

# "zip" extension is required for automatic updates...
if(!extension_loaded('zip')) {
    exit("Fat-Free Blocks requires the Zip (zip) extension.");
}