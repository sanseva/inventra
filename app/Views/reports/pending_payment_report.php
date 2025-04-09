<?php $this->session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
  <?php echo view('includes/common_css_js');?>
  <meta charset="utf-8" />
  <title>Pending payment report | <?php echo TITLE; ?></title>
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
              <h4 class="fs-18 fw-semibold m-0">Pending payment report<span class="text-muted"></span></h4>
            </div>
            <div class="text-end">
              <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>"> Home /</a></li>
                <li class="breadcrumb-item">Reports /</li>
                <li class="breadcrumb-item active">Pending payment report</li>
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
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2" ><select name="comp_name" id="comp_name" class="form-control"><option value="">--Company Name--</option>
                                  <?php
                                  foreach($sales_list as $comp){
                                    ?>
                                    <option value="<?=$comp['RetCode']?>"><?=$comp['RetName']?></option>
                                    <?php
                                  }
                                  ?>
                                </select></div>
                                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2">
                                 <select name="plant_name" id="plant_name" class="form-control">
                                  <option value="">--Plant Name--</option>
                                </select>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2" ><select name="work_order" id="work_order" class="form-control"><option value="">--Work Order--</option></select> </div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2"> <input type="text" placeholder="Invoice No" class="form-control pull-right" name="invoice_no" id="invoice_no" ></div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2"><input type="text" placeholder="From Date" class="form-control  pull-right" name="fromDate" id="fromDate"  readonly></div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2"><input type="text" placeholder="To Date" class="form-control  pull-right" name="toDate" id="toDate" readonly ></div>
                              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mt-2"><select name="membership_bill" id="membership_bill" class="form-control"><option value="">--All Bills--</option><option value="1">Membership Bills</option><option value="0">Other Bills</option></select> </div>
                              <div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 mt-2"><button class="btn btn-secondary pull-right" type="submit" id="LoadRecordsButton" ><i class="fa fa-search"></i></button></div>          
                              <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 mt-2">
                                <button class="btn btn-danger "  id="Reset"  onclick="document.getElementById('frm').reset();">Reset</button>
                                <button class="btn btn-success" id="Excel" onclick="submit_form();">Excel</button>
                              </div>          
                            </form>
                          </div>
                        </div>
                        <br>
                        <div class="table-responsive" id="pending_payment">
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
              <!-- ./wrapper -->
            </div> 
          </div>

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

  <body class="hold-transition <?=$this->session->get('theme');?> sidebar-mini">

    <script type="text/javascript">
      $(document).ready(function () {

        $('#comp_name').select2({
            placeholder: "Company Name",
            allowClear: true,
            minimumInputLength: 3
        });

        $(function() {
          $( "#fromDate" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'dd-mm-yy'});
          $( "#toDate" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'dd-mm-yy'});
        });
        var ROWNUMBER = 0;
        $('#pending_payment').jtable({
          title: '&nbsp;',
        selecting: true, //Enable selecting
              multiselect: true, //Allow multiple selecting
              selectingCheckboxes: true, //Show checkboxes on first column
              selectOnRowClick: true, //Enable this to only select using checkboxes
              paging: true,
              pageSize: 10,
              sorting: true,
              defaultSorting: 'BillNo DESC',
              actions: {
                <?php 
                if($this->common_model->check_user_permission('Generate Bill','BillListing')){
                  ?>
                  listAction: '<?=base_url()?>reports/masters/p_bill_op/list'

                  <?php 
                }
                ?>

              },
              toolbar: {
                <?php if($this->common_model->check_user_permission('Generate Bill','PrintBill')){ ?>
                  items: [{
                    icon: '<?=base_url()?>img/print.png',
                    text: 'Print',
                    cssClass:'btn btn-default',
                    click: function () {
              //perform your custom job...
                      if( $('#comp_name').val()=="") $('#RetCode').val('') 
                        url="<?=base_url();?>reports/masters/sales_list?r="+$('#comp_name').val()+"&plant_id="+$('#plant_name').val()+"&work_order="+$('#work_order').val()+"&df="+$('#fromDate').val()+"&dt="+$('#toDate').val()+"&invoice_no="+$('#invoice_no').val()+"&membership_bill="+$('#membership_bill').val();
                      window.open(url, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=50,left=50");
                    }
                  },
                  ]
                <?php }?>
              },

              fields: {
                BillNo: {key: true,create: false,edit: false,list: true,title: 'BILL NO', width: '5%',visibility :'hidden'},
                invoice_no: { title: 'Inovice No', width: '5%'},
                billdate: { title: 'Bill Date', width: '15%'},
                RetName: {  title: 'Customer',type:'number',width:'12%'},
                Plant: {  title: 'Plant',width:'12%',display:function(data){
                  return plant = data.record.Plant +'-['+ data.record.plant_code +']';
                }
              },
              location: { title: 'Plant <br/>Location',width:'5%'},
              ItemName: { title: 'Item Desc',width:'100%',display: function (data) {
                var items = data.record.ItemName;
          //  alert(items);
                if(items!=null){

              /* var datas = items.split(',');
              
              var i=1;
              //console.log(datas[0]);
              var n = datas[0].length;
              if(n>50){
                var dots = "...";
              }else{
                var dots="";
              }
              string = '<a href="#" title="'+datas[0]+'" style="color:black;"> 1. '+datas[0].substring(0,50) + dots+'</a>';
              $.each(datas, function (index, value) {
                 if(datas[i]!=undefined){
                 
                  var v = value.split('||');
                  var m = datas[i].length;
                  if(m>50){
                    var dots = "...";
                  }else{
                    var dots="";
                  }
                  string +='<br/><a href="#" title="'+datas[i]+'" style="color:black;">'+(i+1) +' . '+ datas[i].substring(0,50) + dots +'</a>';
                  
                  
                }  
                //console.log(i);
              i++;
              });
              return string; */
                  var string='';
                  var datas = items.split('$$');
                  var cnt = 1;
                  $.each(datas, function (index, value) {
                    var i=0;
                //alert(value);
                    var split_data=value.split('||');
                    if(split_data[0]){
                      var n = split_data[0].length;
                      if(n>50){
                        var dots = "...";
                      }else{
                        var dots="";
                      }
                      var m = datas[i].length;
                      string+= '<a href="#" title="'+split_data[0]+'" style="color:black;"> <b>'+cnt+'</b>. '+split_data[0].substring(0,50) + dots+'</a>';
                      i++;
                      cnt++;
                }//if(split_data[1]){

                  if(split_data[1]=='Q'){
                    string+= ' &nbsp<b>Qty [' +split_data[2] +']   Rate  [ '+split_data[3]+' ]</b>';
                  }else if(split_data[1]=='A'){
                    string+= '<br/> <b>Amt [' +split_data[2] +' ] Rate [ '+split_data[3]+']</b>';
                  }else{
                    string+= '<br/> <b>Percentage [' +split_data[4] +' ] Rate [ '+split_data[3]+']</b>';
                  }
                  
              //  }

                  string+='<br/>'; 
                });
                  return string;

                }
              }
            },
          //GrossAmount: {  title: 'GROSS',type:'number', width: '5%',},
            total_amt: {  title: 'NET',type:'number', width: '5%',},
            collected_amt: {  title: 'Received <br/>Amount',type:'number', width: '5%',},
            date_of_receive_amt: {  title: 'Date Of <br/>Received Amount',type:'number', width: '5%',},

          } 
        });
$('#LoadRecordsButton').click(function (e) {
 e.preventDefault();
 $('#pending_payment').jtable('load', {
          //  BillNo: $('#BillNo').val(),
   invoice_no: $('#invoice_no').val(),
   toDate: $('#toDate').val(),
   fromDate: $('#fromDate').val(),
   membership_bill: $('#membership_bill').val(),
   plant_name:$('#plant_name').val(),
   work_order:$('#work_order').val(),
   comp_name:$('#comp_name').val()

 });
});   

        //Load all records when page is first shown
$('#LoadRecordsButton').click();
$('select#comp_name').change(function (event) 
{

  $('#plant_name').val('');
  $('#plant_name').trigger('change.select');
  loadlist($('select#plant_name').get(0),'<?=base_url();?>masters/work_order/ajax_get_work_order_plant/'+$('#comp_name').val()+'','name','pl_id','-- Select Plant --','');
});
$('#plant_name').change(function (event) 
{

  $('#work_order').val('');
  $('#work_order').trigger('change.select');
  loadlist($('select#work_order').get(0),'<?=base_url();?>masters/work_order/ajax_get_plantwise_work_order/'+$('#plant_name').val()+'','wo_order','id','-- Select Work Order --','');
});

});
function submit_form(){
  document.getElementById("frm").action="<?=base_url('reports/masters/pending_payment_excel')?>";

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
<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:42:31 GMT -->
</html>