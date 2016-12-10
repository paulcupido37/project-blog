<?php

    include_once('src/controllers/index.php');
    include_once('src/controllers/home.php');
    include_once('src/controllers/signin.php');
    include_once('src/controllers/post.php');

    $action = isset($_GET['a']) ? filter_input(INPUT_GET, 'a'): 'index';
    $module = isset($_GET['m']) ? filter_input(INPUT_GET, 'm'): 'index';

    switch($module) {
        case('greeting'):
            $controller = new IndexController();
        break;

        case('home'):
            $controller = new IndexController();
        break;

        case('signin'):
            $controller = new SignInController();
        break;

        case('post'):
            $id = isset($module) ? filter_input(INPUT_GET, 'id'): null;
            $controller = new PostController($id);
        break;

        default:
            $controller = new SignInController();
        break;
    }
    
    include('src/views/layout/head.html');
    $controller->run($action);
    include('src/views/layout/foot.html');