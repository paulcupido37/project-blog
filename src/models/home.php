<?php

    class HomeModel extends BaseModel
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
         * The purpose of this function is to retrieve all blog posts
         *
         * @access public
         * @return array $response An array of response data
         */
        public function retrieveAllBlogPosts()
        {

            $response = $this->retrieveAll('posts');

            return $response;

        }

        /**
         * The purpose of this function is to retrieve a blog post by some criteria
         *
         * @todo   I need a function to create the WHERE clause based on what has been given
         * @access public
         * @return array $response An array of response data 
         */
        public function retrieveBlogPostBy($userId = null, $postId = null)
        {

            $params   = array();
            $values   = array();
            $response = array('success' => false);

            if ((!is_numeric($userId) && $userId <= 0) && (!is_numeric($postId) && $postId <= 0) {
                $response['message'] = 'Please provide values for the parameter data.';
                return $response;
            }

            if (is_numeric($userId) && $userId > 0) {
                $params[] = "user_id";
                $values[] = $userId;
            }

            if (is_numeric($postId) && $postId > 0) {
                $params[] = "id";
                $values[] = $postId;
            } 

            if (count($params) === 0 || count($values) === 0) {
                $response['message'] = 'Please provide parameter data.';
                return $response;
            }

            $response = $this->model->retrieveAllBy('posts', $params, $values);

            return $response;
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
                $searchExpression[] = "post_id = (?)";
            }

            $searchConditions = (count($searchExpression) > 0) ? "WHERE " . implode(" AND ", $searchExpression) : "";

            $sql   = "SELECT * FROM posts" . $searchConditions;
            $query = $this->db->prepare($sql);

            if (!$query) {
               $response['message'] = "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
               $response['success'] = false;

               return $response;
            }

            if (!empty($searchConditions)) {

                if (count($searchConditions) == 2
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
            $return = array();

            for ($row_no = ($result->num_rows - 1); $row_no >= 0; $row_no--) {
                $result->data_seek($row_no);
                array_unshift($return, $result->fetch_assoc());
            }

            $query->close();

            $response['message'] = 'Post retrieval success';
            $response['success'] = true;
            $response['data']    = $return;

            return $response;

        }

        /**
         * The purpose of this function is to create a new blog post
         *
         * @access public
         * @param  array $params An array of params
         * @param  array $values An array of values
         * @return array
         */
        public function createNewBlogPost($params = null, $values = null)
        {

            $response['success'] = false;
            $paramCount          = count($params);
            $valueCount          = count($values);

            if (is_array($params)
                && $valueCount > 0
                && is_array($values)
                && $valueCount > 0
                && $valueCount === $paramCount) {

                $response = $this->db->insertInto('posts', array('title', 'series', 'content'), $values);

            } else {

                $response['message'] = 'Error with parameters and values';

            }

            return $response;


        }

        /**
         * The purpose of this function is to update an existing blog post
         *
         * @access public
         * @param  array $params An array of parameters
         * @param  array $values An array of values
         * @return array
         */
        public function updateExistingBlogPost($params = null, $values = null)
        {

            $response['success'] = false;
            $paramCount          = count($params);
            $valueCount          = count($values);

            if (is_array($params)
                && $valueCount > 0
                && is_array($values)
                && $valueCount > 0
                && $valueCount === $paramCount) {

                $sql = 'UPDATE wordwarehouse.posts SET id = ?, title = ?, series = ?, content = ?';

                $response = $this->db->executeQuery($sql, array('i', 's', 's', 's'), $values);

            } else {

                $response['message'] = 'Error with parameters and values';

            }

            return $response;

        }

    }

?>