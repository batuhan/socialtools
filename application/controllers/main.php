<?php

	class Main extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			
			
			$this->tweet->enable_debug(TRUE);

			
			if ( !$this->tweet->logged_in() )
			{
				redirect('/auth');
			}else{
				$tokens = $this->tweet->get_tokens();
				$this->tweet->set_tokens($tokens);
			}

		}
		
		function index()
		{
			echo 'hi there';
		}
		
		function resetfollows()
		{
			
			$follows = $this->tweet->call('get', 'friends/ids');
			if($follows === FALSE){ echo 'opps! something is wrong. can you please try again later?'; }
			else{
				foreach($follows as $follow){
					$person_to_unfollow = array(
						'user_id' => $follow
					);
					
					$unfollow = $this->tweet->call('post', 'friendships/destroy', $person_to_unfollow);
				}
				echo 'Your follow list is now clean!';
			}
		
		}
	}