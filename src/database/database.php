<?php

    class DatabaseAccess
    {

        protected $db  = null;
        private $table = null;

        /**
         * The purpose of this function is to create a database object
         *
         * @access public
         * @param  string $database Database to connect to
         * @return void
         */
        public function __construct($database = "wordwarehouse")
        {

            if (is_string($database) && !empty($database)) {

                $this->db = new mysqli("localhost", "root", "", $database);

                if ($this->db->connect_errno) {
                    echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
                }

            }
        }

        /**
         * The purpose of this function is to execute a query
         * 
         * @param  string $sql   SQL code to be run in the query
         * @param  array $params An array of parameters to be saved
         * @return array         An array of response data
         */
        public function executeQuery($sql = '', $params = array())
        {

            $response['success'] = false; 

            if (!is_string($sql) || empty($sql)) {
                $response['message'] = 'SQL variable incorrect';
                return $response;
            }

            $query = $this->db->prepare($sql);

            if (!$query) {
               $response['message'] = "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
               return $response;
            }

            // need to bind the parameters here

            if (!$query->execute()) {
                $response['message'] = "Execution failed: (" . $query->errno . ") " . $query->error;
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

    }

?>
