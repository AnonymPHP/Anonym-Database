<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\Database\Capsule;

use Anonym\Components\Database\Base;

/**
 * Class Capsule
 * @package Anonym\Components\Database\Capsule
 */
class Capsule
{

    /**
     * the story of connections
     *
     * @var array
     */
    private $connections;

    /**
     * create a new instance and add the connection
     *
     * @param Base $connection
     */
    public function __construct($connection = null)
    {
        $this->addConnection($connection);
    }

    public function addConnection($connection = null)
    {

    }

}
