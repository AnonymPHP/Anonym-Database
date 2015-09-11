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
     * create a new instance
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $this->path = isset($configs['path']) ? $configs['path'];
        $this->pageName = isset($configs['pageName']) ? $configs['pageName'] : 'page';
    }

}