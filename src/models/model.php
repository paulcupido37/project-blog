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

		function __construct()
		{
			if (is_string($database)) {
				$this->db = new mysqli("localhost", "root", "", "wordwarehouse");
				if ($this->db->connect_errno) {
    				echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
				}
			}
		}

		/**
		 * Custom function to run a query
		 * 
		 * @param  string $sql       SQL code to be run in the query
		 * @param  array $params     [description]
		 * @param  array $paramTypes [description]
		 * @return array|false       Array containg the data from the query
		 */
		protected function executeQuery($sql, $params = null, $paramTypes = null)
		{
			// want to return either false or the data returned from the query as an array
		}

	}

?>