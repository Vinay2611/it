   <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         <section class="content-header">
          <h1>
           Add Tickets
          </h1>
          <ol class="breadcrumb">
             <li><a href="<?=base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
             <li class="active">Add Ticket</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">   
                <?php echo $this->session->flashdata('msg'); ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div class="box box-primary">
               
                <!-- form start -->
                <form role="form" name="form1" id="form1" action="<?=base_url();?>tickets/add_ticket_process" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">User Name</label>
                      <select name="users_id" id="users_id" class="form-control">
                        <option value="">Select</option>
                          <?php echo $userDropdown;?>
                        </select>
                        <?php echo form_error('users_id'); ?>
                    </div>
             <div class="form-group">
             <label for="exampleInputPassword1">Details of Call</label>
            <textarea class="form-control_kra" name="details_of_call" id="details_of_call" placeholder="Details of call"><?php //echo $kraArr->target; ?></textarea>
            <?php echo form_error('details_of_call'); ?>
            </div>

                      <div class="form-group">
                          <label for="">System Number / Tag</label>
                          <input type="text" id="system_number_tag" name="system_number_tag" class="form-control" placeholder="System Number Tag" value="">
                          <?php echo form_error('system_number_tag'); ?>
                      </div>
                    <div class="form-group">
                      <label for="call_logged">Call Logged using</label></div>
                      <div class="form-group">
                      <label class="radio-inline"><input type="radio" name="call_logged" id="call_logged1" value="Mail"/>Mail</label>
                     <label class="radio-inline"><input type="radio" name="call_logged" id="call_logged2" value="Phone"/>Phone</label>
                     <label class="radio-inline"><input type="radio" name="call_logged" id="call_logged3" value="Web" checked="checked"/>Web</label>
                      <?php echo form_error('call_logged'); ?>
                    </div>
                  </div><!-- /.box-body-->
                  <div class="box-footer">                  
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
                    
                   
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content --> 
        <!-- /.content -->
      </div><!-- /.content-wrapper -->