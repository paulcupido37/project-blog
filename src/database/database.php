<?php

    class DatabaseAccess
    {

        private $db    = null;
        private $table = null;

        /**
         * The purpose of this function is to create a database object
         *
         * @access public
         * @param  string $table    Table to connect to
         * @param  string $database Database to connect to
         * @return void
         */
        public function __construct($table = 'users', $database = "wordwarehouse")
        {

            if (is_string($table) && !empty($table)) {
                $this->table = $table;
            }

            if (is_string($database) && !empty($database)) {

                $this->db = new mysqli("localhost", "root", "", $database);

                if ($this->db->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
                }

            }
        }

        /**
         * The purpose of this function is return all data from a particular table
         *
         * @access public
         * @return array $response A response array
         */
        public function retrieveAll()
        {

            $response         = null;
            $parameters       = "";

            $sql   = "SELECT * FROM " . $table;
            $query = $this->db->prepare($sql);

            if (!$query) {
               $response['message'] = "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
               $response['success'] = false;

               return $response;
            }

            if (!$query->execute()) {
                $response['message'] = "Execution failed: (" . $query->errno . ") " . $query->error;
                $response['success'] = false;

                return $response;
            }

            $query->execute();
            $result = $query->get_result();
            $return = array();

            for ($row_no = ($result->num_rows - 1); $row_no >= 0; $row_no--) {
                $result->data_seek($row_no);
                array_unshift($return, $result->fetch_assoc());
            }

            $query->close();

            $response['message'] = 'Post retrieval success';
            $response['success'] = true;
            $response['data']    = $return;

            return $response;

        }

        /**
         * The purpose of this function is to retrieve specific fields from a particular table
         *
         * @access public
         * @todo   Implement the function
         * @param  array $fields An array of field names
         * @param  array $values An array of values
         * @return array $response A response array
         */
        public function retrieveFields($fields = array(), $values = array())
        {

            $response     = null;
            $parameters   = "";
            $searchFields = (is_array($fields) && count($fields) > 0) ? implode(",", $fields) : "*";

            $sql   = "SELECT " . $searchFields . " FROM " . $table . $searchExpression;
            $query = $this->db->prepare($sql);

            if (!$query) {
               $response['message'] = "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
               $response['success'] = false;

               return $response;
            }

            if (!$query->execute()) {
                $response['message'] = "Execution failed: (" . $query->errno . ") " . $query->error;
                $response['success'] = false;

                return $response;
            }

            $query->execute();
            $result = $query->get_result();
            $return = array();

            for ($row_no = ($result->num_rows - 1); $row_no >= 0; $row_no--) {
                $result->data_seek($row_no);
                array_unshift($return, $result->fetch_assoc());
            }

            $query->close();

            $response['message'] = 'Post retrieval success';
            $response['success'] = true;
            $response['data']    = $return;

            return $response;

        }

        public function retrieveFieldsBy($fields = null, $values = null)
        {

            if (is_array($fields) && count($fields) > 0) {
                $searchExpression  = " WHERE " . implode(" = (?) AND ", $fields);
                $searchExpression .= " = (?)";
            }

            // need to deal with the multiple parameters here
        }

        /**
         * The purpose of this function is to insert data into a particular table
         *
         * @access public
         * @todo   Implement the function
         * @param  array $fields An array of fields
         * @param  array $values An array of values
         * @return array $response A response array
         */
        public function insert($fields = array(), $values = array())
        {

            $response['success'] = false;

            $searchExpression = " ( ";

            foreach ($i = 0; $i < count($fields); $i++) {
                $searchExpression .= $fields[$i] . (($i + 1) == count($fields)) ? "" : ",";
            }

            $searchExpression = " ) ";

            return $response;

        }

        public function update($fields = array(), $values = array())
        {

        }

    }


?>