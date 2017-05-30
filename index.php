<?php

// move these inside of an application module - rename 'src' to 'application'
// I may want to think about the structure of my routes: [controller]/[action]/[variable1]/[variable2]
// I will need to do session timeouts and general checks to see whether the user is still signed in

    include_once('application/config.php');
    include_once('src/controllers/base.php');
    include_once('src/controllers/home.php');
    include_once('src/controllers/signin.php');
    include_once('src/controllers/post.php');
    include_once('src/database/database.php');
    include_once('src/models/model.php');
    include_once('src/models/user.php');
    include_once('src/models/post.php');
    include_once('src/models/home.php');

    //include('config/autoloader.php');

    $action     = isset($_GET['a']) ? filter_input(INPUT_GET, 'a'): 'index';
    $module     = isset($_GET['m']) ? filter_input(INPUT_GET, 'm'): 'index';
    //$autoloader = new Autoloader();

// I may want to url_encode the module and actions so that the user never understands them in the url

// move into a routing file
    switch($module) {
        case('greeting'):
            $controller = new HomeController();
        break;

        case('home'):
            $controller = new HomeController();
        break;

        case('signin'):
            $controller = new SignInController();
        break;

        case('post'):
            $controller = new PostController();
        break;

        default:
            $controller = new SignInController();
        break;
    }

    $controller->run($action);
