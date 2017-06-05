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

        /**
         * The purpose of this function is to display the user's dashbaord
         *
         * @access public
         * @return void
         */
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

        /**
         * The purpose of this function is to create a new blog post
         *
         * @access public
         * @return void
         */
        public function createNewBlogPost()
        {

            $data['title']   = filter_input(INPUT_POST, 'blog_title');
            $data['series']  = filter_input(INPUT_POST, 'blog_series');
            $data['content'] = filter_input(INPUT_POST, 'blog_content');

            // need to run my own validation check on each of the parameters here

            if (!empty($data['title']) && !empty($data['series']) && !empty($data['content'])) {

                $params   = array('title', 'series', 'content');
                $response = $this->model->createNewBlogPost($params, $data);

            } else {

                $response['success'] = false;
                $response['message'] = 'Error with content';

            }

            echo json_encode($response);

        }

        /**
         * The purpose of this function is to update an exiting blog post
         *
         * @access public
         * @return void
         */
        public function updateBlogPost()
        {

            // grab the user id from the session
            $data['title']   = filter_input(INPUT_POST, 'blog_title');
            $data['series']  = filter_input(INPUT_POST, 'blog_series');
            $data['content'] = filter_input(INPUT_POST, 'blog_content');

            // need to run my own validation check on each of the parameters here

            if (!empty($data['title']) && !empty($data['series']) && !empty($data['content'])) {

                $params   = array('title', 'series', 'content');
                $response = $this->model->updateExistingBlogPost($params, $data);

            } else {

                $response['success'] = false;
                $response['message'] = 'Error with content';

            }

            echo json_encode($response);

        }


        public function about()
        {
              $this->display('src/views/home/about.html');
        }

    }

?>
