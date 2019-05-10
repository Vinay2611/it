<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ajax_post_controller extends CI_Controller {
	// Show view Page
	public function index(){
	$this->load->view("kra_v");
	}

	// This function call from AJAX
	public function user_data_submit() {
	$data = array(
	'team_list' => $this->input->post('team_list')
	);
   //Either you can print value or you can send value to database
   echo json_encode($data);
   }
}
?>