<?php

    /**
     * The purpose of this class is display and handle the content of the home page
     * 
     * @package    controllers
     * @subpackage BaseController
     * @author     Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class HomeController extends BaseController
    {

        /**
         * The purpose of this variable is to store a PostModel object
         *
         * @access private
         * @var    HomeModel
         */
        private $model;

        public function __construct()
        {
            $this->model = new HomeModel();
        }

        public function index()
        {

        }

        public function dashboard()
        {

            $response = $this->model->retrieveAllBlogPosts();

            if (is_array($response)
                && count($response) > 0
                && isset($response['success'])
                && $response['success']
                && isset($response['data'])) {

                $this->setViewParam('blogPosts', $response['data']);

            } else {

                $this->setViewParam('errors', $response['message']);

            }
            
            $this->display('src/views/home/dashboard.html');
        
        }

        public function about()
        {
              $this->display('src/views/home/about.html');
        }

    }

?>
