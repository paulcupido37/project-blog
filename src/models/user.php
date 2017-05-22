<?php

    /**
     * Class to represent and store user data
     *
     * @package src\models
     * @author Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class UserModel
    {

        private $db = null;

        public function __construct()
        {
            // need to create a new user and password for the database to use
            $this->db = new mysqli("localhost", "root", "", "wordwarehouse");
            if ($this->db->connect_errno) {
                echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
            }
        }

        public function __destruct()
        {
            $this->db->close();
        }


        /**
         * The purpose of this function is to create a new user entry in the database 
         * 
         * @access public
         * @param  string $userName     New user's username
         * @param  string $userPassword New user's password
         * @param  string $userEmail    New user's email address
         * @return array
         */
        public function createNewUser($userName, $userPassword, $userEmail)
        {

            $response = array();

            //Return early if the input is in the incorrect form
            if (empty($userName) || empty($userPassword) || empty($userEmail)) {
                $response['errors'] = 'User input is contains an empty value';
                $response['success'] = false;

                return $response;
            }

            if (!is_string($userName) || !is_string($userPassword) || !is_string($userEmail)) {
                $response['errors'] = 'User input is in an incorrect form';
                $response['success'] = false;

                return $response;
            }

            // check whether the username exists already
            $userNameData = $this->getUserData(null, $userName);

            if (!empty($userNameData)) {
                $response['errors'] = 'This username already exists. Please input a different username.';
                $response['success'] = false;

                return $response;
            }

            // insert a new entry into the user's table
            $sql   = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
            $query = $this->db->prepare($sql);

            $params = array($userName, hash("sha256", $userPassword), $userEmail);

            if (!$query) {
                $response['errors']['heading'] = "Query preparation failed";
                $response['errors']['message'] = "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
                $response['success']           = false;

                return $response;
            }

            if (!$query->bind_param('sss', $params[0], $params[1], $params[2])) {
                $response['errors']['heading'] = "Parameter binding failure";
                $response['errors']['message'] = "Binding parameters failed: (" . $query->errno . ") " . $query->error;
                $response['success']           = false;

                return $response;
            }

            if (!$query->execute()) {
                $response['errors']['heading'] = "Insertion failure";
                $response['errors']['message'] = "Execute failed: (" . $query->errno . ") " . $query->error;
                $response['success']           = false;

                return $response;
            }

            $result              = $query->get_result();
            $response['data']    = $this->getUserData(null, $userName);
            $response['success'] = true;

            return $response;

        }

        /**
         * The purpose of this function is to load the data for a particular user.
         *
         * @todo   Create a base model and abstract the mysqli code in there so that all I have to do is craete the query and set the variables. I will bind the params in there and just pass them as arguments
         * @access public
         * @param  integer $userId Identifier for the data about to be loaded
         * @return array
         */
        public function getUserData($userId = null, $username = null)
        {
            if ((is_numeric($userId) && $userId > 0) || (is_string($username) && !empty($username))) {

                $searchColumn = (isset($userId)) ? "user_id" : "username";
                $searchParam  = (isset($userId)) ? $userId : $username;
                $searchType   = (isset($userId)) ? "i" : "s";

                $sql   = "SELECT * FROM users WHERE " . $searchColumn . " = (?)";
                $query = $this->db->prepare($sql);

                if (!$query) {

                   echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
                   return false;

                }

                if (!$query->bind_param($searchType, $searchParam)) {

                    echo "Binding parameters failed: (" . $query->errno . ") " . $query->error;
                    return false;

                }

                if (!$query->execute()) {

                    echo "Execute failed: (" . $query->errno . ") " . $query->error;
                    return false;

                }

                $query->execute();
                $result = $query->get_result();
                $return = null;

                for ($row_no = ($result->num_rows - 1); $row_no >= 0; $row_no--) {
                    $result->data_seek($row_no);
                    $return = $result->fetch_assoc();
                }

                $query->close();

                return $return;

            }

            return false;

        }

    }

?>
