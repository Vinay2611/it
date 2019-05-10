<?php
/**
 * Created by PhpStorm.
 * User: vinayj
 * Date: 19-10-2018
 * Time: 15:37
 */

?>

<script type="text/javascript">
    $(function () {
        $('#fromDate').datetimepicker({
            locale: 'nl',
            format: 'DD-MM-YYYY'
        });
        $('#toDate').datetimepicker({
            locale: 'nl',
            format: 'DD-MM-YYYY',
            useCurrent: false //Important! See issue #1075
        });
        $("#fromDate").on("dp.change", function (e) {
            $('#toDate').data("DateTimePicker").minDate(e.date);
        });
        $("#toDate").on("dp.change", function (e) {
            $('#fromDate').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>

<style>
    #cnt1 {
        background-color: rgba(215, 212, 212, 0.88);
        margin-bottom: 70px;
    }

    #panel1 {
        padding:20px;
    }

    .panel-body:not(.two-col) {
        padding: 0px;
    }

    .panel-body .radio, .panel-body .checkbox {
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .panel-body .list-group {
        margin-bottom: 0;
    }

    .margin-bottom-none {
        margin-bottom: 0;
    }
    .col-md-3 {
        width: 28%;
    }
</style>

<div class="content-wrapper">
    <!--Header content-->
    <section class="content-header">
        <h1> By Engineer </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">It report</li>
        </ol>
    </section>
    <!--Main content-->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php //echo "It Report"; ?>
                <div class="box">
                    <div class="box-header"></div>
                    <div class="box-body">
                        <div class="col-md-12" id="panel">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 style="margin-top: 10px;"><span class="fa fa-file-excel-o fa-4"></span>  Download Report</h3>
                                </div>
                                <form action="itreportbyengineer/it_report_engineer_v" method="post">
                                    <!--panel body-->
                                    <div class="panel-body two-col">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="well well-sm">
                                                    <div class="container">

                                                        <div class='col-md-3'>
                                                            <label for="">User Name</label>
                                                            <select name="it_admin_id" id="it_admin_id" class="form-control">
                                                                <option value="">Select</option>
                                                                <?php echo $itadminDropDown;?>
                                                            </select>
                                                        </div>


                                                        <div class='col-md-3'>
                                                            <label for="">From date</label>
                                                            <div class="form-group">
                                                                <div class='input-group date' id='fromDate'>
                                                                    <input type='text' class="form-control" autocomplete="off" name="from_date" required/>
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class='col-md-3'>
                                                            <label for="">To date</label>
                                                            <div class="form-group">
                                                                <div class='input-group date' id='toDate'>
                                                                    <input type='text' class="form-control" autocomplete="off" name="to_date" required/>
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class='col-md-8'>
                                                            <input type="submit" name="submit" value="Submit" class="btn btn-success btn-sm btn-block" style="width: 30%;margin-bottom: 8px;">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--panel footer-->
                                    <!--<div class="panel-footer">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="submit" name="submit" value="Submit" class="btn btn-success btn-sm btn-block">
                                            </div>
                                        </div>
                                    </div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>