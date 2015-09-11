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
     * the limit of pages
     *
     * @var int
     */
    protected $limit;

    /**
     * the expression of url
     *
     * @var string
     */
    protected $expression;

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

    /**
     * pagination datas
     *
     * @var mixed
     */
    protected $items;

    /**
     * @var array
     */
    protected $appends;

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return PaginationFactory
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int|null $currentPage
     * @return PaginationFactory
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return PaginationFactory
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     * @return PaginationFactory
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return PaginationFactory
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * register maximum limit
     *
     * @param int $limit
     * @return PaginationFactory
     */
    public function limit($limit = 1)
    {
        return $this->setLimit($limit);
    }

    /**
     * @return string
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     * @return PaginationFactory
     */
    public function setExpression($expression)
    {
        $this->expression = $expression;
        return $this;
    }

    /**
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }

    /**
     * @param array $appends
     * @return PaginationFactory
     */
    public function setAppends($appends)
    {
        $this->appends = $appends;
        return $this;
    }



}

