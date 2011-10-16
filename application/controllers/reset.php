<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
			redirect('/main');
		}
		
		function follows()
		{
			
			$this->load->view('header');
			$follows = $this->tweet->call('get', 'friends/ids');
			if($follows === FALSE){ echo '<h2>opps! something is wrong. can you please try again later?</h2>'; }
			else{
				foreach($follows as $follow){
					$person_to_unfollow = array(
						'user_id' => $follow
					);
					
					$unfollow = $this->tweet->call('post', 'friendships/destroy', $person_to_unfollow);
				}
				echo '<H1>everyone unfollowed.</H1>';
			}
			$this->load->view('footer');
		
		}
	}