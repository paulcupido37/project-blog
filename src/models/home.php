<?php

	class HomeModel extends Model
	{

		public function __construct()
        {
            parent::__construct('posts');
        }

        public function __destruct()
        {
            parent::__destruct();
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
	}

?>