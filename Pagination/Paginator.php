<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.09.2015
 * Time: 12:37
 */

namespace Anonym\Components\Database\Pagination;

/**
 * Class Paginator
 * @package Anonym\Components\Database\Pagination
 */
class Paginator extends PaginationFactory
{



    /**
     * determine if there are more page in datas
     *
     * @var int
     */
    protected $hasMore;

    /**
     * create a new instance and register options and more variables
     *
     * @param mixed $items
     * @param int $perPage
     * @param null $currentPage
     * @param array $options
     */
    public function __construct($items, $perPage, $currentPage = null, array $options = []){

    }

}
