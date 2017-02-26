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

		// create a database object and load the user data upon creation
		public function __construct()
		{
			// connect to the database here
			$this->db = new mysqli("localhost", "root", "", "wordwarehouse");
			if ($this->db->connect_errno) {
    			echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
			}
		}


		/**
		 * The purpose of this function is to load the data for a particular user.
		 *
		 * @todo  Create a base model and abstract the mysqli code in there so that all I have to do is craete the query and set the variables. I will bind the params in there and just pass them as arguments
		 * @access public
		 * @author Paul Cupido <paulsimeoncupido@gmail.com>
		 * @param  integer $userId Identifier for the data about to be loaded
		 * @return array
		 */
		public function getUserData($userId = null, $username = null)
		{
			if ((is_numeric($userId) && $userId > 0) || is_string("username")) {

				// there is cleaner way to do this.
				$searchColumn = (isset($userId)) ? "user_id" : "username";
				$searchParam  = (isset($userId)) ? $userId : $username;

				$sql   = "SELECT * FROM users WHERE " . $searchColumn . " = (?)";
				$query = $this->db->prepare($sql);

				if (!$query) {
	 			   echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
	 			   return false;
				}

				if (!$query->bind_param("i", $searchParam)) {
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

		/**
		 * The purpose of this function is verify a user's login details
		 *
		 * @access public
		 * @author Paul Cupido <paulsimeoncupido@gmail.com>
		 * @param  string $username The user's login name
		 * @param  string $password The user's login password
		 * @return boolean          Whether the login credentials were correct
		 */
		public function verifyUser($username = null, $password = null) 
		{

			if (is_string($username) && is_string($password)) {

				$userData = $this->getUserData(null, $username);

				if (is_array($userData) && isset($userData["password"])) {
					if (hash("sha256", $password) == $userData["password"]) {
						return true;
					}	
				}
				
			}

			return false;
		}

	}

?>