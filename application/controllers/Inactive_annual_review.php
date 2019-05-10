<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inactive_annual_review extends MY_controller {
	
	function __construct() {
    parent::__construct();
	  $this->load->model('mtr_m');
      $this->load->model('inactive_annual_m');
	  $this->load->model('user_m');
	}
		
	 public function index()
	  {
		
	  if($this->session->userdata('logged_in'))
      {
	   //Add session data 	   
       $session_data = $this->session->userdata('logged_in');
       $this->data['username'] = $session_data['username'];
	
	   $this->load->model('kra_m');
	   $inactive_annual_list = $this->inactive_annual_m->getInactiveUsersAnnualReview();
	   $this->data["inactive_annual_list"] = $inactive_annual_list;
       $this->middle = 'inactive_annual_review_v'; 
       $this->layout();	  
	  }  else   {
      //If no session, redirect to login page
      redirect('login', 'refresh');
   	  }
	}
	
	
	//Edit kra
	public function view()
	{
	   //KRA 
	   $this->data['kra_id'] = $this->uri->segment(3);
	  
	  //Get Kra data
	  $mtr_data = $this->mtr_m->getEmployee_Mtr($this->data['kra_id']);
	  $this->data['mtr_data'] = $mtr_data;
	  $annual_review_details = $this->inactive_annual_m->getAnnualDetails($this->data['kra_id']);
	  $this->data['annual_review_details'] = $annual_review_details;
	  $session_data = $this->session->userdata('logged_in');
	  $this->data['username'] = $session_data['username'];   	  
	  $user_details = $this->user_m->getEmployee_data($this->data['annual_review_details'][0]->users_id);	  
	  $this->data['user_details'] = $user_details;
	  $this->middle = 'inactive_annual_review_display_v'; 
      $this->layout();		
	}
	
	
	
}
