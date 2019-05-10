<!-- sidebar: style can be found in sidebar.less -->
  <aside class="main-sidebar">
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?=base_url();?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Welcome
                <?php
                if($username == 'superadmin'){
                    echo ucfirst($username);
                }else{
                    echo ucfirst($f_name)." ".ucfirst($l_name);
                }
                ?>
            </p>
          </div>
        </div>
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
            <li class="active">
              <a href="<?=base_url();?>home">
                <i class="fa fa-th"></i> <span>Dashboard</span> 
              </a>
            </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-table"></i> <span>IT Helpdesk</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu menu-open" style="display:block;">
             <li><a href="<?=base_url();?>/tickets/add_ticket"><i class="fa fa-circle-o"></i>Add Ticket</a></li>
		      <li><a href="<?=base_url();?>tickets"><i class="fa fa-circle-o"></i>View Ticket</a></li>
            </ul>
          </li>
          <li class="treeview" style="display:none;">
            <a href="#">
              <i class="fa fa-share"></i> <span>Inactive Employees</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu menu-open" style="display:block;">
              <li><a href="<?=base_url();?>inactive_view_tickets"><i class="fa fa-circle-o"></i>View Tickets</a></li>
            </ul>
          </li>
          
          <li class="treeview">
            <a href="#">
              <i class="fa fa-edit"></i> <span>Reports</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu menu-open" style="display:block;">
                <li><a href="<?=base_url();?>itreport"><i class="fa fa-circle-o"></i> Download Report </a></li>
                <li><a href="<?=base_url();?>itreporthistory"><i class="fa fa-circle-o"></i> Download History </a></li>
                <li><a href="<?=base_url();?>itreportbyemployee"><i class="fa fa-circle-o"></i> By Employee </a></li>
                <li><a href="<?=base_url();?>itreportbyengineer"><i class="fa fa-circle-o"></i> By Engineer </a></li>

            </ul>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
        </aside>