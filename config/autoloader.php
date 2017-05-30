<?php

    /**
     * The purpose of this class is to function as an autoloader for the system
     *
     * @author  Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class Autoloader
    {

        /**
         * The purpose of this function is to autoload a class
         *
         * @access public
         * @return void
         */
        public function __construct()
        {
            spl_autoload_register(array($this, 'loader'));
        }

        /**
         * The purpose of this function is to autoload a class
         *
         * @access private
         * @param  string $className Name of the class to be loaded
         * @return void
         */
        private function loader($className)
        {
            $className = strtolower($className);
            $className = str_replace("model", "", $className);

            include __DIR__ . $className . '.php';
        }

    }

?>