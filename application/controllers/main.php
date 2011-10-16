<?php

	class Main extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			
			
			$this->tweet->enable_debug(TRUE);

			
			if ( !$this->tweet->logged_in() )
			{
				redirect('/auth');
			}
			else
			{
				$tokens = $this->tweet->get_tokens();
			}
		}
		
		function index()
		{
			echo 'hi there';
		}
		
		function resetfollows()
		{
			$follows = $this->tweet->call('get', 'friends/ids');
			
			print_r($follows);
			
			/*
			foreach($follows as $follow){
				
			}*/
		}
	}