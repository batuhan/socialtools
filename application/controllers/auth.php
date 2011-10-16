<?php

	class Auth extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();

			// Enabling debug will show you any errors in the calls you're making, e.g:
			$this->tweet->enable_debug(TRUE);
			
			if ( !$this->tweet->logged_in() )
			{
				// This is where the url will go to after auth.
				// ( Callback url )
				
				$this->tweet->set_callback(site_url('auth'));
				
				$this->tweet->login();
			}
			else
			{
				redirect('/main');
			}
		}
		
		function index()
		{
			$tokens = $this->tweet->get_tokens();
			
			redirect('/main');
			
		}
	}