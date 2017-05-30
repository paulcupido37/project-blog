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
         * The purpose of this function is to execute a query
         * 
         * @param  string $sql       SQL code to be run in the query
         * @param  array $params     Array of parameters to be saved
         * @param  array $paramTypes Array of parameter types
         * @return array|false       Array containg the data from the query
         */
        

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
