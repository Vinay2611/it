<?php
$common = new comman();
$teamList = $common->teamList(' ');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            View Ticket Details
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">View Ticket Details</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box -->
                <?php //echo $this->session->flashdata('msg'); ?>
                <div class="box">
                    <div class="box-header">
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $empData = $common->getUserInfo($ticketData[0]->users_id);

                        ?>
                        <div class="col-sm-12">
                            <table class="table table-striped" border="0">
                                <tbody>
                                <tr>
                                    <th scope="col">Ticket Number</th>
                                    <td><?= $ticketData[0]->ticket_number; ?></td>
                                </tr>
                                <tr>
                                    <th>Employee Name</th>
                                    <td><?= $empData[0]->users_first_name; ?> <?= $empData[0]->users_last_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Branch</th>
                                    <td><?= $empData[0]->branch_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td><?= $empData[0]->dept_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Call Logged Via</th>
                                    <td><?= $ticketData[0]->call_logged_via; ?></td>
                                </tr>
                                <tr>
                                    <th>Details of call</th>
                                    <td><?= $ticketData[0]->details_of_call; ?></td>
                                </tr>
                                <?php if ($ticketData[0]->dateTime) { ?>
                                    <tr>
                                        <th>Call date Time</th>
                                        <td><?= $ticketData[0]->dateTime; ?></td>
                                    </tr>
                                <?php }
                                if ($ticketData[0]->call_assigned_time) { ?>
                                    <tr>
                                        <th>Call assigned time</th>
                                        <td><?= $ticketData[0]->call_assigned_time; ?></td>
                                    </tr>
                                <?php }
                                if ($ticketData[0]->call_closed_time) { ?>
                                    <tr>
                                        <th>Call closed time</th>
                                        <td><?= $ticketData[0]->call_closed_time; ?></td>
                                    </tr>
                                <?php }
                                if ($ticketData[0]->resolution_details) { ?>
                                    <tr>
                                        <th>Resolution Details</th>
                                        <td><?= $ticketData[0]->resolution_details; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th>Remarks</th>
                                    <td><?= $ticketData[0]->remarks; ?></td>
                                </tr>
                                <tr>
                                    <th>Comments</th>
                                    <td><?= $ticketData[0]->comment; ?></td>
                                </tr>
                                <?php if ($ticketData[0]->system_number_tag) { ?>
                                    <tr>
                                        <th>System Number / Tag</th>
                                        <td><?= $ticketData[0]->system_number_tag; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th>Status</th>
                                    <td><?= $ticketData[0]->status; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

    <?php
    if(!empty($ticketDataHistory)){ ?>
        <section class="content-header">
            <h1>View Ticket History</h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header"></div>
                        <div class="box-body">
                            <div class="col-sm-12">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>It Admin</th>
                                        <th>Status</th>
                                        <th>Ticket time</th>
                                        <th>Ticket date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($ticketDataHistory as $ticketDataHist) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $ticketDataHist->first_name . " " . $ticketDataHist->last_name; ?></td>
                                            <td><?php echo $ticketDataHist->status; ?></td>
                                            <td><?php echo $ticketDataHist->ticket_time; ?></td>
                                            <td><?php echo $ticketDataHist->ticket_date; ?></td>
                                        </tr>
                                        <?php $i++;
                                    }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>It Admin</th>
                                        <th>Status</th>
                                        <th>Ticket time</th>
                                        <th>Ticket date</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

    <!-- /.content -->
</div><!-- /.content-wrapper -->





