<?php $this->session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <?php echo view('includes/common_css_js');?>
  <meta charset="utf-8" />
  <title>Invoice payment report | <?php echo TITLE; ?></title>
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
              <h4 class="fs-18 fw-semibold m-0">Invoice payment report<span class="text-muted"></span></h4>
            </div>
            <div class="text-end">
              <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>"> Home /</a></li>
                <li class="breadcrumb-item">Reports /</li>
                <li class="breadcrumb-item active">Invoice payment report</li>
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
                            <form name="frm" id="frm" method="POST">
                              <div class="row">                              
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><select name="comp_name" id="comp_name" class="form-control"><option value="">--Company Name--</option>
                                <?php
                                foreach($company_list as $comp){
                                  ?>
                                  <option value="<?=$comp['RetCode']?>"><?=$comp['RetName']?></option>
                                  <?php
                                }
                                ?>
                              </select></div>
                              
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                <input type="text" placeholder="Bill From Date" class="form-control pull-right" name="fromDate" id="fromDate" readonly>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                <input type="text" placeholder="Bill To Date" class="form-control pull-right" name="toDate" id="toDate" readonly>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
                                <select name="membership_bill" id="membership_bill" class="form-control">
                                  <option value="">--All Bills--</option>
                                  <option value="1">Membership Bills</option>
                                  <option value="0">Other Bills</option>
                                </select>
                              </div>
                              </div>
                              <div class="row justify-content-end">      
                              <div class="col-lg-3 col-md-2 col-sm-6 col-xs-6 mt-2">
                                <button class="btn btn-secondary pull-right" type="submit" id="LoadRecordsButton" ><i class="fa fa-search"></i></button>
                                <button class="btn btn-danger mx-1"  id="Reset"  onclick="document.getElementById('frm').reset();">Reset</button>&nbsp;&nbsp;
                                <button class="btn btn-success" id="Excel" onclick="submit_form();">Excel</button>
                              </div>          
                            </div>
                          </form>
                        </div>
                      </div>
                      <br>
                      <div class="" id="inv_payment_details">
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
            <!-- ./wrapper -->
          </div> 
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

    $(function() {
      $( "#fromDate" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'dd-mm-yy'});
      $( "#toDate" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'dd-mm-yy'});
    });
    var ROWNUMBER = 0;
    $('#inv_payment_details').jtable({
      title: '&nbsp;',
    selecting: true, // Enable selecting
    multiselect: true, // Allow multiple selecting
    selectOnRowClick: true, // Enable this to only select using checkboxes
    paging: true,
    pageSize: 10,
    sorting: true,
    defaultSorting: 'RetName ASC',
    actions: {
      <?php if($this->common_model->check_user_permission('Generate Bill','BillListing')): ?>
        listAction: '<?=base_url()?>reports/masters/inv_data_op/list'
      <?php endif; ?>
    },
    toolbar: {
      <?php if($this->common_model->check_user_permission('Generate Bill','PrintBill')): ?>
        items: [{
          icon: '<?=base_url()?>img/print.png',
          text: 'Print',
          cssClass: 'btn btn-default',
          click: function () {
                // Perform your custom job...
            if ($('#comp_name').val() == "") $('#RetCode').val(''); 
            console.log("Company Name:", $('#comp_name').val());
            console.log("Plant ID:", $('#plant_name').val());
            console.log("Work Order:", $('#work_order').val());
            console.log("From Date:", $('#fromDate').val());
            console.log("To Date:", $('#toDate').val());
            console.log("Invoice No:", $('#invoice_no').val());
            console.log("Membership Bill:", $('#membership_bill').val());

            var url = "<?=base_url();?>reports/masters/sales_list?r=" + 
            encodeURIComponent($('#comp_name').val()) + 
            "&plant_id=" + encodeURIComponent($('#plant_name').val()) + 
            "&work_order=" + encodeURIComponent($('#work_order').val()) + 
            "&df=" + encodeURIComponent($('#fromDate').val()) + 
            "&dt=" + encodeURIComponent($('#toDate').val()) + 
            "&invoice_no=" + encodeURIComponent($('#invoice_no').val()) + 
            "&membership_bill=" + encodeURIComponent($('#membership_bill').val());

                console.log("Generated URL:", url); // Debugging: log the generated URL

                window.open(url, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=50");
              }
            }]
      <?php endif; ?>
    },
    fields: {
      BillNo: {key: true, create: false, edit: false, list: true, title: 'BILL NO', width: '5%', visibility: 'hidden'},
      sr_no: {title: 'SR NO', type: 'number', width: '2%'},
        RetName: {title: 'COMPANY NAME', type: 'text', width: '12%'}, // Ensure type is correct
        total_amt: {title: 'INVOICE AMOUNT', type: 'number', width: '5%'},
        collected_amt: {title: 'RECEIVED AMOUNT', type: 'number', width: '5%'},
        pending_amt: {title: 'PENDING AMOUNT', type: 'number', width: '5%'}
      }
    });
    $('#LoadRecordsButton').click(function (e) {
     e.preventDefault();

     $('#inv_payment_details').jtable('load', {
       invoice_no: $('#invoice_no').val(),
       toDate: $('#toDate').val(),
       fromDate: $('#fromDate').val(),
       membership_bill: $('#membership_bill').val(),
       plant_name:$('#plant_name').val(),
       work_order:$('#work_order').val(),
       comp_name:$('#comp_name').val(),

     });

   });   

        //Load all records when page is first shown
    $('#LoadRecordsButton').click();

  });
  function submit_form(){
    document.getElementById("frm").action="<?=base_url('reports/masters/companywise_invoice_data_excel')?>";

  }
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
</script>

</body>

<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:42:31 GMT -->
</html>