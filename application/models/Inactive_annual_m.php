<?php
Class Inactive_annual_m extends CI_Model
{
    function getInactiveUsersAnnualReview()	 {
	$this->db->select('*',false);
	$this->db->from('kra');
	$this->db->join('users','kra.users_id = users.users_id AND users.status="Inactive" AND kra.kra_status="Approved"')->join('kra_points','kra.kra_id = kra_points.kra_id','TYPE',false); 
	$this->db->order_by('final_review_status','DESC',false);
	$this->db->group_by('kra.users_id',false);
	$query = $this->db->get();
    //echo $this->db->last_query();
	return $query->result();	  
	}
	
	
	function getAnnualDetails($kra_id) {
	 $this->db->select('*');
	 $this->db->from('kra');
	 $this->db->join('kra_final_review','kra.kra_id = kra_final_review.kra_id AND kra_final_review.kra_id ='.$kra_id);
	 //echo $this->db->last_query();
	 $query = $this->db->get();
	   if($query->num_rows() > 0) {
		foreach($query->result() as $row) {
		$data[] = $row;	
		}
		return $data;		 
	   }
	}
	 
	 
}?>