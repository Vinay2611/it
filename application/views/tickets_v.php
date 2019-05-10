<script type="text/javascript">
function showModal(ticket_id,modal_id) {
   //$("#myModal #brief_id").val('');
   if(modal_id) {
	$.post('<?php echo base_url(); ?>/Tickets/view_support_team',{ticket_id : ticket_id}, function(data) {
    var JSONObject = JSON.parse(data);
    console.log(JSONObject);      
	var mHtml = "";
	for (var key in JSONObject) {
        if (JSONObject.hasOwnProperty(key)) {
          mHtml += "<tr>";
          mHtml += "<td>" + JSONObject[key]['first_name'] + "</td>";
          mHtml += "<td>" + JSONObject[key]['last_name'] + "</td>";
          if(JSONObject[key]['status'] == 'Open'){
              mHtml += '<td align="center">Assigned</td>';
          }else{
              mHtml += '<td align="center"><button type="button" onclick="assignTask('+ ticket_id +","+ JSONObject[key]["it_id"] +')" class="btn btn-primary">Assign</button></td>';
          }
          mHtml += "</tr>";
        }
    }
 	
	$("#myModal #modal_body #tblBody").html(mHtml);
	});
	
   }
   Show(modal_id);
   /*
   Show(modal_id);
   $("#myModal #brief_id").val(brief_id);*/
}

function Show(id){
	//Fix CSS
	$(".modal-footer").css({"padding":"19px 20px 20px","margin-top":"15px","text-align":"right","border-top":"1px solid #e5e5e5"});
	$(".modal-body").css("overflow-y","auto");
	//Fix .modal-body height
	$('#'+id).on('shown.bs.modal',function(){
		$("#"+id+">.modal-dialog>.modal-content>.modal-body").css("height","auto");
		h1=$("#"+id+">.modal-dialog").height();
		h2=$(window).height();
		h3=$("#"+id+">.modal-dialog>.modal-content>.modal-body").height();
		h4=h2-(h1-h3);		
		if($(window).width()>=768){
			if(h1>h2){
				$("#"+id+">.modal-dialog>.modal-content>.modal-body").height(h4);
			}
			$("#"+id+">.modal-dialog").css("margin","30px auto");
			$("#"+id+">.modal-dialog>.modal-content").css("border","1px solid rgba(0,0,0,0.2)");
			$("#"+id+">.modal-dialog>.modal-content").css("border-radius",6);				
			if($("#"+id+">.modal-dialog").height()+30>h2){
				$("#"+id+">.modal-dialog").css("margin-top","0px");
				$("#"+id+">.modal-dialog").css("margin-bottom","0px");
			}
		}
		else{
			//Fix full-screen in mobiles
			$("#"+id+">.modal-dialog>.modal-content>.modal-body").height(h4);
			$("#"+id+">.modal-dialog").css("margin",0);
			$("#"+id+">.modal-dialog>.modal-content").css("border",0);
			$("#"+id+">.modal-dialog>.modal-content").css("border-radius",0);	
		}
		//Aply changes on screen resize (example: mobile orientation)
		window.onresize=function(){
			$("#"+id+">.modal-dialog>.modal-content>.modal-body").css("height","auto");
			h1=$("#"+id+">.modal-dialog").height();
			h2=$(window).height();
			h3=$("#"+id+">.modal-dialog>.modal-content>.modal-body").height();
			h4=h2-(h1-h3);
			if($(window).width()>=768){
				if(h1>h2){
					$("#"+id+">.modal-dialog>.modal-content>.modal-body").height(h4);
				}
				$("#"+id+">.modal-dialog").css("margin","30px auto");
				$("#"+id+">.modal-dialog>.modal-content").css("border","1px solid rgba(0,0,0,0.2)");
				$("#"+id+">.modal-dialog>.modal-content").css("border-radius",6);				
				if($("#"+id+">.modal-dialog").height()+30>h2){
					$("#"+id+">.modal-dialog").css("margin-top","0px");
					$("#"+id+">.modal-dialog").css("margin-bottom","0px");
				}
			}
			else{
				//Fix full-screen in mobiles
				$("#"+id+">.modal-dialog>.modal-content>.modal-body").height(h4);
				$("#"+id+">.modal-dialog").css("margin",0);
				$("#"+id+">.modal-dialog>.modal-content").css("border",0);
				$("#"+id+">.modal-dialog>.modal-content").css("border-radius",0);	
			}
		};
	});  
	//Free event listener
	$('#'+id).on('hide.bs.modal',function(){
		window.onresize=function(){};
	});  
	//Mobile haven't scrollbar, so this is touch event scrollbar implementation
	var y1=0;
	var y2=0;
	var div=$("#"+id+">.modal-dialog>.modal-content>.modal-body")[0];
	div.addEventListener("touchstart",function(event){
		y1=event.touches[0].clientY;
	});
	div.addEventListener("touchmove",function(event){
		event.preventDefault();
		y2=event.touches[0].clientY;
		var limite=div.scrollHeight-div.clientHeight;
		var diff=div.scrollTop+y1-y2;
		if(diff<0)diff=0;
		if(diff>limite)diff=limite;
		div.scrollTop=diff;
		y1=y2;
	});
	//Fix position modal, scroll to top.	
	$('html, body').scrollTop(0);
	//Show
	$("#"+id).modal('show');
}


function assignTask( ticket_id,user_admin_id ){
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>/Tickets/assign_task",
        data: {
            it_id : user_admin_id,
            ticket_id : ticket_id
        },
        success: function(data)
        {
            console.log(data);
            var data = JSON.parse(data);
            console.log(data);
            if(data.success){

                /*setTimeout(function(){
                    location.reload();
                },3000);*/
                //$('#resp-msg').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);

                showModal(data.ticket_id,"myModal");
                alertify.success(data.msg);
            }else{
                //alertify.error(data.msg);
                $('#resp-msg').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);
            }

        }
    });
}


function confirmAdmin( ticket_id , user_admin_id ){

    bootbox.confirm({
        message: "Are you sure you want to open this ticket?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            console.log('This was logged in the callback: ' + result);
            if(result == true){
                //console.log("true");

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>/Tickets/assign_task",
                    data: {
                        it_id : user_admin_id,
                        ticket_id : ticket_id
                    },
                    success: function(data)
                    {
                        var data = JSON.parse(data);
                        if(data.success){
                            alertify.success(data.msg);
                            setTimeout(function(){
                                location.reload();
                            },3000);
                        }else{
                            alertify.error(data.msg);
                            setTimeout(function () {
                                location.reload();
                            },3000);
                        }

                    }
                });

            }else{
                console.log("false");
            }
        }
    });
}

function onHoldTicket1( ticket_id , user_admin_id ) {
    bootbox.confirm({
        message: "Are you sure you want to hold this ticket?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            console.log('This was logged in the callback: ' + result);
            if(result == true){
                //console.log("true");

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>/Tickets/onhold_ticket",
                    data: {
                        it_id : user_admin_id,
                        ticket_id : ticket_id
                    },
                    success: function(data)
                    {
                        var data = JSON.parse(data);
                        if(data.success){
                            $('#resp-msg1').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);
                        }else{
                            $('#resp-msg1').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);
                        }

                    }
                });

            }else{
                console.log("false");
            }
        }
    });
}

//close ticket
function closeTicket1( ticket_id , user_admin_id ) {
    bootbox.confirm({
        message: "Are you sure you want to close this ticket?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            console.log('This was logged in the callback: ' + result);
            if(result == true){
                //console.log("true");

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>/Tickets/close_ticket",
                    data: {
                        it_id : user_admin_id,
                        ticket_id : ticket_id
                    },
                    success: function(data)
                    {
                        var data = JSON.parse(data);
                        if(data.success){
                            $('#resp-msg1').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);
                        }else{
                            $('#resp-msg1').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);
                        }

                    }
                });

            }else{
                console.log("false");
            }
        }
    });
}


$(document).ready(function () {

    //Onhold modal open with value
    $(".onHoldIcon").click(function () {
        var mticketVal = $(this).data('ticket');
        var mitVal = $(this).data('it');
        $('#mticket_id').val(mticketVal);
        $('#mit_id').val(mitVal);
        $('#onHold').modal('show');
    });

    //close modal with remark
    $(".close-modal").click( function () {
        var mcticketVal = $(this).data('ticket');
        var mcitVal = $(this).data('it');
        $('#mcticket_id').val(mcticketVal);
        $('#mcit_id').val(mcitVal);
        $('#closeModal').modal('show');
    });

    //Send ajax method on hold
    $("#onHoldModal").submit( function (e) {

        e.preventDefault();
        var user_admin_id = $("#mit_id").val(); //
        var ticket_id = $("#mticket_id").val();
        var comment = $("#comment").val();

        if( user_admin_id == '' || ticket_id == '' || comment == '')
        {
            bootbox.alert("Something is went wrong.Please fill all the details.");
        }else{

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Tickets/onhold_ticket",
                data: {
                    it_id : user_admin_id,
                    ticket_id : ticket_id,
                    comment : comment
                },
                success: function(data)
                {
                    var data = JSON.parse(data);
                    console.log(data);
                    if(data.success){
                        $('#onHold').modal('hide');
                        alertify.success(data.msg);
                        setTimeout(function(){
                            location.reload();
                        },3000);
                        //$('#resp-msg1').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);
                    }else{
                        $('#onHold').modal('hide');
                        alertify.error(data.msg);
                        setTimeout(function(){
                            location.reload();
                        },3000);
                        //$('#resp-msg1').html(data.msg).fadeIn(2000).delay(2000).fadeOut(2000);
                    }

                }
            });

        }

    });

    $("#closeRemarkModal").submit( function (e) {
        e.preventDefault();
        var user_admin_id = $("#mcit_id").val();
        var ticket_id = $("#mcticket_id").val();
        var remark = $("#remark").val();

        if( user_admin_id == '' || ticket_id == '' || remark == '' )
        {
            bootbox.alert("Something is went wrong.Please fill all the details.");
        }else{

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>/Tickets/close_ticket",
                data: {
                    it_id : user_admin_id,
                    ticket_id : ticket_id,
                    remark : remark
                },
                success: function(data)
                {
                    var data = JSON.parse(data);
                    console.log(data);
                    if(data.success){
                        $('#closeModal').modal('hide');
                        alertify.success(data.msg);
                        setTimeout(function(){
                            location.reload();
                        },3000);
                    }else{
                        $('#closeModal').modal('hide');
                        alertify.error(data.msg);
                        setTimeout(function(){
                            location.reload();
                        },3000);
                    }

                }
            });

        }

    })

});


</script>

<style>
    .actionButton{
        cursor: pointer;
    }
    #comment{
        width: 100%;
    }
    #remark{
        width: 100%;
    }
    .close-modal{
        cursor: pointer;
    }
    .Pending{
        color: #f39c12;
    }
    .Closed{

    }
    .On , .Hold{
        color:  #34b1b1;
    }
    .Open{
        color:  #32bdd4;
    }
</style>
<?php

$common = new comman();
$teamList = $common->teamList(' ');
?>

<!--On hold Modal-->
<div id="onHold" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="" method="" id="onHoldModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="location.reload();" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">On hold Ticket</h4>
                </div>
                <div id="modal_body" class="modal-body">
                    <label for="">Add comments</label>
                    <input type="hidden" name="ticket_id" id="mticket_id" value="">
                    <input type="hidden" name="it_id" id="mit_id" value="">
                    <textarea name="comment" id="comment" rows="4" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" onclick="location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!--<input type="hidden" name="brief_id" id="brief_id" value=""/><button type="button" onclick="redirect()" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </form>
    </div>
</div>

<!--Close Modal-->
<div id="closeModal" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="" method="" id="closeRemarkModal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" onclick="location.reload();" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Close Ticket</h4>
                </div>
                <div id="modal_body" class="modal-body">
                    <label for="">Add Remark</label>
                    <input type="hidden" name="ticket_id" id="mcticket_id" value="">
                    <input type="hidden" name="it_id" id="mcit_id" value="">
                    <textarea name="remark" id="remark" rows="4" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" onclick="location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!--<input type="hidden" name="brief_id" id="brief_id" value=""/><button type="button" onclick="redirect()" class="btn btn-default" data-dismiss="modal">Close</button>-->
                </div>
            </div>
        </form>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="location.reload();" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assign Ticket</h4>
      </div>
      <div id="modal_body" class="modal-body">
       <h4 id="resp-msg"></h4>
       <table id="tblBody" class="table table-bordered table-striped" >
       
       </table>
      </div>
      <div class="modal-footer">
       <input type="hidden" name="brief_id" id="brief_id" value=""/><button type="button" onclick="location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
       <!--<input type="hidden" name="brief_id" id="brief_id" value=""/><button type="button" onclick="redirect()" class="btn btn-default" data-dismiss="modal">Close</button>-->
      </div>
    </div>

  </div>
</div>

<!--<form name="form1" id="form1" method="post">
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Assign Ticket</h4>
        </div>
        <div class="modal-body">
        <label>Assign to  <select name="team_list" id="team_list">
        <?=$teamList;?>
        </select></label> 
          <p><input type="button" name="submit" id="submit" value="Submit" /> </p>
        </div>
      </div>      
    </div>
</div>  
</form>-->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           View Tickets
          </h1>
          <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Tickets</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
            <h3 id="resp-msg1" style="display: none"></h3>
			<?php echo $this->session->flashdata('msg'); ?>
              <div class="box">
                <div class="box-header">   
                </div><!-- /.box-header -->
                <div class="box-body">
                  <!--<table id="example1" class="table table-bordered">-->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr.</th>
                        <th>Reported On</th>
                        <th>Ticket Number</th>
                        <th>Full Name</th>
                        <th>Department</th>
                         <th>Call Assigned</th>
                         <th>Status</th>
                        <th class="sorting_asc_disabled">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
					  //$this->load->helper('function_helper');
					 
					  $a=1;
					  $ticket_content = "";
					  $viewButton = "";
                      $callassign = array();
                      $callAssignName = '';
					
  					  $actionButton = "";
  					  $onholdButton = "";
  					  $closeButton = "";
  					  $editButton = "";

					  foreach($ticket_list as $t) {

                      //getting call assigned name
                      $sql = "SELECT ita.it_admin_id,ita.ticket_id,ia.first_name as first_name , ia.last_name FROM `it_assign_ticket` AS ita JOIN `it_admin` AS ia ON ita.it_admin_id=ia.it_id WHERE ita.ticket_id = '$t->ticket_id' GROUP BY ita.it_admin_id";

                      $query = $this->db->query($sql);

                      if($query->num_rows() > 0){

                          foreach ($query->result() as $rowData){
                              $callassign[] = $rowData->first_name." ".$rowData->last_name;
                          }
                          $callAssignName = implode(" ," ,$callassign);
                          unset($callassign);
                      }

                      $location = $common->getUserInfo($t->users_id);
					  $viewButton = "<a href='tickets/view_ticket_details/".$t->ticket_id."' target='_self' title='Click here to view details'><img src='assets/images/icons/view.png' border='0' class='actionIcon'></a>";

                      $actionButton = "<a onclick='showModal(".$t->ticket_id.",\"myModal\");' title='Click here to Assign tickets'><img src='assets/images/icons/assign-person.png' border='0' class='actionIcon'></a>";
                      $onholdButton = "<a data-toggle='modal' data-ticket='$t->ticket_id' data-it='$it_id' class='onHoldIcon' title='Click here to on hold ticket'><img src='assets/images/icons/ong.png' border='0' class='actionIcon'></a>";
                      //$onholdButton = "<a onclick='onHoldTicket(".$t->ticket_id. ',' .$it_id ." )' title='Click here to on hold ticket'><img src='assets/images/icons/ong.png' border='0' class='actionIcon'></a>";
                      $closeButton  = "<a data-toggle='modal' data-ticket='$t->ticket_id' data-it='$it_id' class='close-modal' title='Click here to close ticket'><img src='assets/images/icons/cls.png' border='0' ></a>";
                      //$closeButton  = "<a onclick='closeTicket(".$t->ticket_id. ',' .$it_id ." )' title='Click here to close ticket'><img src='assets/images/icons/cls.png' border='0' class='actionIcon'></a>";
                      if($t->status == 'Pending') {
                        //$onholdButton = "";
					    //$actionButton = "<a onclick=showModal(".$t->ticket_id.",\'myModal\')  rel=".$t->ticket_id." class='actionButton'>Open</a>";
					  }
					  
					  if($t->status == 'Open') {
                          //$onholdButton = "<a onclick='confirmAdmin(".$t->ticket_id. ',' .$it_id ." )' rel=".$t->ticket_id." class='actionButton'>On Hold</a>";
                          //$actionButton = "";
                      //$onholdButton = "<a id='tid' rel=".$t->ticket_id.">On Hold</a> | <a id='tid' rel=".$t->ticket_id.">Close</a>";
					  //$actionButton = "";
					  //$actionButton = "<a id='tid' rel=".$t->ticket_id.">On Hold</a> | <a id='tid' rel=".$t->ticket_id.">Close</a>";
					  }

                      if($t->status == 'On Hold') {
                      //$onholdButton = "<a onclick='confirmAdmin(".$t->ticket_id. ',' .$it_id ." )' rel=".$t->ticket_id." class='actionButton'>On Hold</a>";
                      //$actionButton = "<a id='tid' rel=".$t->ticket_id.">Close</a>";
                          $onholdButton = "";
                          $actionButton = "";
                          //$actionButton = "<a onclick='confirmAdmin(" . $t->ticket_id . ',' . $it_id . " )' rel=" . $t->ticket_id . " class='actionButton'>Open</a>";
                      }


                      if($role == 'admin'){
                          if($t->status == 'Open') {
                              $onholdButton = "<a data-toggle='modal' data-ticket='$t->ticket_id' data-it='$it_id' class='onHoldIcon' title='Click here to on hold ticket'><img src='assets/images/icons/ong.png' border='0' class='actionIcon'></a>";
                              //$onholdButton = "<a onclick='onHoldTicket(".$t->ticket_id. ',' .$it_id ." )' title='Click here to on hold ticket'><img src='assets/images/icons/ong.png' border='0' class='actionIcon'></a>";
                              /*$onholdButton = "<a onclick='confirmAdmin(".$t->ticket_id. ',' .$it_id ." )' rel=".$t->ticket_id." class='actionButton'>On Hold</a>";*/
                              $actionButton = "";
                          }
                          if($t->status == 'On Hold') {
                              $onholdButton = "";
                              $actionButton = "";
                              //$actionButton = "<a onclick='confirmAdmin(" . $t->ticket_id . ',' . $it_id . " )' rel=" . $t->ticket_id . " class='actionButton' title='Click here to Assign tickets' >Open</a>";
                          }
                          if($t->status == 'Pending') {
                              $onholdButton = "<a data-toggle='modal' data-ticket='$t->ticket_id' data-it='$it_id' class='onHoldIcon' title='Click here to on hold ticket'><img src='assets/images/icons/ong.png' border='0' class='actionIcon'></a>";
                              /*$onholdButton = "<a onclick='confirmAdmin(".$t->ticket_id. ',' .$it_id ." )' rel=".$t->ticket_id." class='actionButton'>On Hold</a>";*/
                              $actionButton = "<a onclick='confirmAdmin(" . $t->ticket_id . ',' . $it_id . " )' rel=" . $t->ticket_id . " class='actionButton' title='Click here to Assign tickets' >Open</a>";
                          }
                      }

                      if($t->status == 'Closed') {
                      $onholdButton = "";
                      $actionButton = "";
                      $closeButton = "";
                      }


					  //$actionButton .= "<a onclick=showModal(".$t->ticket_id.",\'myModal\') title='Click here to Assign tickets'><img src='assets/images/icons/assign-person_red.png' border='0' class='actionIcon'></a>";

                      $editButton = "<a title='Click here to edit' href='tickets/edit_tickets/".$t->ticket_id."'><i class='fa fa-1x fa-edit'></i></a>";
					  
					  $ticket_content .= "<tr class='".$t->status."'><td>".$a."</td>
                        <td>".$t->dateTime."</td>
						<td>".$t->ticket_number."</td>
						<td>".$t->users_first_name."&nbsp;".$t->users_last_name."</td>
						<td>".$location[0]->dept_name."</td>
                        <td>"."$callAssignName"."</td>
						<td>".$t->status."</td>
                        <td>".$actionButton."  ".$onholdButton." ".$closeButton." ".$viewButton. $editButton."</td></tr>";
                          $callAssignName='';
					  $a++;

					  //unset($callAssignName);
					   }
					 echo $ticket_content; 
					   ?>
                    </tbody>
                    <tfoot>
                      <tr>
                         <th>Sr.</th>
                         <th>Reported On</th>
                        <th>Ticket Number</th>
                        <th>Full Name</th>
                        <th>Department</th>
                         <th>Call Assigned</th>
                        <th>Status</th>
                        <th class="sorting_asc_disabled">Action</th>                    
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content --> 

        
        <!-- /.content -->
      </div><!-- /.content-wrapper -->
    
    
     
      

