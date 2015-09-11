<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.09.2015
 * Time: 12:41
 */

namespace Anonym\Components\Database\Pagination;


class PaginationFactory
{

    /**
     * @var int
     */
    protected $perPage;

    /**
     * the required parameter
     *
     * @var int|null
     */
    protected $currentPage;

    /**
     * the optional configs
     *
     * @var array
     */
    protected $options;

}