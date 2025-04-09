<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GST ASSESMENT</title>
  
  	 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Purchase</title>
 <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url();?>js/jquery-ui-1.12.0/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url();?>css/tautocomplete.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>css/skins/_all-skins.min.css">

  <!--[if lt IE 9]>
  <script src="<?=base_url();?>js/html5shiv.min.js"></script>
  <script src="<?=base_url();?>js/respond.min.js"></script>
  <![endif]--> 
  <!-- jQuery 2.2.0 -->
  <script src="<?=base_url();?>plugins/jQuery/jQuery-2.2.0.min.js"></script>
  <script src="<?=base_url();?>js/jquery-ui-1.11.2/jquery-ui.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url();?>plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url();?>/plugins/fastclick/fastclick.js"></script>
<script src="<?=base_url();?>js/jquery.validate.min.js"></script>


<script src="<?=base_url();?>js/app.min.js"></script>
</head>
<body class="hold-transition <?=$this->session->userdata('theme');?> sidebar-mini sidebar-collapse">
<!-- Site wrapper -->
<div class="wrapper">

  <?php $this->load->view('includes/header');?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php $this->load->view('includes/left');?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>GST ASSESMENT <small></small></h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url();?>home"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="active">GST ASSESMENT</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		 <div class="row">
		    <div class="col-md-12">
		    <form class="form-horizontal" id="frmStock" name="frmStock">
		         <div class="box">
		             <div class="box-header">
		           
		              
		               </div>
		              <div class="box-body">
		              
		              		<div class="form-group">
								<label for="work_status" class="col-sm-2 control-label">DATE FROM</label>
									<div class="col-sm-2"><input type="text" class="form-control" id="date_from" name="date_from" VALUE="" placeholder=""></div>
							
								<label for="work_status" class="col-sm-1 control-label">DATE TO</label>
									<div class="col-sm-2"><input type="text" class="form-control" id="date_to" name="date_to" VALUE="" placeholder=""></div>
							<div class="col-sm-4">
								<table class="table table-bordered">
								<tr>
									<td>#</td>
									<td>SGST</td>
									<td>CGST</td>
									<td>IGST</td>
								</tr>
								<tr>
									<td>PAID</td>
									<td><?=$psgst?></td>
									<td><?=$pcgst?></td>
									<td><?=$pigst?></td>
								</tr>
								<tr>	
									<td>COLLECTED</td>
									<td><?=$csgst?></td>
									<td><?=$ccgst?></td>
									<td><?=$cigst?></td>
								</tr>
								</table>
							</div>
						</div>
		              		
		              
		              
		              </div>
		              <div class="box-footer">
		              <a href="<?=base_url()?>help/Gst_help.pdf" target="_new"><i class="fa fa-book"></i> GST RETURN HELP DOCUMENT</a>
		              <a href="<?=base_url()?>help/OfflineTool.zip" target="_new"><i class="fa fa-book"></i> GST RETURN Office Tool</a>
		              </div>
		            
		        </div></form>
		    </div>
		    <?php if($this->session->userdata('packageType')=="D" || $this->session->userdata('packageType')=="A"){?>
		    <div class="col-md-12">
		  
		         <div class="box">
		             <div class="box-header  with-border">
		             	<h3 class="box-title">Goods and Services Tax, Invoice & other  data  upload for creation of GSTR 1</h3>
		             </div>
		              <div class="box-body">
		              <div class="col-md-4">
		             	 <p>Details of invoices of Taxable supplies made to other registered taxpayers</p>
		              	<button name="b2b" id="b2b">B2B Suppliers</button>
		              	<button name="b2b_excel" id="b2b_excel">B2B Suppliers EXCEL</button>
		              </div>
		              <div class="col-md-4">
		             	 <p>Invoices for Taxable outward supplies to consumers where
							<ul>
							<li>a)The place of supply is outside the state where the supplier is registered and</li>
							<li>b)The total invoice value is more that Rs 2,50,000</li>
							</ul>
							</p>
		              	<button name="B2CL" id="B2CL">B2C Large</button>
		              </div>
		              <div class="col-md-4">
		             	 <p>Supplies made to consumers and unregistered persons of the following nature
							<ul>
							<li>a)Intra-State: any value</li>
							<li>b)Inter-State: Invoice value Rs 2.5 lakh or less</li>
							</ul>
							</p>
		              	<button name="B2CS" id="B2CS">B2C Small</button>
		              	<button name="b2cs_excel" id="b2cs_excel">B2CS Suppliers EXCEL</button>
		              </div>
		              		
		              		
		              
		              
		              </div>
		             
		        </div>
		    </div>
		    <?php 
		    }
		     if($this->session->userdata('packageType')=="R" || $this->session->userdata('packageType')=="A")
		     {
		    ?>
		    
		    <div class="col-md-12">
		  
		         <div class="box">
		             <div class="box-header  with-border">
		             	<h3 class="box-title">Goods and Services Tax, Invoice & other  data  upload for creation of GSTR 1</h3>
		             </div>
		              <div class="box-body">
		              <div class="col-md-4">
		             	 <p>Details of invoices of Taxable supplies made to other registered taxpayers</p>
		              	<button name="b2b_retail" id="b2b_retail">B2B Suppliers</button>
		              	<button name="b2b_excel_retail" id="b2b_excel_retail">B2B Suppliers EXCEL</button>
		              </div>
		              <div class="col-md-4">
		             	 <p>Invoices for Taxable outward supplies to consumers where
							<ul>
							<li>a)The place of supply is outside the state where the supplier is registered and</li>
							<li>b)The total invoice value is more that Rs 2,50,000</li>
							</ul>
							</p>
		              	<button name="B2CL_retail" id="B2CL_retail">B2C Large</button>
		              </div>
		              <div class="col-md-4">
		             	 <p>Supplies made to consumers and unregistered persons of the following nature
							<ul>
							<li>a)Intra-State: any value</li>
							<li>b)Inter-State: Invoice value Rs 2.5 lakh or less</li>
							</ul>
							</p>
		              	<button name="B2CS_retail" id="B2CS_retail">B2C Small</button>
		              	<button name="B2CS_retail_excel" id="B2CS_retail_excel">B2C Small EXCEL</button>
		              </div>
		              		
		              		
		              
		              
		              </div>
		             
		        </div>
		    </div>
		    
		    
		    <?php }?>
		    </div>
   
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
	
 <?php $this->load->view('includes/footer');?>

 
 
</div>
<!-- ./wrapper -->

<script src="<?=base_url();?>js/app.min.js"></script>
  <script>
  var BaseUrl='<?=base_url()?>';
  $(function() {
	  $( "#date_from" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'yy-mm-dd'});
	  $( "#date_to" ).datepicker( {changeMonth: true,changeYear: true,dateFormat:'yy-mm-dd'});
	
  });
  $('#b2b').click(function(e) 	{
	if(validate()){
		  window.open(BaseUrl+'gst/b2b/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
	}
  });
  $('#b2b_excel').click(function(e) 	{
	if(validate()){
		  window.open(BaseUrl+'gst/b2b_excel/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
	}
  });
  
  $('#B2CL').click(function(e) 	{
	if(validate()){
		  window.open(BaseUrl+'gst/b2cl/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
	}
  });
  $('#B2CS').click(function(e) 	{
	if(validate()){
		  window.open(BaseUrl+'gst/b2cs/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
	}
  });
  $('#b2cs_excel').click(function(e) 	{
	if(validate()){
		  window.open(BaseUrl+'gst/b2cs_excel/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
	}
  });
  //retail
  $('#b2b_retail').click(function(e) 	{
	  $('#b2b').click();
  });
  
  $('#b2b_excel_retail').click(function(e) 	{
	  $('#b2b_excel').click();
  });
  
  $('#B2CL_retail').click(function(e) 	{
	if(validate()){
		 // window.open(BaseUrl+'gst/b2cl_retail/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
		 alert('Under Construction');
	}
  });
  $('#B2CS_retail').click(function(e) 	{
	if(validate()){
		  window.open(BaseUrl+'gst/b2cs_retail/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
	}
  });
  $('#B2CS_retail_excel').click(function(e) 	{
	if(validate()){
		  window.open(BaseUrl+'gst/b2cs_retail_excel/'+$('#date_from').val()+'/'+$('#date_to').val(), "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
	}
  });

  function validate(){

  if($('#date_from').val()=="" && $('#date_to').val()=="")
	  {
	  	alert('Please select dates');
  		return false;
	  }
  else
  	return true;
	  
  }
	</script>

</body>
</html>
