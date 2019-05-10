<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 17-10-2018
 * Time: 14:12
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class ItReportHistory extends MY_Controller
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
            //Add KRA Data
            //$this->load->model('report_m');
            //$kra_list = $this->kra_m->getAllKra();
            //$this->data["kra_list"] = $kra_list;
            $this->middle = 'it_report_history_v';
            $this->layout();
        }else{
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }


    }

    //main function logic
    public function it_report_history()
    {
        $this->form_validation->set_rules('from_date', 'From date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to_date', 'To date', 'trim|required|xss_clean');

        if($this->form_validation->run() == FALSE)
        {
            //field validation
            $this->load->view("it_report_history_v");
        }
        else
        {
            $this->load->helper('php-excel');
            $from_date =  date('Y-m-d', strtotime($this->input->post('from_date')));
            $f_date =  $from_date." ".'00:00:00';
            $to_date   =  date('Y-m-d', strtotime($this->input->post('to_date')));
            $t_date   =  $to_date." ".'23:59:00';

            /*$this->db->select('*',false);
            $this->db->from('it_support_ticket');
            $this->db->where("dateTime BETWEEN $from_date AND $to_date");
            $this->db->order_by('ticket_id','DESC',false);
            $query = $this->db->get();*/

            $select = "SELECT iat.it_admin_id,iat.ticket_id,iat.status,iat.comment,iat.remark,DATE_FORMAT(iat.createdon,'%h:%i %p') AS ticket_time, DATE_FORMAT(iat.createdon,'%d-%m-%Y') AS ticket_date,ia.first_name,ia.last_name,ist.ticket_number,ist.dateTime,ist.system_number_tag FROM `it_assign_ticket` AS iat LEFT JOIN it_admin AS ia ON iat.it_admin_id = ia.it_id LEFT JOIN `it_support_ticket` AS ist ON iat.ticket_id = ist.ticket_id WHERE ist.`dateTime` >= '$f_date' AND ist.`dateTime` <= '$t_date'";
            //$select = "SELECT ist.ticket_number,ist.issue,ist.details_of_call,ist.call_logged_via,ist.logged_by_name,ist.it_engg_name,ist.call_assigned_time,ist.remarks,ist.comment,ist.issue_type,ist.status,ist.dateTime,u.users_first_name AS fname,u.users_last_name AS lname FROM `it_support_ticket` AS ist LEFT JOIN users AS u ON ist.users_id = u.users_id WHERE ist.`dateTime` BETWEEN '$from_date' AND '$to_date'";
            //die(0);
            //$select = "SELECT * FROM `it_support_ticket` WHERE `dateTime` BETWEEN '$from_date' AND '$to_date'";
            $query = $this->db->query($select);

            $data_array[] = array('Ticket Number','Engineer', 'System Number Tag','Comment', 'Remark', 'Status', 'Time', 'Date');

            if( $query->num_rows() > 0 )
            {
                foreach ($query->result() as $row)
                {
                    //$common = new comman();
                    //$userData = $common->getUserInfo($row->users_id);
                    $report_date  =  date('d-m-Y', strtotime($row->dateTime));
                    $data_array[] = array($row->ticket_number,$row->first_name,$row->system_number_tag,$row->comment,$row->remark,$row->status,$row->ticket_time,$row->ticket_date);
                }
            }
            else
            {
                $data_array[] = array('Data is not available.');
            }

            $xls = new Excel_XML;
            if($data_array)
            {
                $xls->addArray($data_array);
            }
            //$date = date_format(date_create(date('d-m-y')),'d F Y');
            //$date = date('d-m-y');
            $xls->generateXML("TicketReportHistory_".$from_date."_".$to_date);
            //$xls->generateXML("TicketReportHistory_".$date);
            //$xls->generateCSV("TicketReportHistory_".$date);


        }




    }
}

?>


