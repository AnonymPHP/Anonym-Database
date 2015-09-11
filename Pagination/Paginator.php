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
     * the instance of pagination render
     *
     * @var Render
     */
    protected $render;

    /**
     * create a new instance and register options and more variables
     *
     * @param mixed $items
     * @param int $perPage
     * @param null $currentPage
     * @param array $options
     */
    public function __construct($perPage, $currentPage = null, array $options = [])
    {
        $this->setCurrentPage($currentPage)
            ->setPerPage($perPage)
            ->setOptions($options);

        $this->setRender(new Render());
    }

    /**
     * return registered render instance
     *
     * @return Render
     */
    public function getRender()
    {
        return $this->render;
    }

    /**
     * register the pagination render
     *
     * @param Render $render
     * @return Paginator
     */
    public function setRender(Render $render)
    {
        $this->render = $render;
        return $this;
    }



    /**
     * register the url pattern
     *
     * @param string $expression
     * @return $this
     */
    public function customUrl($expression = '')
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
    public function appends(array $appends = [])
    {
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
    public function nextPage()
    {
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
    public function perPage()
    {
        return $this->getPerPage();
    }

    /**
     * return current page
     *
     * @return int|null
     */
    public function currentPage()
    {
        return $this->getCurrentPage();
    }

    /**
     * rende the pagination to string
     *
     * @return string
     */
    public function render()
    {
        return $this->getRender()->setPaginator($this)->standartRende();
    }

    /**
     * rende the pagination to an array
     *
     * @return array
     */
    public function rendeToArray(){
        $render = $this->getRender()->setPaginator($this);

        return $render->standartRendeArray();
    }


    /**
     * rende the pagination to string
     *
     * @return string
     */
    public function simpleRender()
    {
        return $this->getRender()->setPaginator($this)->simpleRende();
    }

    /**
     * rende the pagination to an array
     *
     * @return array
     */
    public function simpleRendeToArray(){
        $render = $this->getRender()->setPaginator($this);

        return $render->simpleRendeArray();
    }

}
