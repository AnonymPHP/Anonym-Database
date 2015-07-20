<?php
    /**
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @copyright AnonymMedya, 2015
     */

    namespace Anonym\Components\Database\Tools\Migration;

    /**
     * Interface MigrationInterface
     * @package Anonym\Components\Database\Tools\Migration
     */
    interface MigrationInterface
    {
        public function up();

        public function down();
    }