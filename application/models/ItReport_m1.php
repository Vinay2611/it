<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 15-10-2018
 * Time: 17:37
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class ItReport_m extends CI_Model{

    //Modal to get tikcet history
    function it_report(){
        $this->db->select('*');
        $this->db->from('it_assign_ticket');
        $this->db->order_by('ticket_id','DESC');
        $query = $this->db->get();
        return $query->result();
    }
}