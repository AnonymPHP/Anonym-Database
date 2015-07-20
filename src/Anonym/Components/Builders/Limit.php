<?php

    /**
     *  AnonymFramework Limit Builder -> limit sorgular� burada olu�tururlur
     *
     * @package  Anonym\Components\Database\Builders;
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     */

    namespace Anonym\Components\Database\Builders;


    /**
     * Class Limit
     * @package Anonym\Components\Database\Builders
     */
    class Limit
    {

        use Parser;

        public function limit($limit)
        {

            if (is_string($limit)) {

                $lArray = $this->explode("..", $limit);
            }

            if (is_numeric($limit)) {

                $lArray = [$limit];
            }

            if (is_array($limit)) {

                $lArray = $limit;
            }

            if (count($lArray) == 2) {

                $limit = "{$lArray[0]},{$lArray[1]}";
            } else {
                $limit = "{$lArray[0]}";
            }

            return "LIMIT $limit";
        }
    }