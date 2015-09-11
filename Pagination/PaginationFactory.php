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

}
