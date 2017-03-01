<?php

    /**
     * The purpose of this class is handle and display blog posts
     * 
     * @package    controllers
     * @subpackage BaseController
     * @author     Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class PostController extends BaseController
    {

        private $postModel;

        public function __construct()
        {
            $this->db->postModel = new PostModel();
        }

        /**
         * The purpose of this function is to display the post index 
         *
         * @access public
         * @return void
         */
        public function index()
        {
            $this->display('src/views/post/index.html');
        }

        /**
         * The purpose of this function is to display a blog post for the user to view
         *
         * @access public
         * @todo   Retrieve the $postId from the POST and the $userId from the session
         * @param  $userId A unique user identifier
         * @param  $postId A unique post identifier
         * @return void
         */
        public function viewBlogPost($userId = null, $postId = null)
        {

            $blogPostData = $this->db->model->retrieveBlogPost($userId, $postId);

            if (is_array($blogPostData)
                && count($blogPostData) > 0
                && isset($blogPostData['success'])
                && $blogPostData['success']
                && isset($blogPostData['message'])
                && $blogPostData['message'] === 'Post retrieval success') {

                $this->setViewParam('error', false);
                $this->setViewParam('blogPostData', $blogPostData['data']);

            } else {

                $this->setViewParam('error', true);
                $this->setViewParam('error_message', $blogPostData['message']);

            }

            $this->display('src/views/post/index.html');

        }

        /**
         * The purpose of this function is to save a new blog post
         *
         * @access public
         * @param  $userId A unique user identifier
         * @param  $postId A unique post identifier
         * @return void
         */
        public function saveBlogPost($data = null, $postId = null)
        {

            $response = $this->db->model->saveNewBlogPost($data, $postId);

            echo json_encode($response);

        }

    }
