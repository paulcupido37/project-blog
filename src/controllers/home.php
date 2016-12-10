<?php

	class HomeController extends IndexController
	{

		public function index()
		{
			
		}

		public function hello($id)
		{
            $array = array(
            	array(
            		"name" => "Rise of the Tomb Raider", 
            		"platform" => "Xbox One, Xbox 360, PC", 
            		"description" => ""
            	), 
            	array(
            		"name" => "Mirror's Edge: Catalyst", 
            		"platform" => "", 
            		"description" => ""
            	), 
            	array(
            		"name" => "Final Fantast XV",
            		"platform" => "PS4, Xbox One",
            		"description" => ""
            	), 
            	array(
            		"name" => "Uncharted 4: A Thief's End",
            		"platform" => "PS4",
            		"description" => ""
            	)
            );
            
            print (json_encode($array[$id]));
		}
 
	}

?>
