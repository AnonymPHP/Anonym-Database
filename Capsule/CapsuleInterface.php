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
 * Interface CapsuleInterface
 * @package Anonym\Components\Database\Capsule
 */
interface CapsuleInterface
{

    /**
     * add a connection to capsule
     *
     * @param Base $connection
     * @param string $name
     * @throws CapsuleInstanceException
     */
    public function addConnection(Base $connection = null, $name = '');

    /**
     * delete a connection in capsule
     *
     * @param mixed $offset
     * @return $this
     */
    public function deleteConnection($offset);
}