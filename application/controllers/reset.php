<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Reset extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			
			
			$this->tweet->enable_debug(TRUE);

			
			if ( !$this->tweet->logged_in() )
			{
				//redirect('/auth');
				
				$this->tweet->set_callback(site_url('/reset'));
				
				$this->tweet->login();
				
			}else{
				$tokens = $this->tweet->get_tokens();
				$this->tweet->set_tokens($tokens);
			}

		}
		
		function index()
		{
			$this->load->view('header');
			echo '<h1><a href="'.site_url('/reset/follows').'">wanna reset follows?</a><br />NOTE: If it fails, gives an error or something, just refresh the damn thing.</h1>';
			$this->load->view('footer');
		}
		
		function follows()
		{
			
			$this->load->view('header');
			$follows = $this->tweet->call('get', 'friends/ids');
			if($follows === FALSE){ echo '<h2>opps! something is wrong. can you please try again later?</h2>'; }
			else{
				$i = 0;
				foreach($follows as $follow){
					$i = $i + 1;
					if($i < 12){
						$person_to_unfollow = array(
							'user_id' => $follow
						);

						$unfollow = $this->tweet->call('post', 'friendships/destroy', $person_to_unfollow);
					}
				}
				$information = $this->tweet->call('get', 'account/verify_credentials');
				if($information->friends_count > 1){
					
					echo '<H1>'.$i.' unfollowed, '.$information->friends_count.' left. <a href="'.site_url('/reset/follows').'">wanna continue?</a></H1>'; 
				}else{
					echo 'everyone unfollowed.';
				}
			}
			
			$this->load->view('footer');
		
		}
	}