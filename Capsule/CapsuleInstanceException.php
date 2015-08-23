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
use Exception;

class CapsuleInstanceException extends Exception
{

    public function __construct($message = '')
    {
        $this->message = $message;
    }
}