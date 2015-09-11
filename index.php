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


$paginator = new \Anonym\Components\Database\Pagination\Paginator([], 15, 1, [
    'path' => 'http://example.com/',
    'pageName' => 'page'
]);


$render = new \Anonym\Components\Database\Pagination\Render($paginator);

var_dump($render->standartRendeArray());