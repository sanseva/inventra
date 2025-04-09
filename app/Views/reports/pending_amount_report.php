<?php $this->session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <?php echo view('includes/common_css_js');?>
  <meta charset="utf-8" />
  <title><?=$title?> | <?php echo TITLE; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
  <meta name="author" content="Zoyothemes"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?= base_url();?>assets/images/favicon.ico">

  <!-- App css -->
  <link href="<?= base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

  <!-- Icons -->
  <link href="<?= base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<!-- body start -->
<body data-menu-color="light" data-sidebar="default">

  <!-- Begin page -->
  <div id="app-layout">


    <!-- Topbar Start -->
    <?php echo view('includes/header');?>
    <!-- end Topbar -->

    <!-- Left Sidebar Start -->
    <?php echo view('includes/left');?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
      <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
          <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
              <h4 class="fs-18 fw-semibold m-0"><?=$title?><span class="text-muted"> </span></h4>
            </div>
            <div class="text-end">
              <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>"> Home /</a></li>
                <li class="breadcrumb-item">Reports /</li>
                <li class="breadcrumb-item active"><?=$title?></li>
              </ol>
            </div>
          </div>
          <!-- Content Wrapper. Contains page content -->
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <!-- Main content -->
                <section class="content">
                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body" >
                      <div class="box-tools">
                        <div class="row clearfix">
                          <form name="frm" id="frm" method="POST">
                            <div class="row">
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" > <input type="text" placeholder="Customer/Retailer" class="form-control pull-right" name="RetName" id="RetName"> <input type="hidden" name="RetCode" id="RetCode"></div>


                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" ><input type="text" placeholder="Plant Name" class="form-control" name="plant_name" id="plant_name"></div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" ><select class="form-control" name="membership_bill" id="membership_bill" onchange="membership(this.value);">
                                <option value='0'>Other</option>
                                <option value='1'>Membership</option>
                              </select></div>
                              
                              

                              <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                <div class="d-flex justify-content-between">
                                  <button class="btn btn-secondary mx-1" id="LoadRecordsButton"><i class="fa fa-search"></i></button>
                                  <button class="btn btn-danger clear-btn mx-1" id="ClearButtonPR">
                                            <i class="fa fa-times"></i>
                                        </button>
                                  <button class="btn btn-success mx-1" id="Excel" onclick="submit_form();">Excel</button>
                                </div>
                              </div>

                            </div>
                          </form>
                        </div>
                      </div>
                      <br>
                      <div class="" id="company_table"  style="margin-top:1%;">

                      </div>
                    </div>
                    <input type="hidden" id="SelectedRowList" name="SelectedRowList"/>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->


                </section>
                <!-- /.content -->
              </div>
            </div>
          </div>
          <!-- /.content-wrapper -->
          <!-- ./wrapper -->
        </div>
        <!-- end start -->

      </div> <!-- container-fluid -->
    </div> <!-- content -->

    <!-- Footer Start -->
    <?php echo view('includes/footer');?>
    <!-- end Footer -->

  </div>
  <!-- ============================================================== -->
  <!-- End Page content -->
  <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Vendor -->
<!-- <script src="< ?= base_url();?>assets/libs/jquery/jquery.min.js"></script> -->
<script src="<?= base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url();?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url();?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?= base_url();?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
<script src="<?= base_url();?>assets/libs/feather-icons/feather.min.js"></script>

<!-- App js-->
<script src="<?= base_url();?>assets/js/app.js"></script>

<script type="text/javascript">

  $(document).ready(function () {

   $.ajax({
    url:"<?=base_url()?>reports/masters/pending",
    type:"post",
    data:{"retailer":$("#RetCode").val(),"plant":$("#plant_name").val(),"membership_bill":$("#membership_bill").val()},
    dataType:"json",
    success: function(data)
    {
      var i;
      var retname='';
      var plant='';
      var amt='';
      if(data.result){
        var i=0;
        var html="<table class='table table-bordered table-responsive' id='tab'><th>Sr</th><th>Company Name</th><th>Plant Name</th><th>Pending Amount</th>";
        $.each( data.result, function( key, value ) {
          i++;
          if(value['retname']!=null){
           retname =value['retname'];
         }if(value['plant']!=null){
           plant =value['plant'];
         }
         if(value['collected']!=null){

           amt =parseFloat(value['Net'])-parseFloat(value['collected']);
         }else{
          amt=value['Net'];
        }
        if(amt ==0 || amt<0){

        }else{
          html+='<tr><td>'+i+'</td><td>'+retname+'</td><td>'+plant+'</td><td>'+amt+'</td></tr>';
        }
      });
        html+='</table>';
        $("#company_table").html(html);
      }
    }

  }); 



   $("#LoadRecordsButton").click(function(e){
    e.preventDefault();
    $.ajax({
      url:"<?=base_url()?>reports/masters/pending",
      type:"post",
      data:{"retailer":$("#RetName").val(),"plant":$("#plant_name").val(),"membership_bill":$("#membership_bill").val()},
      dataType:"json",
      
      success: function(data)
      {
        var i;
        var retname='';
        var plant='';
        var amt='';
        if(data.result){
          var i=0;
          var html="<table class='table table-bordered table-responsive'><th>Sr</th><th>Company Name</th><th>Plant Name</th><th>Pending Amount</th>";
          $.each( data.result, function( key, value ) {
            i++;
            if(value['retname']!=null){
             retname =value['retname'];
           }if(value['plant']!=null){
             plant =value['plant'];
           }
           if(value['Net']!=null){
             amt =value['Net'];
           }
           if(value['collected']!=null){

             amt =parseFloat(value['Net'])-parseFloat(value['collected']);
           }else{
            amt=value['Net'];
          }
          if(amt==0 || amt<0){

          }else{
            html+='<tr><td>'+i+'</td><td>'+retname+'</td><td>'+plant+'</td><td>'+amt+'</td></tr>';
          }

        });
          html+='</table>';
          $("#company_table").html(html);
        }
      }
      
    }); 

  });

 });
  function submit_form(){
    document.getElementById("frm").action="<?=base_url()?>reports/masters/get_excel";
  }
  function membership(val){
    var member;
    if(val==0){
      member = 'other';
    }else{
      member ='membership';
    }
    $.ajax({
      url:"<?=base_url()?>reports/masters/pending",
      type:"post",
      data:{"membership":member,"retailer":$("#RetName").val(),"plant":$("#plant_name").val(),"membership_bill":$("#membership_bill").val()},
      dataType:"json",
      success: function(data)
      {
        var i;
        var retname='';
        var plant='';
        var amt='';
        if(data.result){
          var i=0;
          var html="<table class='table table-bordered table-responsive' id='tab'><th>Sr</th><th>Company Name</th><th>Plant Name</th><th>Pending Amount</th>";
          $.each( data.result, function( key, value ) {
            i++;
            if(value['retname']!=null){
             retname =value['retname'];
           }if(value['plant']!=null){
             plant =value['plant'];
           }
           if(value['collected']!=null){

             amt =parseFloat(value['Net'])-parseFloat(value['collected']);
           }else{
            amt=value['Net'];
          }
          if(amt==0 || amt<0){

          }else{
            html+='<tr><td>'+i+'</td><td>'+retname+'</td><td>'+plant+'</td><td>'+amt+'</td></tr>';
          }
        });
          html+='</table>';
          $("#company_table").html(html);
        }
      }

    }); 
    
  }
  $("#RetName").mcautocomplete({

    showHeader: true,
    columns: [{
      name: 'ID',
      width: '80px',
      valueField: 'RetCode'
    }, 
    {
      name: 'Retailer Name',
      width: '350px',
      valueField: 'RetName'
    }, {
      name: 'DL NO',
      width: '200px',
      valueField: 'RetLcNo'
    },{
      name: 'Discount',
      width: '60px',
      valueField: 'discount'
    }, {
      name: 'address',
      width: '220px',
      valueField: 'RetAdderss'
    }],

        // Event handler for when a list item is selected.
    select: function (event, ui) {
      this.value = (ui.item ? ui.item.RetName : '');
      $('#RetName').val(ui.item.RetName);
      $('#RetCode').val(ui.item.RetCode);
      $('#BillDate').focus();
      return false;

    },

        // The rest of the options are for configuring the ajax webservice call.
    minLength: 1,
    source: function (request, response) {
      $.ajax({
        url: '<?=base_url();?>sales/retailers',
        dataType: "json",
        data: { searchText: request.term, maxResults: 100 },

                // The success event handler will display "No match found" if no items are returned.
        success: function (data) {

          result = data;

          response(result);
        }
      });
    }
  }); 

$('#ClearButtonPR').on('click', function() {
   $('RetCode').val('');
   $('plant_name').val('');
   $('membership_bill').val('');

});
</script>

</body>

<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:42:31 GMT -->
</html>