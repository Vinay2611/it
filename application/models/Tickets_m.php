<?php
Class Tickets_m extends CI_Model
{
	 function getAllTickets()
	 {
	  $query = "SELECT u.users_first_name, u.users_last_name,it.ticket_id,it.users_id, it.ticket_number, it.call_logged_via, it.status,
	  		   it.system_number_tag, it.call_assigned_time,it.call_closed_time,DATE_FORMAT(it.dateTime,'%D %b %Y') as dateTime FROM it_support_ticket AS it JOIN users AS u ON u.users_id = it.users_id 
			   ORDER BY it.ticket_id DESC";
	 //echo $query;
	 $query = $this->db->query($query);	   
	  //echo $this->db->last_query();
	  return $query->result();	  
	 }
	 
	 
	 function add_ticket($data) {
	  //$this->db->insert('it_support_ticket',$data);
	  $query = "INSERT INTO it_support_ticket SET users_id='".$data['users_id']."',ticket_number='".$data['ticket_number']."',details_of_call='".$data['details_of_call']."',system_number_tag='".$data['system_number_tag']."' ,call_logged_via='".$data['call_logged_via']."'";
	  $query = $this->db->query($query);
	  return true; 
	 }
	 
	 
	function view_ticket_details($ticket_id) {
	$query = "SELECT `ticket_id`, `users_id`, `ticket_number`, `details_of_call`, `call_logged_via`, `logged_by_name`, `system_number_tag`, `call_assigned_time`, `call_closed_time`, `resolution_details`, `remarks`, `comment`,`issue_type`, `status`, `dateTime`, `last_updated_on` FROM it_support_ticket WHERE ticket_id='".$ticket_id."'";
	 $query = $this->db->query($query);
     if($query->num_rows() > 0) {
	 foreach($query->result() as $row) {
	    $data[] = $row;
	 }
	 return $data;		 
	 }
	}
	
	
	function support_team($ticket_id) {
	//modified query
	$query = "SELECT t1.it_id,t1.first_name,t1.last_name,t1.photo,t1.role,t2.it_admin_id,t2.ticket_id,t2.status FROM `it_admin` AS t1 LEFT JOIN `it_assign_ticket` AS t2 ON t1.`it_id`=t2.`it_admin_id` AND t1.is_active=\"Y\" AND t2.ticket_id = $ticket_id GROUP BY t1.it_id";
	//$query = 'SELECT t1.it_id,t1.first_name,t1.last_name,t1.photo,t1.role,t2.it_admin_id,t2.ticket_id,t2.status FROM `it_admin` AS t1 LEFT JOIN assign_ticket AS t2 ON t1.`it_id`=t2.`it_admin_id` WHERE t1.is_active="Y" GROUP BY t1.it_id';
	//$query = 'SELECT it_id,first_name,last_name,photo,role FROM `it_admin` WHERE is_active="Y"';
	 $query = $this->db->query($query);
	 if($query->num_rows() > 0) {
	  //$response = array('success'=>'true','message'=> 'Your project added successfully.');
	  return $query->result();
	 }


     //
	 //return $response;	 
	 //return $query->result();
	}
	
	
	
	 
	 
	/* function getEmployee_Mtr($kra_id)
	 {
	  $this->db->select('*');
	  $this->db->from('kra');
	  $this->db->join('kra_points','kra.kra_id = kra_points.kra_id AND kra.kra_id = "'.$kra_id.'"');
	  $this->db->order_by('kra_points_id','ASC');
	  $query = $this->db->get();
	   //echo $this->db->last_query();
	  return $query->result();	 
	 }
	 
	 
	 function getMtrDetails($kra_id) {
	 $this->db->select('*');
	 $this->db->from('kra');
	 $this->db->join('kra_mtr','kra.kra_id = kra_mtr.kra_id AND kra_mtr.kra_id ='.$kra_id);
	 $query = $this->db->get();
	   if($query->num_rows() > 0) {
		foreach($query->result() as $row) {
		$data[] = $row;	
		}
		return $data;		 
	   }
	 }
	 
	 
	 function updMtrDetails($kra_id,$mtr_data) {
	  //Code here.
	  $this->db->where('kra_id',$kra_id);
	  $this->db->update('kra_mtr',$mtr_data);
	  //echo $this->db->last_query(); 	 		  
	  return true;
	 }
	 
	
	 function updMtrPoints($data) {
		for($i=0;$i<$data['counter'][0];$i++) {
	$query = $this->db->query('UPDATE kra_points set achievements="'.$data['achievements'][$i].'",mtr_hod_comment="'.$data['comments'][$i].'" WHERE kra_points_id='.$data['kra_points_id'][$i]);
	    }
	 return true;
	 }
	 
	
	 function count_details() {
	 $currentYear = date('Y');
	 $q = "SELECT count(kra.kra_id) as total FROM kra JOIN users ON users.users_id = kra.users_id AND users.status='Active' AND kra.mtr_application_date >= '".$currentYear."-04-01'";
	 $query = $this->db->query($q);
	 //echo $this->db->last_query();
	 if($query->num_rows() > 0)
     {
	    foreach ($query->result() as $row)
		{
		 $count = $row->total;
		}
      } 
	   return $count;
	 } 
	 
	 
	 function mtr_summary($type) {
	 $currentYear = date('Y');
	 $q = "SELECT count(kra_id) as total FROM kra JOIN users ON users.users_id = kra.users_id AND users.status='Active' AND kra.mtr_status='".$type."'";
	 if($type == 'Not Updated') {
	 $q .= " AND `kra_application_date` >= '".$currentYear."-04-01'";	 
	 } else {
	 $q .= " AND `mtr_application_date` >= '".$currentYear."-04-01'";	 
	 }
	 	 
	 $query = $this->db->query($q);
	 //echo $this->db->last_query();
	 if($query->num_rows() > 0)
     {
	    foreach ($query->result() as $row)
		{
		 $count = $row->total;
		}
      } 
	   return $count;
	 }*/
	 
	 
	 
	 
	 //assign ticket added on 10-10-2018
    function assign_ticket($data) {
        $query = "INSERT INTO `it_assign_ticket` SET `it_admin_id`='".$data['it_admin_id']."',`ticket_id`='".$data['ticket_id']."',`status`='".$data['status']."',`createdon`=NOW()";
        $query = $this->db->query($query);
        if($query){

            $update = "UPDATE `it_support_ticket` SET `status`='".$data['status']."' WHERE `ticket_id` = '".$data['ticket_id']."'";
            $update1 = $this->db->query($update);
            return true;
            /*if($update1){
                $last_insert_id = $this->db->insert_id();
                $ith = "INSERT INTO `it_ticket_history` SET `at_id`='$last_insert_id', `it_admin_id`='".$data['it_admin_id']."', `ticket_id`='".$data['ticket_id']."', `status`='".$data['status']."', `createdon`=NOW()";
                $ith_query = $this->db->query($ith);
                return true;
            }*/
        }else{
            return false;
        }

    }

    //on hold ticket added on 11-10-2018
    function onhold_ticket($data) {
        $query = "INSERT INTO `it_assign_ticket` SET `it_admin_id`='".$data['it_admin_id']."',`ticket_id`='".$data['ticket_id']."',`status`='".$data['status']."',`comment`=".$data['comment'].",`createdon`=NOW()";
        $query = $this->db->query($query);
        if($query){
            $update = "UPDATE `it_support_ticket` SET `status`='".$data['status']."',`comment`=".$data['comment']." WHERE `ticket_id` = '".$data['ticket_id']."'";
            $update1 = $this->db->query($update);
            return true;
            /*if($update1){
                $last_insert_id = $this->db->insert_id();
                $ith = "INSERT INTO `it_ticket_history` SET `at_id`='$last_insert_id', `it_admin_id`='".$data['it_admin_id']."', `ticket_id`='".$data['ticket_id']."', `status`='".$data['status']."', `createdon`=NOW()";
                $ith_query = $this->db->query($ith);
                return true;
            }*/
        }else{
            return false;
        }
    }

    //close ticket added on 12-10-2018
    function close_ticket($data) {
        $ins_qry = "INSERT INTO `it_assign_ticket` SET `it_admin_id`='".$data['it_admin_id']."',`ticket_id`='".$data['ticket_id']."',`status`='".$data['status']."',`remark`=".$data['remark'].",`createdon`=NOW()";
        $exe_qry = $this->db->query($ins_qry);
        if($exe_qry){
            $update_qry = "UPDATE `it_support_ticket` SET `status`='".$data['status']."',`remarks`=".$data['remark']." WHERE `ticket_id` = '".$data['ticket_id']."'";
            $exe_qry = $this->db->query($update_qry);
            return true;
        }else{
            return false;
        }

    }

    //ticket details history
    function view_ticket_history($ticket_id) {
        $query = "SELECT `at_id`, `it_admin_id`, `ticket_id`, `status`, `comment`, `remark`, `createdon`, DATE_FORMAT(createdon,'%h:%i %p') AS ticket_time, DATE_FORMAT(createdon,'%d-%m-%Y') AS ticket_date ,  ia.`first_name` , ia.`last_name` FROM `it_assign_ticket` AS iat LEFT JOIN `it_admin` ia ON iat.it_admin_id=ia.it_id  WHERE ticket_id='".$ticket_id."'";
        $query = $this->db->query($query);
        if($query->num_rows() > 0) {
            foreach($query->result() as $row) {
                $datafetch[] = $row;
            }
            return $datafetch;
        }
    }
	 
}
?>