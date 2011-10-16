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
			redirect('http://batuhanicoz.com/socialtools.html');
		}

	}