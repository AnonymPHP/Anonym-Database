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
    private function createFragmentsString(array $fragments){
        return rtrim(join('#', $fragments),"#");
    }

    /**
     * create append string
     *
     * @param array $appends
     * @return string
     */
    private function createAppendString(array $appends = []){

        if (count($appends)) {
            return http_build_query($appends);
        }else{
            return '';
        }

    }

    public function standartRende(){
        $count = $this->paginator->getCount();
        $appends = $this->paginator->getAppends();
        $fragments = $this->createFragmentsString($this->paginator->getFragments());




    }
}