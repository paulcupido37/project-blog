<?php

    /**
     * Base model class 
     *
     * @package src/models
     * @author  Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class BaseModel
    {

        /**
         * The purpose of this variable is A database connection
         * 
         * @access protected
         * @var    db
         */
        protected $db = null;

        public function __construct($database = null)
        {
            if (!is_string($database) || empty($database)) {
                $database = 'wordwarehouse';
            }

            $db = new DataAccess($database);

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
         * The purpose of this function is to retrieve data from a particular table
         *
         * @access public
         * @param  string $table Table name 
         * @return array  An array of response data
         *
         */
        public function retrieveAll($table = null)
        {
            $response['success'] = false;

            if (!is_string($table) || empty($table)) {
                
                $response['message'] = "Incorrect parameter data passed to query";
                return $response;

            }

            return $this->db->executeQuery("SELECT * FROM {$database}.{$table}");

        }

        /**
         * The purpose of this function is to retrieve data from a particular table based on certain parameter values
         *
         * @access public
         * @param  string $table Table name
         * @param  array  $params An array of parameter names
         * @param  array  $values An array of parameter values
         * @return array  An array of response data
         */
        public function retrieveAllBy($table = null, $params = null, $values = null)
        {

            if (!is_string($table) || empty($table)) {
                $response['message'] = "Incorrect parameter data passed to query";
                return $response;
            }

            if (!is_array($params) || count($params) <= 0) {
                $response['message'] = "Please provide search parameters";
                return $response;
            }

            if (!is_array($values) || count($values) <= 0) {
                $response['message'] = "Please provide search values";
                return $response;
            }

            $expression  = implode($params, ',');
            $conditions  = implode($values, " = ? AND ");
            $conditions .= " = ?";

            $sql   = "SELECT {$expression} FROM {$database}.{$table} WHERE {$conditions}";
            $types = $this->getArrayElementTypes($values);

            return $this->db->executeQuery($sql, $types, $values);

        }

        /**
         * The purpose of this function is to insert data into a particular table
         *
         * @access public
         * @param  string $table  Table name
         * @param  array  $params An array of parameter names
         * @param  array  $values An array of parameter values
         * @return array
         */
        public function insertInto($table = null, $params, $values = null)
        {

            if (!is_string($table) || empty($table)) {
                $response['message'] = "Incorrect parameter data passed to query";
                return $response;
            }

            if (!is_array($params) || count($params) <= 0) {
                $response['message'] = "Please provide parameters";
                return $response;
            }

            if (!is_array($values) || count($values) <= 0) {
                $response['message'] = "Please provide values";
                return $response;
            }

            $expression = implode($params, ",");
            $variables  = implode(array_fill(0, count($values), "?"), ",");

            $sql        = "INSERT INTO {$database}.{$table} ({$expression}) VALUES ({variables})";
            $types      = $this->getArrayElementTypes($values);

            return $this->db->executeQuery($sql, $types, $values);

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
