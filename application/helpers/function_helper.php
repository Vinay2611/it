<?php
//Comman functions
class comman extends CI_Model {



  function getUserInfo($users_id) {
  $query = $this->db->query("SELECT u.users_first_name,u.users_last_name,concat(u1.users_first_name,' ',u1.users_last_name) as reporing_manager,d.dept_name,b.branch_name FROM users as u JOIN department as d JOIN users_reporting as ur 
 JOIN users as u1 JOIN branch as b ON u.dept_id = d.dept_id AND ur.users_id = u1.users_id AND ur.dept_id = u.dept_id AND u.branch_id = b.branch_id 
 AND u.status='Active' AND u.users_id='".$users_id."' order by u.users_first_name ASC");  
  //$query = $this->db->get();
  //echo $this->db->last_query();
  if($query->num_rows() > 0) {
	 foreach($query->result() as $row) {
		  
		  $data[] = $row;
	  }
	 return $data;  
   }
 }
 

 
 
  function getStatus($status) {
   if($status == 'Open' || $status == 'On Hold') {
   $query = $this->db->query("SELECT count(users_id) as total FROM `it_support_ticket` WHERE status='".$status."'");  
   } else {
   $query = $this->db->query("SELECT count(users_id) as total FROM `it_support_ticket` WHERE status='".$status."'  AND dateTime >= CURDATE()");  
   }
   //echo $this->db->last_query();
   if($query->num_rows() > 0) {
   $result = $query->row_array();
   return $result;  
   }
  }
  
  
  function userDrop() {
  $query = $this->db->query("SELECT users_id,users_first_name,users_last_name FROM users WHERE status='Active' ORDER BY users_first_name ASC");
	  $options = "";
	  if($query->num_rows() > 0 ) { 
	  		foreach($query->result() as $row) {
			//$options = $row->users_id;
	        $options .= '<option value="'.$row->users_id.'">'.$row->users_first_name.'&nbsp;'.$row->users_last_name.'</option>'; 
			}
			return $options;
	  }
  }
  
  
  function ticketNumber() {
  $query = $this->db->query("SELECT MAX(ticket_id) AS total FROM  `it_support_ticket` ORDER BY ticket_id DESC LIMIT 0 , 1");
   if($query->num_rows() > 0) {  
   $row = $query->row_array();
   $itId = $row['total'] + 1;
   $ticketNumber = "IT".$itId.'-'.date('d').date('m').date('y');
   return $ticketNumber;
   } 
  
  }
  
  //
  function teamList() {
  $query = $this->db->query("SELECT it_id,first_name,last_name FROM it_admin WHERE is_active='Y' ORDER BY first_name ASC");
	  $options = "";
	  if($query->num_rows() > 0 ) { 
	  		foreach($query->result() as $row) {
			//$options = $row->users_id;
	        $options .= '<option value="'.$row->it_id.'">'.$row->first_name.'&nbsp;'.$row->last_name.'</option>'; 
			}
			return $options;
	  }
  }
  


} // end of class
