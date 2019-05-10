<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php
                    echo isset($total_hold['total']) ? $total_hold['total']  : "0";
                  //    echo $total_hold['total'];
                  ?></h3>
                  <p>On Hold</p>
                </div>
                <div class="icon">
                  <i class="ion-android-walk"></i>
                </div>                
              </div>
              
              <div style="margin-top:75px; display:none;" class="table-responsive">
    <div class="list-group">
   <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Objective Setting</a> </div>
    <a style="cursor:default;" class="list-group-item" href="">
    <span class="glyphicon glyphicon-hand-up"></span> Pending <span class="badge">0</span>
    </a>
    <a style="cursor:default;" class="list-group-item" href="">
    <span class="glyphicon glyphicon-hand-right"></span> Partly Approved <span class="badge">0</span>
    </a>
        <a style="cursor:default;" class="list-group-item" href="">
            <span class="glyphicon glyphicon-thumbs-up"></span> Approved <span class="badge">0</span>
        </a>
        <a style="cursor:default;" class="list-group-item" href="">
            <span class="glyphicon glyphicon-thumbs-down"></span> Disapproved <span class="badge">0</span>
        </a>
    </div>
</div>
              
              
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php
                        echo isset($total_open['total']) ? $total_open['total']  : "0";
                        //echo $total_open['total'];
                        ?></h3>
                  <p>Open</p>
                </div>
                <div class="icon">
                  <i class="ion-android-bicycle"></i>
                </div>                
              </div>
              <div style="margin-top:75px;display:none;" class="table-responsive">
    <div class="list-group">
   <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Mid Term Review</a> </div>
    <a style="cursor:default;" class="list-group-item" href="">
    <span class="glyphicon glyphicon-hand-up"></span> Not Updated <span class="badge">0</span>
    </a>
    <a style="cursor:default;" class="list-group-item" href="">
    <span class="glyphicon glyphicon-hand-right"></span> Pending <span class="badge">0</span>
    </a>
     <a style="cursor:default;" class="list-group-item" href="">
     <span class="glyphicon glyphicon-thumbs-up"></span> Approved <span class="badge">0</span>
     </a>
    </div>
</div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php
                      echo isset($total_pending['total']) ? $total_pending['total']  : "0";
                      //echo $total_pending['total'];
                      ?></h3>
                  <p>Pending today</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-plus-outline"></i>
                </div>               
              </div>
              <div style="margin-top:75px;display:none;" class="table-responsive">
    <div class="list-group">
   <div><a style="cursor:default; font-weight:bold; font-size:15px;" class="list-group-item active">Annual Review</a> </div>
      <a style="cursor:default;" class="list-group-item" href="">
    <span class="glyphicon glyphicon-hand-up"></span> Not Updated <span class="badge">0</span>
    </a>
    <a style="cursor:default;" class="list-group-item" href="">
    <span class="glyphicon glyphicon-hand-up"></span> Pending <span class="badge">0</span>
    </a>  
    <a style="cursor:default;" class="list-group-item" href="">
    <span class="glyphicon glyphicon-hand-right"></span> Approved <span class="badge">0</span>
    </a>
    </div>
</div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php
                      echo isset($total_closed['total']) ? $total_closed['total']  : "0";
                      //echo $total_closed['total'];
                      ?></h3>
                  <p>Closed today</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-minus-outline"></i>
                </div>               
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
          
          <!-- Main row -->
        </section><!-- /.content -->
      </div>