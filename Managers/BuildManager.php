<?php

namespace Anonym\Components\Database\Managers;

use Anonym\Components\Database\Exceptions\FetchException;
use Anonym\Components\Database\Exceptions\QueryException;
use Anonym\Components\Database\Helpers\Pagination;
use mysqli_stmt;
use PDO;
use PDOStatement;
use Anonym\Components\Database\Base;
use mysqli;

/**
 * Class BuildManager
 * @package Anonym\Components\Database\Builders
 */
class BuildManager
{

    /**
     * Seçilen tabloyu tutar
     *
     * @var string
     */
    private $table;

    /**
     * @var \PDO
     */
    protected $connection;

    /**
     * Query metnini tutar
     *
     * @var string
     */
    private $query;

    /**
     * Sayfayı tutar
     *
     * @var int
     */
    private $page;

    /**
     * Gönderilecek parametreleri tutar
     *
     * @var array
     */
    private $params = [];

    /**
     * Base Ataması yapar
     *
     * @param Base $base
     */
    public function __construct($base)
    {

        $this->connection = $base;
    }

    /**
     * Sayfalama olayı için şuan bulunulan sayfayı atar
     *
     * @param int $page
     * @return $this
     */
    public function setPage($page = 0)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Query Sorgusunu atar
     *
     * @param string $query
     */
    public function setQuery($query)
    {

        $this->query = $query;
    }

    /**
     * parametreleri atar
     *
     * @param array $params
     */
    public function setParams($params = [])
    {

        $this->params = $params;
    }


    /**
     * execute the query
     *
     * @param $query bool
     * @throws QueryException
     * @return PDOStatement|mysql_stmt|bool success on PDOStatement or mysql_stmt, if failure the query return false
     */
    public function run($query = false, $exception = true)
    {

        if (true === $query) {
            return $this->resolveQuery($this->query);
        }

        $query = $this->resolvePreparedStatement($this->query, $this->params);


        /* if (true === $query) {
             $query = $this->connection->query($this->query);
             return $query;
         } else {
             $prepare = $this->connection->prepare($this->query);
         }
         if ($prepare instanceof PDOStatement) {
             $execute = $prepare->execute($this->params);
         } elseif ($prepare instanceof mysqli_stmt) {

             $s = "";
             foreach ($this->params as $param) {

                 if (is_string($param)) {
                     $s .= "s";
                 } elseif (is_integer($param)) {
                     $s .= "i";
                 }
             }

             if (count($this->params) < 1) {
                 $param_arr = [];
             } else {
                 $param_arr = array_merge([$s], $this->params);
             }

             call_user_func_array([$prepare, 'bind_param'], $this->refValues($param_arr));
             $execute = $prepare->execute();

         }

         if (isset($execute)) {
             if (false === $execute) {

                 if ($this->connection instanceof PDO) {
                     $message = isset($this->connection->errorInfo()['message']) ? $this->connection->errorInfo()['message'] : 'Something Went Wrong!';
                 } elseif ($this->connection instanceof mysqli) {
                     $message = $this->connection->error;
                 }

                 throw new QueryException(sprintf('There is an error in your sql query: %s', $message));
             }
         }
         return $prepare;

        */
    }


    /**
     * run the query
     *
     * @param string $query
     * @return PDOStatement|mysql_stmt|bool success on PDOStatement or mysql_stmt, if failure the query return false
     */
    private function resolveQuery($query)
    {
        return $this->getConnection()->query($query);
    }

    /**
     *
     *
     * @param $arr
     * @return array
     */
    private function refValues($arr)
    {
        if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = [];
            foreach ($arr as $key => $value) {
                $refs[$key] = &$arr[$key];
            }

            return $refs;
        }

        return $arr;
    }

    /**
     * Sayfalama işlemini yapar
     *  ['url' => 'asdasd/asdasd/:page', 'now' = 0]
     *
     * @param array $configs
     * @param array $action
     * @param bool $return
     * @return string
     */
    public function pagination($configs = [], $action = [], $return = true)
    {

        if (!is_array($action)) {
            $action = [
                'url' => $action,
                'now' => $this->page,
            ];
        }
        $pagination = new Pagination($configs);
        $pagination->setCount($this->run()->rowCount());
        $paginate = $pagination->paginate($action);

        if (!$return) {
            echo $paginate;
        } else {
            return $paginate;

        }
    }

    /**
     * @param bool|false $fetchAll
     * @return array|mixed|object|\stdClass
     * @throws FetchException
     */
    public function fetch($fetchAll = false)
    {

        $query = $this->run();

        if ($query instanceof PDOStatement) {

            if ($fetchAll) {
                return $query->fetchAll();
            } else {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } elseif ($query instanceof mysqli_stmt) {

            $query = $query->get_result();
            if ($fetchAll) {
                return $query->fetch_all();
            } else {
                return $query->fetch_object();
            }
        } else {

            throw new FetchException(sprintf('Girdiğiniz veri tipi geçerli bir query değil. Tip:%s', gettype($query)));
        }
    }

    /**
     * Tüm işlemleri döndürür
     *
     * @return array|mixed|object|\stdClass
     * @throws \Exception
     */

    public function fetchAll()
    {

        return $this->fetch(true);
    }

    /**
     * Eşleşen içerik sayısını döndürür
     *
     * @return int
     */
    public function rowCount()
    {

        $query = $this->run();

        if ($query instanceof PDOStatement) {
            return $query->rowCount();
        } elseif ($query instanceof mysqli_stmt) {
            $query = $query->get_result();

            return $query->num_rows;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     * @return BuildManager
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     * @return BuildManager
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
        return $this;
    }


}
