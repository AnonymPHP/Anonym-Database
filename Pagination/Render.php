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


class Render
{

    /**
     * the path of urls
     *
     * @var string
     */
    private $path;

    /**
     * the name of page
     *
     * @var string
     */
    private $pageName;

    /**
     * the instance of pagination class
     *
     * @var Paginator
     */
    private $paginator;

    /**
     * create a new instance
     *
     * @param array $configs
     */
    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;

        $configs = $paginator->getOptions();
        $this->path = isset($configs['path']) ? $configs['path'] : '';
        $this->pageName = isset($configs['pageName']) ? $configs['pageName'] : 'page';
    }


    /**
     * create fragment string
     *
     * @param array $fragments
     * @return string
     */
    private function createFragmentsString(array $fragments)
    {
        return rtrim(join('#', $fragments), "#");
    }

    /**
     * create append string
     *
     * @param array $appends
     * @return string
     */
    private function createAppendString(array $appends = [])
    {

        if (count($appends)) {
            return http_build_query($appends);
        } else {
            return '';
        }

    }

    /**
     *
     * rende pagination string to array
     *
     * @return array
     */
    public function standartRendeArray()
    {
        $array = [];
        $count = $this->paginator->getCount();
        $url = $this->path;
        $current = $this->paginator->getCurrentPage();

        // create appends string
        $appends = $this->createAppendString($this->paginator->getAppends());

        // create fragments string
        $fragments = $this->createFragmentsString($this->paginator->getFragments());

        if ($count < $this->paginator->getPerPage()) {
            $limit = 1;
        } else {
            $limit = ceil($count / $this->paginator->getPerPage());
        }

        if (false !== $before = $this->createBeforeButton($current, $count)) {
            $array[] = $before;
        }

        for ($i = $this->paginator->getCurrentPage(); $i <= $limit; $i++) {
            $array[] = $this->buildFullChieldStrind($this->buildChieldString($i, $url, $this->pageName), $appends, $fragments);
        }

        if (false !== $after = $this->createAfterButton($current, $count)) {
            $array[] = $after;
        }
        return $array;
    }

    private function createBeforeButton($current, $url, $class)
    {
        if ($this->isAvaibleCurrentPage($current) && $current > 1) {

            $page = $current - 1;
            return sprintf("<li></li><a href='%s' class='%s'>%s</a></li>", $url . "?page=" . $page, $class, "&laquo;");
        }
    }

    /**
     * create chield string
     *
     * @param string $page
     * @param string $url
     * @return string
     */
    private function buildChieldString($page, $url, $pageName)
    {
        settype($page, 'string');
        return sprintf("<li></li><a href='%s' class='%s'>%s</a></li>", $url . "?page=" . $page, $pageName, $page);
    }


    private function isAvaibleCurrentPage($current)
    {
        return is_integer($current) && $current > 0 ? true : false;
    }

    /**
     * create full chield string
     *
     * @param string $chield
     * @param string $appends
     * @param string $framgents
     * @return string
     */
    private function buildFullChieldStrind($chield, $appends, $framgents)
    {
        return $chield . $appends . $framgents;
    }
}