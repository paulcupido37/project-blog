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

        public function index()
        {

        }

        public function dashboard()
        {
              $this->display('src/views/home/dashboard.html');
        }

        public function about()
        {
              $this->display('src/views/home/about.html');
        }

    }

?>
