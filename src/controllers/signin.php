<?php

    /**
     * The purpose of this class is to display and handle the sign-in process
     * 
     * @package    controllers
     * @subpackage BaseController
     * @author     Paul Cupido <paulsimeoncupido@gmail.com>
     */

    class SignInController extends BaseController
    {

        public function __construct($action = null)
        {
            parent::__construct();
        }

        /**
         * The purpose of this function is to sign the user into the system
         *
         * @access public
         * @return void
         */
        private function processSuccessfulLogin($response = null)
        {

            if (!empty($response)
                && is_array($response)
                && count($response) > 0
                && isset($response['data'])) {

                session_start();

                if (is_array($response['data']['user_id']) && is_numeric($response['data']['user_id'])) {
                    $_SESSION['userId'] = $response['data']['user_id'];
                }

                $homeController = new HomeController();
                $homeController->dashboard();
            }
        }

        /**
         * The purpose of this function is take the user back to the signin page with an error message
         *
         * @access public
         * @return void
         */
        private function processFailedLoginAttempt()
        {
            $this->setViewParam('failedLogin', 1);
            $this->index();
        }

        /**
         * The purpose of this function is sign the user out of the system and return them to the signout page
         * 
         * @access public
         * @return void
         */
        public function logout()
        {
            $_SESSION['userId'] = null;
            session_destroy();

            $this->setViewParams('signout', 1);
            $this->redirect('src/views/signin/signin.html');
        }

        /**
         * Displays the index signin page
         *
         * @access public
         * @param  integer $failedLogin A flag to determine whether the login failed or not
         * @param  array   $viewParams  An array of parameters to be sent to the view
         * @return null
         */
        public function index()
        {
            $this->display('src/views/signin/signin.html');
        }

        /**
         * The purpose of this function is to process a user login attempt
         *
         * @access public
         * @return void
         */
        public function processLoginAttempt()
        {

            // handle user input and check whether the logic is correct
            $username = filter_input(INPUT_POST, 'identity');
            $password = filter_input(INPUT_POST, 'credentials');

            // Run the verification method on the user input
            $response = $this->verifyUser($username, $password);

            if (is_array($response)
                && count($response) > 0
                && isset($response['success'])
                && $response['success']) {

                $this->processSuccessfulLogin($response);

            } else {

                $this->processFailedLoginAttempt($response);

            }
            
        }

        /**
         * The purpose of this function is display the registration form to a new user
         *
         * @access public
         * @return void
         */
        public function register()
        {
            $this->display('src/views/signin/register.html');
        }

        /**
         * The purpose of this function is to register a new user to the system
         *
         * @access private
         * @return void
         */
        public function registerUser()
        {

            $email               = filter_input(INPUT_POST, 'email');
            $username            = filter_input(INPUT_POST, 'username');
            $password            = filter_input(INPUT_POST, 'password');
            $response['success'] = false;

            // need to strip the tags from the input here
            // need to use a validation class for the input

            $response = $this->user->createNewUser($username, $password, $email);

            if (is_array($response)
                && count($response) > 0
                && isset($response['success'])
                && $response['success']) {

                $this->setViewParam('message', 'You account has been created');
                $this->index();

            } else {

                $response['errors'] = 'An error has occured. Please try again later.';

            }

            $this->setViewParam('errors', $response['errors']);
            $this->register();

        }

        /**
         * The purpose of this function is verify a user's login details
         *
         * @access public
         * @param  string $username The user's login name
         * @param  string $password The user's login password
         * @return boolean
         */
        private function verifyUser($username = null, $password = null) 
        {

            // Need to move this UserModel into the BaseController - or at least into the sign in controller
            $user     = new UserModel();
            $response = null;

            if ($user instanceof UserModel) {

                if (is_string($username) && is_string($password)) {

                    $userData = $user->getUserData(null, $username);

                    if (is_array($userData) &&
                        isset($userData['password']) &&
                        isset($userData['username']) &&
                        isset($userData['user_id'])) {

                        if (hash("sha256", $password) == $userData["password"]) {
                            $response['data']    = $userData;
                            $response['success'] = true;
                            $response['message'] = 'User verification successful';
                        } else {
                            $response['success'] = false;
                            $response['message'] = 'Incorrect login credentials';
                        }

                    } else {
                        $response['success'] = false;
                        $response['message'] = 'Invalid Username or Password';
                    }
                }
            } else {
                $response['success'] = false;
                $response['message'] = 'Invalid User';
            }

            return $response;
        }

    }

?>
