<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
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
    public function __construct($items, $perPage, $currentPage = null, array $options = [])
    {
            $this->setCurrentPage($currentPage)
            ->setPerPage($perPage)
            ->setOptions($options);
    }


    /**
     * register the url pattern
     *
     * @param string $expression
     * @return $this
     */
    public function customUrl($expression  = '')
    {
        $this->setExpression($expression);
        return $this;
    }

    /**
     * get all appends
     *
     * @param array $appends
     * @return $this
     */
    public function appends(array $appends = []){
        $this->appends = array_merge($this->appends, $appends);
        return $this;
    }


    /**
     * add a new fragment to url
     *
     * @param string $name
     * @return $this
     */
    public function fragment($name = '')
    {
        $this->fragments[] = $name;
        return $this;
    }

    /**
     * get next page
     *
     * if current page is null, current page accept 0
     *
     * @return int
     */
    public function nextPage(){
        $current = $this->getCurrentPage();

        if (!is_int($current)) {
            $current = 0;
        }

        return $current + 1;
    }

    /**
     * return per page
     *
     * @return int
     */
    public function perPage(){
        return $this->getPerPage();
    }

    /**
     * return current page
     *
     * @return int|null
     */
    public function currentPage(){
        return $this->getCurrentPage();
    }

    public function render(){

    }

}
