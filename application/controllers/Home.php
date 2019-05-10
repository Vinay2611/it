<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Home extends MY_Controller {

		function __construct() {
		 parent::__construct();
		 //Load models
		  $this->load->model('tickets_m');
		  $this->load->helper('function_helper');
		}
		
		public function index() {
			/*echo '<pre>';
			var_dump($_SESSION);
			die(0);*/
			$common = new comman();
           
		    if($this->session->userdata('logged_in'))  {
	        //Add session data 	   
            $session_data = $this->session->userdata('logged_in');
		    $this->data['username'] = $session_data['username'];
		    $this->data['role'] = $session_data['role'];
		    $this->data['f_name'] = $session_data['f_name'];
		    $this->data['l_name'] = $session_data['l_name'];
			$this->data['total_hold'] = $common->getStatus('On Hold');
			
			$this->data['total_open'] = $common->getStatus('Open');
			$this->data['total_pending'] = $common->getStatus('Pending');
			$this->data['total_closed'] = $common->getStatus('Closed');			
			
			//Find today's activity
			//$this->data['todays_activity'] = $common->getTodaysActivity();
			$this->middle = 'home'; // its your view name, change for as per requirement.
            $this->layout();		

				
		   } else {
			 redirect('login', 'refresh');  
		   }
        }
		
		
		public function logout()
		{
	    $this->session->unset_userdata('logged_in');
		session_destroy();
	    redirect('login', 'refresh');
 		}
		
				
		
		
		
    }
?>