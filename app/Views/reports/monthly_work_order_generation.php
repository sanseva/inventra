<?php $this->session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <?php echo view('includes/common_css_js');?>
  <meta charset="utf-8" />
  <title>Monthly work order generation report | <?php echo TITLE; ?></title>
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
  <!-- select 2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

  <style type="text/css">
    .breadcrumb-item + .breadcrumb-item::before {
      content: none;
    }
  </style>
</head>

<!-- body start -->
<body data-menu-color="light" data-sidebar="default" class="hold-transition <?=$this->session->get('theme');?> sidebar-mini">

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
              <h4 class="fs-18 fw-semibold m-0">Monthly work order generation report<span class="text-muted"> </span></h4>
            </div>
            <div class="text-end">
              <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>"> Home /</a></li>
                <li class="breadcrumb-item">Reports /</li>
                <li class="breadcrumb-item active">Monthly work order generation report</li>
              </ol>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">

                  <!-- Main content -->
                  <section class="content">
                    <div class="box">
                      <!-- /.box-header -->
                      <div class="box-body" >
                        <div class="box-tools">
                          <div class="row clearfix">
                            <form class="form-group" name="frm" id="frm" method="POST">

                              <div class="row my-3">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                  <select class="form-control" name="month" id="month"><option value=''>--Select Month--</option>
                                    <option value="01" <?php if($current_month=='01'){echo 'selected';}?>>Jan</option>
                                    <option value="02" <?php if($current_month=='02'){echo 'selected';}?>>Feb</option>
                                    <option value="03" <?php if($current_month=='03'){echo 'selected';}?>>Mar</option>
                                    <option value="04" <?php if($current_month=='04'){echo 'selected';}?>>April</option>
                                    <option value="05" <?php if($current_month=='05'){echo 'selected';}?>>May</option>
                                    <option value="06" <?php if($current_month=='06'){echo 'selected';}?>>Jun</option>
                                    <option value="07" <?php if($current_month=='07'){echo 'selected';}?>>July</option>
                                    <option value="08" <?php if($current_month=='08'){echo 'selected';}?>>Aug</option>
                                    <option value="09" <?php if($current_month=='09'){echo 'selected';}?>>Sept</option>
                                    <option value="10" <?php if($current_month=='10'){echo 'selected';}?>>Oct</option>
                                    <option value="11" <?php if($current_month=='11'){echo 'selected';}?>>Nov</option>
                                    <option value="12" <?php if($current_month=='12'){echo 'selected';}?>>Dec</option>

                                  </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                  <select name="company_name" id="company_name" class="form-control">
                                    <option value="">--Company Name--</option>
                                    <?php foreach($sales_list as $comp): ?>
                                      <option value="<?=$comp['RetCode']?>"><?=$comp['RetName']?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
                                  <select name="plant_name" id="plant_name" class="form-control">
                                    <option value="">--Plant Name--</option>
                                  </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><select name="wo_no" id="wo_no" class="form-control"><option value="">--Work Order--</option></select> </div>
                              </div>
                              <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <input type="text" placeholder="From Date" class="form-control" name="fromDate" id="fromDate" readonly />
                                    <span class="todatevalid" style="display:none;">Please Enter From Date
                                    </span>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <input type="text" placeholder="To Date" class="form-control" name="toDate" id="toDate" readonly />
                                    <span class='valid' style='display:none;'>Please Enter To Date</span>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                    <input type="text" placeholder="Location" class="form-control" name="loc" id="loc">
                                  </div>
                                   <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                  <select name="wo_type" id="wo_type" class="form-control">
                                    <option value="">--WO Type--</option>
                                    <option value="A">Amount Wise</option><option value="Q">Quantity Wise</option>
                                  </select> </div>
                                </div>
                                <div class="row justify-content-end align-items-center" style="margin-right: -5px;">
                                  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 mt-2 mx-1">
                                    <button class="btn btn-secondary mx-1" type="submit" id="LoadRecordsButton"><i class="fa fa-search"></i></button>
                                     <button class="btn btn-danger clear-btn mx-1" id="ClearButtonMWO">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    <button class="btn btn-success" id="Excel" onclick="submit_form();">Excel</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <br>
                          <div class="table-responsive" id="work_order">
                          </div>
                        </div>
                        <input type="hidden" id="SelectedRowList" name="SelectedRowList"/>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                      

                    </section>
                    <!-- /.content -->
                  </div>
                  <!-- /.content-wrapper -->
                </div>
              </div> 
            </div>

            <!-- start row -->
            <div class="row">



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
    <!-- <script src="<?= base_url();?>assets/libs/jquery/jquery.min.js"></script> -->
    <script src="<?= base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url();?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url();?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url();?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="<?= base_url();?>assets/libs/feather-icons/feather.min.js"></script>

    <!-- Apexcharts JS -->
    <!-- <script src="<?= base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script> -->

    <!-- Widgets Init Js -->
    <script src="<?= base_url();?>assets/js/pages/crm-dashboard.init.js"></script>

    <!-- App js-->
    <script src="<?= base_url();?>assets/js/app.js"></script>

    <script type="text/javascript">
      $(document).ready(function () {

        $('#company_name').select2({
            placeholder: "Company Name",
            allowClear: true,
            minimumInputLength: 3
        });

        $(function() {
          $( "#fromDate" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'dd/mm/yy'});
          $( "#toDate" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'dd/mm/yy'});
        });
        var ROWNUMBER = 0;
        $('#work_order').jtable({
      selecting: true, //Enable selecting
      multiselect: true, //Allow multiple selecting
      selectingCheckboxes: true, //Show checkboxes on first column
      selectOnRowClick: true, //Enable this to only select using checkboxes
      paging: false,
      pageSize: 10,
      sorting: true,
      defaultSorting: 'id DESC',
      actions: {

        listAction: '<?=base_url()?>reports/monthly_work_order_generation/m_wo_op/list',

      },


      fields: {
      //if(data.record.bill_raised_current_month!=0){

        id: {key: true,create: false,edit: false,list: true,title: 'BILL NO', width: '5%',visibility :'hidden'},
        wo_no: {  title: 'WO No.', width: '5%'},
        wo_type :{ title:'WO Type',width: '5%',display: function (data) {
          if(data.record.wo_type === 'Q'){
            var $type = '<b>Quantity Wise </b><br/>('+data.record.descryption+')';
          }else{
            var $type = '<b>Amount Wise </b><br/>('+data.record.descryption+')';
          }
          


          //  $("#work_order tr:nth-child(1)").hide();
          return $type;

        }},
        from_date: {  title: 'From Date', width: '5%'},
        to_date: {  title: 'To Date',type:'number'},
        RetName: {  title: 'Company',type:'number'},
        name: { title: 'Plant',type:'number', width: '5%',},
        location: { title: 'Location',width: '5%',},
        quantity: { title: 'Total Qty',type:'number', width: '5%',},
        bill_raised_current_month: {  title: 'Monthly Pending Bill',type:'number', width: '5%',},
        
        
      },


    //Validate form when it is being submitted
      formCreated: function (event, data) {

        data.form.find('input[name="month"]').addClass('validate[required]');
        data.form.validationEngine();
      },
      //Validate form when it is being submitted
      formSubmitting: function (event, data) {
        return data.form.validationEngine('validate');
      },
      //Dispose validation logic when form is closed
      formClosed: function (event, data) {
        data.form.validationEngine('hide');
        data.form.validationEngine('detach');
      }


    });
        $('#LoadRecordsButton').click(function (e) {
         e.preventDefault();
         $("#frm").validate({
           rules:{
             month:'required'
           }
         });
         if($("#frm").valid()){
           $('#work_order').jtable('load', {
             month: $('#month').val(),
             wo_no: $('#wo_no').val(),
             wo_type: $('#wo_type').val(),
             company_name: $('#company_name').val(),
             plant_name: $('#plant_name').val(),
             loc: $('#loc').val(),
             from_date: $('#fromDate').val(),
             to_date: $('#toDate').val(),

           });
         }
       });   

        //Load all records when page is first shown
        $('#LoadRecordsButton').click();
        $('select#company_name').change(function (event) 
        {

          $('#plant_name').val('');
          $('#plant_name').trigger('change.select');
          loadlist($('select#plant_name').get(0),'<?=base_url();?>masters/work_order/ajax_get_work_order_plant/'+$('#company_name').val()+'','name','pl_id','-- Select Plant --','');
        });
        $('#plant_name').change(function (event) 
        {

          $('#wo_no').val('');
          $('#wo_no').trigger('change.select');
          loadlist($('select#wo_no').get(0),'<?=base_url();?>masters/work_order/ajax_get_plantwise_work_order/'+$('#plant_name').val()+'','wo_order','id','-- Select Work Order --','');
        });

      });
      function loadlist(selobj,url,nameattr,valueattr,selecthtml,selectedattr)
      {

        $(selobj).empty();
        $(selobj).append($('<option></option>').val('').html(selecthtml));
        $.getJSON(url,{},function(data)
        {
          $.each(data, function(i,obj)
          {
          /* alert(selectedattr);
          alert(valueattr); */
            if(selectedattr==obj[valueattr]){
              $(selobj).append($('<option selected></option>').val(obj[valueattr]).html(obj[nameattr]));
            }else{
              $(selobj).append($('<option></option>').val(obj[valueattr]).html(obj[nameattr]));
            }
          });
        });
      }
      function submit_form(){
        document.getElementById("frm").action="<?=base_url('reports/monthly_work_order_generation/get_excel')?>";

      }
      $('#ClearButtonMWO').on('click', function() {
     $('month').val('');
     $('company_name').val('');
     $('plant_name').val('');
     $('wo_no').val('');
     $('fromDate').val('');
     $('toDate').val('');
     $('loc').val('');
     $('wo_type').val('');

});

    </script>
  </body>

  <!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:42:31 GMT -->
  </html>