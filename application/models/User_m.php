<?php
Class User_m extends CI_Model
{
	 function login($username, $password)
	 {
	   $this -> db -> select('it_id, username, password, role, first_name, last_name');
	   $this -> db -> from('it_admin');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	   $this -> db -> limit(1);
	   $query = $this->db->get();
	
		   if($query->num_rows() == 1)
		   {
			 return $query->result();
		   }
		   else
		   {
			 return false;
		   }
	 }
	 
	 
	 public function getEmployee_data($users_id) {
	   $this->db->select('*');
	   $this->db->from('users');
	   $this->db->where('users_id',$users_id);
	   $this->db->limit(1);
	   $query = $this->db->get();
	   if($query->num_rows() == 1) {
	   return $query->result();
	   } else {
	   return false;
	   }
	   	 
	 }
	 
}
?>