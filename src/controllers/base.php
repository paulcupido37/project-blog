<?php

    /**
     * The purpose of this class is function to store shared functionality across all other controllers
     * 
     * @package    controllers
     * @subpackage BaseController
     * @author     Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class BaseController
    {

        /**
         * The purpose of this variable is to store a user model object
         * 
         * @access protected
         * @var    UserModel
         */
         protected $user = null;

        /**
         * The purpose of this variable is store parameters to be used on the view
         *
         * @access private
         * @var    array
         */
        private $params = array();

        public function __construct()
        {
            $this->user = new UserModel();
        }

        public function run($action = 'index', $id = 0)
        {
            if (!method_exists($this, $action) || !is_callable(array($this, $action))) {
                $action = 'index';
            }

            return $this->$action($id);
        }

        /**
         * The purpose of this function to set a view parameter
         *
         * @access public
         * @param  string $name Name of the view parameter
         * @param  mixed  $value Value of the view parameter
         * @return null
         */
        protected function setViewParam($name = '', $value = null)
        {

            if (is_string($name) && isset($value)) {
                $this->params[$name] = $value;
            }

        }

        /**
         * The purpose of this function to display a view file
         *
         * @access public
         * @param  string $fileName Name of the file to be displayed
         * @return void
         */
        protected function display($fileName = null)
        {

            if (is_string($fileName)) {

                $params = $this->params;

                include('src/views/layout/head.html');
                include($fileName);
                include('src/views/layout/foot.html');

                $this->params = array();

            }

        }

        /**
         * The purpose of this function is to redirect to a specified page
         *
         * @access public
         * @param  string $redirectLocation Location of the page
         * @return void
         */
        public function redirect($redirectLocation = '')
        {
            if (is_string($redirectLocation) && !empty($redirectLocation)) {
                header('location: '.$redirectLocation);
            }
        }

        /**
         * The purpose of this function is standardise response arrays coming from the model to the controller
         *
         * @todo Implement the function
         * @access private
         * @param  array $response An array of data
         * @return array
         */
        public function transportMessage($response)
        {
            return $response;
        }

    }

?>
