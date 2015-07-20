<?php

    /**
     *  Anonym Framework Pagination sınıfı -> Sayfalama İşlemlerinde Kullanılır
     *
     * @package Anonym\Components\Database\Helpers
     * @copyright (c) 2015, MyfcYazilim
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @version 1.0
     */

    namespace Anonym\Components\Database\Helpers;


    /**
     * Class Pagination
     * @package Anonym\Components\Database\Helpers
     */
    class Pagination
    {


        private $options;
        private $count;

        /**
         * Sınıfı başlatır ve ayarları atar
         *
         * @param array $config
         */
        public function __construct(array $config = [])
        {
            $this->setOptions($config);
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
         * @return Pagination
         */
        public function setOptions($options)
        {
            $this->options = $options;

            return $this;
        }

        /**
         * Toplam içerik sayısının atar
         * @param $count
         * @return $this
         */
        public function setCount($count)
        {

            $this->count = $count;

            return $this;
        }

        /**
         * <a nın yapısını oluişturur
         * @param $i
         * @param $url
         * @param $search
         * @return string
         */
        private function chieldString($i, $url, $search)
        {

            $url = $this->str_replace($search, $i, $url);

            return "\n <a class='{$this->options['chieldClass']}' href='$url'>$i</a>";
        }

        /**
         * @param $url
         * @return string
         */

        private function clearLastSlash($url)
        {

            $len = strlen($url);
            if (substr($url, $len - 1, $len) == "/") {

                $url = substr($url, 0, $len - 1);
            }

            return $url;
        }

        /**
         * Sayfalama işlemini tamamlar
         * @param $action
         * @return string
         */
        public function paginate($action)
        {
            $url = $this->clearLastSlash($action['url']);

            $count = $this->count;

            $any = preg_match("/:(\w+)/", $url, $finded);
            if (!$any) {

                $url .= "/:page";
                $search = ":page";
            } else {

                $search = $finded[0];
            }
            if (isset($action['now'])) {
                $now = $action['now'];
            } else {
                $now = 1;
            }

            $s = "<div class='{$this->options['parentClass']}'>";

            if ($count < $this->options['limit']) {
                $limit = 1;
            } else {

                $limit = ceil($count / $this->options['limit']);
            }
            for ($i = $now; $i <= $limit; $i++) {

                $s .= $this->chieldString($i, $url, $search);
            }

            $s .= "\n</div>";

            return $s;
        }
    }
