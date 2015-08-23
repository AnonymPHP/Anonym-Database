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
     * @param string $name
     */
    public function __construct($connection = null, $name = '')
    {
        $this->addConnection($connection, $name);
    }

    public function addConnection($connection = null, $name = '')
    {
        if($connection instanceof Base)
        {
            if($name !== '')
            {
                $this->connections[$name] = $connection;
            }else{
                $this->connections[] = $connection;
            }
        }else{

        }
    }

}
