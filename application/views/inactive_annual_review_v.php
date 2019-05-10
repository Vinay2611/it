
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<!-- Content Header (Page header) -->
         <section class="content-header">
          <h1>
          Inactive Annual Review
          </h1>
          <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Annual Review (Inactive Users)</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <!-- /.box -->
		
              <div class="box">
                <div class="box-header">   
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr.</th>
                          <th>Employee Name</th>
                        <th>Employee Code</th>
						 <th>Branch</th>
                        <th>Department</th>
                         <th>Report Manager</th>
                        <th>Status</th>
                        <th class="sorting_asc_disabled">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
					  $this->load->helper('function_helper');
					  $common = new comman();
					  $a=1;
					  $review_content = "";
					  $view = "";
					  foreach($inactive_annual_list as $list) { 
					  $location = $common->getInactiveUserInfo($list->users_id);
					  
					  
					  
					  //View Link
					  if($list->final_review_status != 'Not Updated') {
					  $view = '<a href='.base_url().'inactive_annual_review/view/'.$list->kra_id.' tittle="Click here to view">View</a>';
					  }
					  
					  $review_content .= "<tr class='odd'><td>".$a."</td>
						  <td>".$list->users_first_name."&nbsp;".$list->users_last_name."</td>
						  <td>".$list->users_employee_id."</td>
						  <td>".$location[0]->branch_name."</td>
			  			  <td>".$location[0]->dept_name."</td>
					  	  <td>".$location[0]->reporing_manager."</td>
						  <td>".$list->final_review_status."</td>
						  <td>".$view." Export</td>
                        </tr>";					  
					   $a++;
					   } 
					   echo $review_content; 
					   ?>
                    </tbody>
                    <tfoot>
                      <tr>
                         <th>Sr.</th>
                         <th>Employee Name</th>
                        <th>Employee Code</th>
						 <th>Branch</th>
                        <th>Department</th>
                         <th>Report Manager</th>
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
    
    
     
      

