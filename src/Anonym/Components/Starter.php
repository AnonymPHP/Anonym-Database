<?php

    /**
     *  AnonymFramework Veritabanı pdo instance oluşturma sınıfı
     *
     * @package Anonym\Components\Database
     * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
     * @copyright MyfcYazilim
     */

    namespace Anonym\Components\Database;

    use PDO;

    /**
     * Class Starter
     * @package Anonym\Components\Database
     */
    class Starter
    {

        /**
         * @var \mysqli|pdo
         */
        private $db;

        public function __construct($options = [])
        {

            $host = $options['host'] ?: '';
            $database = $options['db'] ?: '';
            $username = $options['username'] ?: '';
            $password = $options['password'] ?: '';
            $charset = $options['charset'] ?: 'utf-8';

            if (!isset($options['driver'])) {
                $driver = 'pdo';
            } else {
                $driver = $options['driver'];
            }

            if (!isset($options['type'])) {
                $type = 'mysql';
            } else {
                $type = $options['type'];
            }

            switch ($driver) {

                case 'pdo':

                    try {

                        $db = new PDO("$type:host=$host;dbname=$database", $username, $password);
                        $this->db = $db;
                    } catch (\PDOException $e) {

                        throw new \Exception($e->getMessage());
                    }

                    break;
                case 'mysqli':

                    $db = new \mysqli($host, $username, $password, $database);

                    if ($db->connect_errno > 0) {
                        throw new \Exception('Bağlantı işlemi başarısız [' . $db->connect_error . ']');
                    }

                    $this->db = $db;
                    break;
            }
        }

        /**
         * Veritabanını döndürür
         *
         * @return \mysqli
         */
        public function getDb()
        {
            return $this->db;
        }
    }