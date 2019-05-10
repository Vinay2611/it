<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends MY_controller {
     
	  function __construct() {

          parent::__construct();
          //Load models
          $this->load->model('tickets_m');
          $this->load->model('user_m');
          $this->load->helper('function_helper');
          $this->load->library('form_validation');

	  }
	  
	  
	  public function index()
	  {

           if($this->session->userdata('logged_in'))
           {
               //Add session data
               $session_data = $this->session->userdata('logged_in');
               $this->data['it_id'] = $session_data['it_id'];
               $this->data['username'] = $session_data['username'];
               $this->data['role'] = $session_data['role'];
               $this->data['f_name'] = $session_data['f_name'];
               $this->data['l_name'] = $session_data['l_name'];
               //Add Tickets
               $this->load->model('tickets_m');
               $ticket_list = $this->tickets_m->getAllTickets();
               $this->data["ticket_list"] = $ticket_list;
               $this->middle = 'tickets_v';
               $this->layout();
          }  else   {
                //If no session, redirect to login page
                redirect('login', 'refresh');
          }
    }
	
	
	public function add_ticket()
	{
         $comman = new comman();
         $userDropdown = $comman->userDrop();
         $ticketNumber = $comman->ticketNumber();
         $this->data['userDropdown'] = $userDropdown;
          //$this->data['kra_id'] = $this->uri->segment(3);
          $session_data = $this->session->userdata('logged_in');
          $this->data['username'] = $session_data['username'];
          $this->data['role'] = $session_data['role'];
          $this->data['f_name'] = $session_data['f_name'];
          $this->data['l_name'] = $session_data['l_name'];
          $this->middle = 'add_ticket_v';
          $this->layout();
	}
	
	
	public function add_ticket_process() { 
            $comman = new comman();
            $ticketNumber = $comman->ticketNumber();
            $this->form_validation->set_rules('users_id', 'Users Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('details_of_call', 'Details of call', 'trim|required|xss_clean');
            $this->form_validation->set_rules('system_number_tag', 'System Number Tag', 'trim|required|xss_clean');
            $this->form_validation->set_rules('call_logged', 'call_logged', 'trim|required|xss_clean');
            if($this->form_validation->run() == FALSE)  {
            //Field validation failed.  User redirected to login page
            $this->middle = 'add_ticket_v';
            $this->layout();
        } else {
            $data = array('ticket_number'=>$ticketNumber,'users_id' => $this->input->post('users_id'),'details_of_call' => $this->input->post('details_of_call'), 'system_number_tag' => $this->input->post('system_number_tag') ,'call_logged_via'=> $this->input->post('call_logged'));
            $this->tickets_m->add_ticket($data);
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Ticket is added successfully.</div>');
            redirect('tickets/add_ticket', 'tickets/add_ticket');
        }
	}
	
	
	public function view_ticket_details()
	{
	    $comman = new comman();
	    $this->data['ticket_id'] = $this->uri->segment(3);
	    $session_data = $this->session->userdata('logged_in');
	    $this->data['username'] = $session_data['username'];
        $this->data['role'] = $session_data['role'];
        $this->data['f_name'] = $session_data['f_name'];
        $this->data['l_name'] = $session_data['l_name'];
	    $ticketData = $this->tickets_m->view_ticket_details($this->data['ticket_id']);
	    //ticket history information
	    $ticketDataHistory = $this->tickets_m->view_ticket_history($this->data['ticket_id']);
	    $this->data["ticketData"] = $ticketData;
	    $this->data['ticketDataHistory'] = $ticketDataHistory;
	    $this->middle = 'ticket_details_v';
        $this->layout();
	}
	
	
	public function view_support_team()
	{
        $ticket_id = $this->input->post('ticket_id');
	    $comman = new comman();
	    $session_data = $this->session->userdata('logged_in');
	    $this->data['username'] = $session_data['username'];
	    $result = $this->tickets_m->support_team($ticket_id);
	    echo json_encode($result);
	}

    //assign ticket added on 10-10-2018
	public function assign_task()
    {
        $resp_data = array();
        $this->form_validation->set_rules('it_id', 'Admin ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ticket_id', 'Ticket ID', 'trim|required|xss_clean');
        if($this->form_validation->run() == FALSE)  {
            //Field validation failed.
            $this->middle = 'tickets_v';
            $this->layout();
        } else {
            $data = array( 'it_admin_id' => $this->input->post('it_id'),'ticket_id' => $this->input->post('ticket_id'), 'status' => 'Open' );
            $this->tickets_m->assign_ticket($data);
            //$this->session->set_flashdata('amsg','<div class="alert alert-success text-center">Task assigned successfully.</div>');
            $resp_data = array( 'msg' => 'Ticket assigned successfully.', 'it_id' => $this->input->post('it_id'), 'ticket_id' => $this->input->post('ticket_id'), 'success' => true  );
            echo json_encode($resp_data);
            //redirect('tickets', 'tickets/tickets_v');
        }

    }

    //on hold ticket
    public function onhold_ticket(){

        $resp_data = array();
        $this->form_validation->set_rules('it_id', 'Admin ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ticket_id', 'Ticket ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|xss_clean');
        if($this->form_validation->run() == FALSE)  {
            //Field validation failed.
            $this->middle = 'tickets_v';
            $this->layout();
        } else {
            //$this->input->post('comment');
            //die(0);
            $data = array( 'it_admin_id' => $this->input->post('it_id'),'ticket_id' => $this->input->post('ticket_id'), 'status' => 'On Hold', 'comment' => $this->db->escape($this->input->post('comment')) );
            $this->tickets_m->onhold_ticket($data);
            //$this->session->set_flashdata('amsg','<div class="alert alert-success text-center">Task assigned successfully.</div>');
            $resp_data = array( 'msg' => 'Ticket put on hold.', 'it_id' => $this->input->post('it_id'), 'ticket_id' => $this->input->post('ticket_id'), 'success' => true  );
            echo json_encode($resp_data);
            //redirect('tickets', 'tickets/tickets_v');
        }
    }

    //close ticket
    public function close_ticket(){
	      $resp_data = array();
	      $this->form_validation->set_rules('it_id', 'Admin ID', 'trim|required|xss_clean');
	      $this->form_validation->set_rules('ticket_id', 'Ticket ID', 'trim|required|xss_clean');
          $this->form_validation->set_rules('remark', 'Remark', 'trim|required|xss_clean');
	      if($this->form_validation->run() == FALSE) {
	          //Field validation failed.
              $this->middle = 'tickets_v';
              $this->layout();
          } else{
	          $data = array( 'it_admin_id' => $this->input->post('it_id'),'ticket_id' => $this->input->post('ticket_id'), 'status' => 'Closed', 'remark' => $this->db->escape($this->input->post('remark')) );
	          $this->tickets_m->close_ticket($data);
	          $resp_data = array( 'msg' => 'Ticket closed successfully.', 'it_id' => $this->input->post('it_id'), 'ticket_id' => $this->input->post('ticket_id'), 'success' => true );
	          echo json_encode($resp_data);
          }
    }
	
    //Edit Tickets
    public function edit_tickets()
    {
        $comman = new comman();
        $this->data['ticket_id'] = $this->uri->segment(3);
        $session_data = $this->session->userdata('logged_in');
        $this->data['username'] = $session_data['username'];
        $this->data['role'] = $session_data['role'];
        $this->data['f_name'] = $session_data['f_name'];
        $this->data['l_name'] = $session_data['l_name'];
        $ticketData = $this->tickets_m->view_ticket_details($this->data['ticket_id']);
        //ticket history information
        $ticketDataHistory = $this->tickets_m->view_ticket_history($this->data['ticket_id']);
        $this->data["ticketData"] = $ticketData;
        $this->data['ticketDataHistory'] = $ticketDataHistory;
        $this->middle = 'edit_ticket_v';
        $this->layout();

        /*$comman = new comman();
        $userDropdown = $comman->userDrop();
        $ticketNumber = $comman->ticketNumber();
        $this->data['userDropdown'] = $userDropdown;
        //$this->data['kra_id'] = $this->uri->segment(3);
        $session_data = $this->session->userdata('logged_in');
        $this->data['username'] = $session_data['username'];
        $this->data['role'] = $session_data['role'];
        $this->data['f_name'] = $session_data['f_name'];
        $this->data['l_name'] = $session_data['l_name'];
        $this->middle = 'edit_ticket_v';
        $this->layout();*/
    }
	
	
	
}
