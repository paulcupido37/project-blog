<?php

    /**
     * Base model class 
     *
     * @package src/models
     * @author  Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class BaseModel extends DatabaseAccess
    {

        public function __construct($database = null)
        {
            if (!is_string($database) || empty($database)) {
                $database = 'wordwarehouse';
            }

            parent::__construct($database);
        }

        /**
         * The purpose of this function is to release declared resources
         *
         * @access protected
         * @return void
         *
         */
        public function __destruct()
        {
            $this->db->close();
        }

        /**
         * The purpose of this function is return the types of all elements in an array as a string
         *
         * @access public
         * @param  array  $array An array with data
         * @return string $str   A string containing the types of all array elements
         */
        public function getArrayElementTypes($array)
        {

            $str = "";

            if (is_array($array) && count($array) > 0) {

                foreach ($array as $element) {
                   $str .= substr(gettype($element) , 0, 1);
                }

            }

            return $str;
        }

        public function get_func_arg_names($funcName)
        {
            $function = new ReflectionFunction($funcName);
            $result   = array();

            foreach ($function->getParameters() as $param) {
                $result[] = $param->name;
            }

            return $result;
        }

    }

?>
