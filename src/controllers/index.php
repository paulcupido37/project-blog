<?php

	/**
	 * Class to display the index page
	 * 
	 * @package    controllers
	 * @subpackage IndexController
	 * @author     Paul Cupido <paulsimeoncupido@gmail.com>
	 */
	class IndexController
	{

		public function index()
		{
			$array = array("Code Name: S.T.E.A.M.", 
				"Prince of Persia: The Fallen King",
				"Injustice: Gods Among Us",
				"El Shaddai: Ascension of the Metatron",
				"Transformers: Fall of Cybertron",
				"Final Fantasy X/X-2 HD",
				"Assassin's Creed III: Liberation");


            include('src/views/home/index.html');
		}

		public function run($action = 'index', $id = 0)
        {
            if (!method_exists($this, $action)) {
                $action = 'index';
            }

            return $this->$action($id);
        }
                
        public function hello()
        {
        }

        public function dashboard()
        {
        	include('src/views/home/dashboard.html');
        }

        public function about()
        {
        	include('src/views/home/about.html');
        }

		/**
		 * Function to redirect to a specified page
		 *
		 * @todo   Move to a utilities class - or someplace where this can be global
		 * @access public
		 * @author Paul Cupido <paulsimeoncupido@gmail.com>
		 * @param  string $redirectLocation Location of the page
		 * @return void
		 */
		public function redirect($redirectLocation = '')
		{
            if (is_string($redirectLocation) && !empty($redirectLocation)) {
                header('location: '.$redirectLocation);
            }
		}
	}

?>