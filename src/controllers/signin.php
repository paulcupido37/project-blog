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
			
		public function index()
		{
			include('src/views/signin/signin.html');
		}

		public function checkLogin()
		{
			// need to wrap this in an if-statment that checks whether the user is logged in
			// may want to use a session variable which is craeted upon login
	
			// handle user input and check whether the logic is correct

			// include('src/views/signin/signin.html');
			//$this->redirect('controllers/home.php?');
			$index = new IndexController();
			$index->run('dashboard');
		}

	}

?>