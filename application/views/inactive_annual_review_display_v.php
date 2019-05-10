<style type="text/css">
#otherPoints tr:nth-child(odd) {
	font-weight:bold;
	margin:10px;
}

.answer {
  padding-left:15px;
}
</style>

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <section class="content-header">
          <h1>
           View Annual Review 
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url();?>annual_review">Annual Review</a></li>
            <li class="active">View Annual Review</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
			<?php echo $this->session->flashdata('msg'); ?>
              <div class="box">
                <div class="box-header">   
                 <h4><strong>Employee Name :  <?php echo $user_details[0]->users_first_name;?>  <?php echo $user_details[0]->users_last_name?></strong></h4>
                 <h5><strong>Designation :  <?php echo $user_details[0]->users_designation;?></strong></h5>
                </div>
                <div class="box-body">
                 <form role="form" name="form1" id="form1" action="<?=base_url();?>annual_review/annual_review_update" method="post">
                  <table class="table" border="0">
  <thead class="thead-default">
    <tr>
      <th>Sr.</th>
      <th>KRA</th>
      <th>KPI</th>
      <th>Weightage <br /><span style="font-size:10px; text-align:center;">(W)</span></th>     
      <th>MTR <br />Achievement</th>
      <th>MTR <br />Hod Comments</th>
       <th>Annual Target <br /><span style="font-size:10px;">(T)</span></th>
       <th>Achievements <br /><span style="font-size:10px;">(A)</span></th>  
      <th>Achievement figures by HOD <br /><span style="font-size:10px;">(FA)</span></th>
      <th>HOD Remarks on Achievements </th>    
      <th>Details of Achievements</th>
     <th>Final Score</th>
     <th>HOD Final Score</th>
    </tr>
    <tbody>
    <?php  			$a=1;
					  $counter = 0;  	
					  $mtr_content = "";
					  $total_score = "";
					  $total_hod_score = "";
					  foreach($mtr_data as $m) { 
					  $counter = 0 + $a;
					  $mtr_content .= "<tr class='odd'><th scope='row'>".$a."</th>
                        <td>".$m->kra."</td>
                        <td>".$m->target."</td>
                        <td>".$m->weightage."</td>
					    <td>".$m->achievements."</td>
						<td>".$m->mtr_hod_comment."</td>
					  	<td>".$m->yearly_target."</td>
						<td>".$m->final_achievement_number."</td>
						<td>".$m->actual_achievement_number."</td>
						<td>".$m->hod_final_comments."</td>
						<td>".$m->final_achievement_words."</td>
						<td>".$m->final_score."</td>
						<td>".$m->hod_final_score."</td>";						
						$mtr_content .="</tr>";
						$total_score += $m->final_score;
						$total_hod_score += $m->hod_final_score;
					  $a++;
					   } 
					 echo $mtr_content; 
					 
					 
					 
					 
					 
					 
					   ?>
                       <tr><td colspan="11" align="right">Total Score:  </td><td align="center"><?=round($total_score);?></td><td align="center"><?=round($total_hod_score);?></td><td colspan="2"></td></tr>
                      <tr><td colspan="12" align="right">Rating:  </td><td align="center"><?php echo $annual_review_details[0]->final_rating;?></td></tr>
                      </tbody></thead></table>
                       
                       
                      
                       <table border="0" cellpadding="0" cellspacing="2" width="100%" id="otherPoints">
                       <tr><td>A) What do you consider to be your most important achievements of the last year i.e. 2015- 2017?</td></tr>
                       <tr><td class="answer"> <?php echo $annual_review_details[0]->important_achievments;?></td></tr> 
                       <tr><td>B) What do you consider to be your most important aims and tasks in the next year, i.e. 2016- 2017?</td></tr>
            <tr><td class="answer"><?php echo $annual_review_details[0]->task_next_year;?></td></tr>
            <tr><td>C) What elements of your job interest you the most, and least?</td></tr>
            <tr><td class="answer"><?php echo $annual_review_details[0]->job_interest;?></td></tr> 
           <tr><td>D) What action could be taken to improve your performance in your current position by you, and your reporting manager/Unit Head?</td></tr>
           <tr><td class="answer"><?php echo $annual_review_details[0]->improve_performance;?></td></tr> 
            <tr><td>E) What sort of training/experiences would benefit you in the next year, both functional and behavioral?</td></tr>
           <tr><td class="answer"><?php echo $annual_review_details[0]->functional_training;?></td></tr> 
            <tr><td>F) HOD Comments</td></tr>
           <tr><td class="answer"><?php echo $annual_review_details[0]->fr_hod_comments;?></td></tr>                
           <tr><td>&nbsp;</td></tr>
          
                       </td></tr>
                        <tr><td colspan="6"><input type="hidden" name="kra_id" id="kra_id" value="<?php echo $annual_review_details[0]->kra_id;?>"/>
            <input type="hidden" name="counter" id="counter" value="<?php echo $counter; ?>" />
           </td></tr> 
  </tbody></thead>
</table> </form>
     
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content --> 
        <!-- /.content -->
      </div><!-- /.content-wrapper -->