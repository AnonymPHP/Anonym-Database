<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

include 'vendor/autoload.php';
$base = new \Anonym\Components\Database\Base(
    [
        'host'     => 'localhost',
        'db'       => 'test',
        'username' => 'root',
        'password' => ''
    ]
);

