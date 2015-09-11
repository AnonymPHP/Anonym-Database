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
     * standart render
     *
     * @return string
     */
    public function standartRende(){
        return join("\n", $this->standartRendeArray());
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

        if (false !== $before = $this->createBeforeButton($current, $url, $this->pageName)) {
            $array[] = $before;
        }

        for ($i = 1; $i <= $limit; $i++) {
            $array[] = $this->buildFullChieldStrind($this->buildChieldString($i, $url, $this->pageName), $appends, $fragments);
        }

        if (false !== $after = $this->createAfterButton($current, $limit, $url, $count)) {
            $array[] = $after;
        }
        return $array;
    }

    /**
     * build before button string
     *
     * @param int $current
     * @param string $url
     * @param string $class
     * @return bool|string
     */
    private function createBeforeButton($current, $url, $class)
    {

        if ($this->isAvaibleCurrentPage($current) && $current > 1) {

            $page = $current - 1;
            return sprintf("<li><a href='%s' class='%s'>%s</a></li>", $url . "?page=" . $page, $class, "&laquo;");
        }else{
            return false;
        }
    }

    /**
     * build next button string
     *
     * @param int $current
     * @param int $limit
     * @param string $url
     * @param string $class
     * @return bool|string
     */
    private function createAfterButton($current, $limit, $url, $class)
    {
        if ($this->isAvaibleCurrentPage($current) && $current < $limit) {

            $page = $current + 1;
            return sprintf("<li><a href='%s' class='%s'>%s</a></li>", $url . "?page=" . $page, $class, "&raquo;");
        }else{
            return false;
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
        return sprintf("<li><a href='%s' class='%s'>%s</a></li>", $url . "?page=" . $page, $pageName, $page);
    }


    /**
     * check validity of current page
     *
     * @param mixed $current
     * @return bool
     */
    private function isAvaibleCurrentPage($current)
    {
        settype($current, 'integer');
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