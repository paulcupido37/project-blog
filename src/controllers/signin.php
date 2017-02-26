<?php

/**
 * Class to facilitate the sign-in process
 * 
 * @package    controllers
 * @subpackage IndexController
 * @author     Paul Cupido <paulsimeoncupido@gmail.com>
 */

	class SignInController extends IndexController
	{
			
		/**
		 * Displays the index signin page
		 *
		 * @access public
		 * @author Paul Cupido <paulsimaoncupido@gmail.com>
		 * @return null
		 */
		public function index()
		{
			include('src/views/signin/signin.html');
		}

		public function failedIndex()
		{
			// Ineed to find a way to tell the user that they have failed without duplicating this file.
			// javascript, maybe?
			include('src/views/signin/signin.html');
		}

		/**
		 * Checks whether a user has signed in correctly
		 *
		 * @access public
		 * @author Paul Cupido <paulsimeoncupido@gmail.com>
		 * @return null
		 */
		public function checkLogin()
		{
			// I may need to turn this inot an ajax response function
			// I should return whether the validation was successful or not and let the ajax reroute the user
			// That way I can force the index.php to be run again
			// I'll still start the session here 

			// handle user input and check whether the logic is correct
		
			// need to clean thsi up - I really shouldn't be accessing the superglobals directly
			$username = $_POST['identity'];
			$password = $_POST['credentials'];

			$user     = new UserModel();

			if ($user->verifyUser($username, $password)) {

				session_start();

				// Save the userId instead of the name. It will be easier to use
				$_SESSION['username'] = $username;
				$index = new IndexController();
				// have to modify the head.html's navbar in javascript as the head is not being reset after rerouting through the controller.
				// either that or I need to route directly to that URL.
				$index->run('dashboard');

			} else {
				// may want to go back to javascript here
				$this->index();
			}
			
		}

	}

?>