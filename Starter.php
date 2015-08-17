<?php

/**
 *  AnonymFramework Veritabanı pdo instance oluşturma sınıfı
 *
 * @package Anonym\Components\Database
 * @author vahitserifsaglam1 <vahit.serif119@gmail.com>
 * @copyright MyfcYazilim
 */

namespace Anonym\Components\Database;
use Anonym\Components\Database\Exceptions\ConnectionException;
use PDO;
use PDOException;

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

    /**
     * Ayaları tutar
     *
     * @param array $options
     * @throws ConnectionException
     */
    public function __construct($options = [])
    {

        $host = isset($options['host']) ? $options['host'] : '';
        $database = isset($options['db']) ? $options['db'] : '';
        $username = isset($options['username']) ? $options['username'] : '';
        $password = isset($options['password']) ? $options['password'] : '';
        $charset = isset($options['charset']) ? $options['charset'] : 'utf8';

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
                } catch (PDOException $e) {

                    throw new ConnectionException($e->getMessage());
                }

                break;
            case 'mysqli':

                $db = new \mysqli($host, $username, $password, $database);

                if ($db->connect_errno > 0) {
                    throw new ConnectionException('Bağlantı işlemi başarısız [' . $db->connect_error . ']');
                }

                $this->db = $db;
                break;
        }

        $this->db->query(sprintf("SET CHARACTER SET %s", $charset));
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
