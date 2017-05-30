<?php

    /**
     * Class to represent and load user data
     * 
     * @package src/models
     * @author  Paul Cupido <paulsimeoncupido@gmail.com>
     */
    class PostModel extends BaseModel
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function __destruct()
        {
            parent::__destruct();
        }
    
        /**
         * The purpose of this function is to load post data
         *
         * @access public
         * @todo   Write the INSERT statement out
         * @todo   Create some generic error messages and store them in a constants folder somewhere
         * @param  integer $userId Id of the user whose post data will be loaded
         * @return array|false;
         */
        public function saveNewBlogPost($userId = null, $data = null)
        {
            if (!is_numeric($userId) || $userId <= 0) {
                $response['success'] = false;
                $response['message'] = 'A credentials error occurred when trying to save your blog post. Please try again later.';

                return $response;
            }

            if (empty($data)
                || !is_array($data)
                || count($data) <= 0
                || !isset($data['title'])
                || !isset($data['description'])
                || !isset($data['data'])) {

                $response['success'] = false;
                $response['message'] = 'A data error occurred when trying to save your blog post. Please try again later.';

                return $response;
            }

            $sql   = "INSERT INTO posts (post_id, user_id, title, description, data) VALUES (?, ?, ?, ?, ?)";
            $query = $this->db->prepare($sql);

             if (!$query) {
               $response['message'] = "An error occurred: (" . $this->db->errno . ") " . $this->db->error;
               $response['success'] = false;

               return $response;
            }

            // This will change depending on the INSERT statement
            if (!$query->bind_param(array("i", "i", "s", "s", "s"), array($postId, $userId, ))) {
                $response['message'] = "Binding parameters failed: (" . $query->errno . ") " . $query->error;
                $response['success'] = false;

                return $response;
            }

            if (!$query->execute()) {
                $response['message'] = "Execute failed: (" . $query->errno . ") " . $query->error;
                $response['success'] = false;

                return $response;
            }

        }

        /**
         * The purpose of this function is retrieve one, or many, blog post
         *
         * @access public
         * @todo   Move the DB interaction into a dedicated class under a database folder
         * @todo   Make this function work with a postId to retrieve the data of a specific post
         * @param  integer $userId A unique user identifier
         * @param  integer $postId A unique blog post identifier
         * @return array|false;
         */
        public function retrieveBlogPosts($userId = null, $postId = null)
        {

            $response         = null;
            $parameters       = "";
            $searchValues     = array();
            $searchExpression = array();

            if ((is_numeric($userId) && $userId > 0)) {
                $parameters        .= "i";
                $searchValues[]     = $userId;
                $searchExpression[] = "user_id = (?)";
            }

            if ((is_numeric($postId) && $postId > 0)) {
                $parameters        .= "i";
                $searchValues[]     = $postId;
                $searchExpression[] = "id = (?)";
            }

            $searchConditions = (count($searchExpression) > 0) ? " WHERE " . implode(" AND ", $searchExpression) : "";

            $sql   = "SELECT * FROM posts" . $searchConditions;
            $query = $this->db->prepare($sql);

            if (!$query) {
               $response['message'] = "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
               $response['success'] = false;

               return $response;
            }

            if (!empty($searchConditions)) {

                if (count($searchConditions) > 1
                    && !$query->bind_param($parameters, $searchValues[0], $searchValues[1])) {

                    $response['message'] = "Binding parameters failed: (" . $query->errno . ") " . $query->error;
                    $response['success'] = false;

                    return $response;

                } else if (!$query->bind_param($parameters, $searchValues)) {

                    $response['message'] = "Binding parameters failed: (" . $query->errno . ") " . $query->error;
                    $response['success'] = false;
                    
                    return $response;
                }
            }

            if (!$query->execute()) {
                $response['message'] = "Execution failed: (" . $query->errno . ") " . $query->error;
                $response['success'] = false;

                return $response;
            }

            $query->execute();
            $result = $query->get_result();
            $return = null;

            for ($row_no = ($result->num_rows - 1); $row_no >= 0; $row_no--) {
                $result->data_seek($row_no);
                $return = $result->fetch_assoc();
            }

            $query->close();

            $response['message'] = 'Post retrieval success';
            $response['success'] = true;
            $response['data']    = $return;

            return $response;

        }

        /**
         *  Loads all the comments related to a particular post
         *
         * @access public
         * @todo   Move this method to a database\PostTB class
         * @param  integer $postId
         * @return void
         */
        public function getPostComments($postId = null)
        {

            if (!is_numeric($postId) || $postId <= 0) {
                $response['message'] = 'Post information is incorrect';
                $response['success'] = false;

                return $response;
            }

            $sql   = "SELECT * FROM comments WHERE post_id = (?)";
            $query = $this->db->prepare($sql);

            if (!$query) {
               $response['message'] = "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
               $response['success'] = false;

               return $response;
            }

            if (!$query->bind_param("i", $postId)) {
                $response['message'] = "Binding parameters failed: (" . $query->errno . ") " . $query->error;
                $response['success'] = false;

                return $response;
            }

            if (!$query->execute()) {
                $response['message'] = "Execute failed: (" . $query->errno . ") " . $query->error;
                $response['success'] = false;

                return $response;
            }

            $query->execute();
            $result = $query->get_result();
            $return = null;

            for ($row_no = ($result->num_rows - 1); $row_no >= 0; $row_no--) {
                $result->data_seek($row_no);
                $return = $result->fetch_assoc();
            }

            $query->close();

            $response['message'] = 'Comment retrieval success';
            $response['success'] = true;
            $response['data']    = $return;

            return $response;
        }

    }

?>