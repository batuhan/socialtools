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

		}
		
		function index()
		{
			echo 'hi there';
		}
		
		function resetfollows()
		{
			$tokens = $this->tweet->get_tokens();
			$this->tweet->set_tokens($tokens);
			
			
			$follows = $this->tweet->call('get', 'friends/ids');
			if($follows === FALSE){ echo 'opps! something is wrong. can you please try again later?'; }
			else{
				var_dump($follows);
			}
			
			
			/*
			foreach($follows as $follow){
				
			}*/
		}
	}