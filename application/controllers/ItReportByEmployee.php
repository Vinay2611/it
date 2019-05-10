<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 19-10-2018
 * Time: 15:06
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class ItReportByEmployee extends MY_Controller
{
    //constructor to load necessary file
    function __construct()
    {
        parent::__construct();
        $this->load->model('itreport_m','',true);
        $this->load->helper('function_helper');
    }

    //main function logic
    public function index()
    {
        if($this->session->userdata('logged_in'))
        {
            //Add session data
            $session_data = $this->session->userdata('logged_in');
            $this->data['username'] = $session_data['username'];
            $this->data['role'] = $session_data['role'];
            $this->data['f_name'] = $session_data['f_name'];
            $this->data['l_name'] = $session_data['l_name'];

            $comman = new comman();
            $userDropdown = $comman->userDrop();
            $this->data['userDropdown'] = $userDropdown;
            //Add KRA Data
            //$this->load->model('report_m');
            //$kra_list = $this->kra_m->getAllKra();
            //$this->data["kra_list"] = $kra_list;
            $this->middle = 'it_report_employee_v';
            $this->layout();
        }  else   {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }


    }


    //login of report to print in excel
    public function it_report_employee_v()
    {
        $this->form_validation->set_rules('from_date', 'From date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_date', 'To date', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE)
        {
            //field validation
            $this->load->view("it_report_employee_v");
        }
        else
        {
            $data_array = array();
            $this->load->helper('php-excel');
            $from_date =  date('Y-m-d', strtotime($this->input->post('from_date')));
            $f_date =  $from_date." ".'00:00:00';
            $to_date   =  date('Y-m-d', strtotime($this->input->post('to_date')));
            $t_date   =  $to_date." ".'23:59:00';
            $users_id =  $this->input->post('users_id');
            /*$this->db->select('*',false);
            $this->db->from('it_support_ticket');
            $this->db->where("dateTime BETWEEN $from_date AND $to_date");
            $this->db->order_by('ticket_id','DESC',false);
            $query = $this->db->get();*/

            $select = "SELECT ist.ticket_number,ist.issue,ist.details_of_call,ist.call_logged_via,ist.logged_by_name,ist.system_number_tag,ist.call_assigned_time,ist.remarks,ist.comment,ist.issue_type,ist.status,ist.dateTime, ist.system_number_tag ,u.users_first_name AS fname,u.users_last_name AS lname FROM `it_support_ticket` AS ist LEFT JOIN users AS u ON ist.users_id = u.users_id WHERE ist.users_id = '$users_id' and ist.`dateTime` >= '$f_date' AND ist.`dateTime` <= '$t_date'";
            //$select = "SELECT ist.ticket_number,ist.issue,ist.details_of_call,ist.call_logged_via,ist.logged_by_name,ist.it_engg_name,ist.call_assigned_time,ist.remarks,ist.comment,ist.issue_type,ist.status,ist.dateTime,u.users_first_name AS fname,u.users_last_name AS lname FROM `it_support_ticket` AS ist LEFT JOIN users AS u ON ist.users_id = u.users_id WHERE ist.`dateTime` BETWEEN '$from_date' AND '$to_date'";
            $query = $this->db->query($select);
            $data_array[] = array('Ticket Number','Full Name','System Number Tag', 'Issue', 'Details of call', 'Call logged via', 'Issue Type', 'Status', 'Date');
            if( $query->num_rows() > 0 )
            {
                foreach ($query->result() as $row)
                {
                    $report_date  =  date('d-m-Y', strtotime($row->dateTime));
                    $full_name = $row->fname ." ".$row->lname;
                    $data_array[] = array($row->ticket_number, $full_name, $row->system_number_tag ,$row->issue,$row->details_of_call,$row->call_logged_via,$row->issue_type,$row->status,$report_date);
                }
            }
            else
            {
                $data_array[] = array('Data is not available.');
            }

            //export excel
            $xls = new Excel_XML;
            if($data_array)
            {
                $xls->addArray($data_array);
            }
            //$date = date_format(date_create(date('d-m-y')),'d F Y');
            //$date = date('d-m-y');
            $xls->generateXML("TicketByEmployee_".$from_date."_".$to_date);

        }




    }


}