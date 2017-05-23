<?php

    /**
     * Base model class 
     *
     * @package src/models
     * @author  Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class Model
    {

        protected $db = null;

        protected function __construct($database)
        {
            if (is_string($database)) {
                $this->db = new mysqli("localhost", "root", "", "wordwarehouse");
                if ($this->db->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
                }
            }
        }

        /**
         * The purpose of this function is to release declared resources
         *
         * @access protected
         * @return void
         *
         */
        protected function __destruct()
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
        protected function executeQuery($sql, $params = null, $paramTypes = null)
        {
            // want to return either false or the data returned from the query as an array
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
