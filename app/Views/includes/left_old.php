<?php
$this->session = \Config\Services::session();
$this->common_model = model('Common_model');
$user_type = $this->session->get('user_type');
$user_id = $this->session->get('user_id');
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url();?>img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->get('user_name');?></p>
         
        </div>
      </div>
         <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
          <li class="treeview">
          <a href="#">
           <i class="fa fa-list-alt"></i>
            <span>Masters</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
		  <?php if($user_type == 'A'){
		  	
					if($this->common_model->check_user_permission('Organization','OrganizationListing')){
			?>
            <li><a href="<?=base_url();?>organization"><i class="fa fa-circle-o"></i> Organization</a></li>
		  <?php
				}
		  }?>
         <!--   <li><a href="<?=base_url();?>masters/unites"><i class="fa fa-circle-o"></i> Unit Information</a></li>-->
          <!--  <li><a href="<?=base_url();?>masters/bank"><i class="fa fa-circle-o"></i> Bank Information</a></li> -->
        <!--    <li><a href="<?=base_url();?>masters/supplier"><i class="fa fa-circle-o"></i> Supplier/Vendor Information</a></li>-->
            <?php //if($this->session->get('packageType')=="D" || $this->session->get('packageType')=="A"){?>
			<?php if($this->common_model->check_user_permission('Vendor','VendorListing')){?>
				<li><a href="<?=base_url();?>masters/retailers"><i class="fa fa-circle-o"></i> Add Vendor/Company</a></li>
			<?php
			}
			?>
			<?php if($this->common_model->check_user_permission('vendor plant','VendorPlantListing')){?>
				<li><a href="<?=base_url();?>masters/vendor_plant"><i class="fa fa-circle-o"></i> Add Vendor/Company Plant</a></li>
			<?php
			}
			?>
			
			<?php if($this->common_model->check_user_permission('Work Order','WorkOrderListing')){ 
			if($user_type == "A" or $user_type == "U"){ ?>	
				<li><a href="<?=base_url();?>masters/work_order"><i class="fa fa-circle-o"></i> Work Order </a></li>
			<?php
			}
			}
			
			if($this->common_model->check_user_permission('Product Information','ProductListing')){
			?>
			
            <li><a href="<?=base_url();?>masters/products"><i class="fa fa-circle-o"></i> Product Information</a></li>
            
			<?php
			}
			
			if($user_type == "A" ){
				if($this->common_model->check_user_permission('Employee Information','EmployeeListing')){
					?><li><a href="<?=base_url();?>employee/emp"><i class="fa fa-circle-o"></i> Employee Information</a></li><?php
				}
			}
			
			?>
			<?php if($user_type=="A"){?>
				<li><a href="<?=base_url();?>sales/auc_owner_listing"><i class="fa fa-circle-o"></i>Auction Owner Listing</a></li>
				<!--<li><a href="<?=base_url();?>sales/auc_rm_listing"><i class="fa fa-circle-o"></i>Auction RM Listing</a></li>-->
			<?php } 
			if($this->common_model->check_user_permission('RM_Module','addRm')){
            ?>
                <li><a href="<?=base_url();?>sales/auc_rm_listing"><i class="fa fa-circle-o"></i>Auction RM Listing</a></li>
                <li><a href="<?=base_url();?>sales/auc_owner_listing"><i class="fa fa-circle-o"></i>Auction Owner Listing</a></li>
            <?php } 

            ?>
        <!-- <li><a href="<?=base_url();?>stock/stocks"><i class="fa fa-circle-o"></i> Current Stock</a></li>-->
           
          </ul>
        </li>
		 <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i>
            <span>Transactions</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           <?php 
				$currentYear = date('Y');
				$startYear = $currentYear;

				if (date('n') < 4) {
				    $startYear--;
				}
				$endYear = $startYear + 1;
				$financialYear = $startYear . '-' . $endYear;

		    if($this->common_model->check_user_permission('Generate Bill','BillAdd')){ 
	   		    if($financialYear == $this->session->get('fin_yr_code')){  
	   	    ?>
				<li><a href="<?=base_url();?>sales/service_gst"><i class="fa fa-circle-o"></i> Generate Bill(GST)</a></li>
				<li><a href="<?=base_url();?>sales_percentage/service_gst"><i class="fa fa-circle-o"></i> Generate Bill by Percent</a></li>
			<?php 
				}else{
			?>
				<li><a href="#" style="color: inherit;" onclick="showAlert();"><i class="fa fa-circle-o"></i> Generate Bill(GST)</a></li>
				<li><a href="#" style="color: inherit;" onclick="showAlert();"><i class="fa fa-circle-o"></i> Generate Bill by Percent</a></li>
			<?php
			}
			}?>
			
			<?php if($this->common_model->check_user_permission('Generate Bill','BillListing')){ ?>
				<li><a href="<?=base_url();?>sales/sales_list"><i class="fa fa-circle-o"></i> Bill Report</a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Collection','Collection')){ ?>
				<li><a href="<?=base_url();?>collection"><i class="fa fa-circle-o"></i> Payment Received</a></li>
			<?php 
			}
			
			/*  if($this->common_model->check_user_permission('Report','WorkOrderReport')){ ?>
				<li><a href="<?=base_url();?>work_order_report"><i class="fa fa-circle-o"></i>Work Order Report</a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Report','CompanyPendingAmountReport')){?>
				<li><a href="<?=base_url();?>reports/masters/company_pending_amt"><i class="fa fa-circle-o"></i>Company Wise Pending <br/>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount Report</a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Report','MonthlyWorkOrderReport')){?>
				<li><a href="<?=base_url();?>reports/monthly_work_order_generation"><i class="fa fa-circle-o"></i>Monthly Work Order <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Generating Report</a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Report','CompanyPendingAmountReport')){?>
				<li><a href="<?=base_url();?>reports/masters/pending_bill"><i class="fa fa-circle-o"></i>Payment Report </a></li>
			<?php }?> */
			?>
			<!--<li><a href="<?=base_url();?>sales/sales_list"><i class="fa fa-circle-o"></i> Credit Slip</a></li>-->
			
          </ul>
        </li>
		<li class="treeview">
            <a href="#">
                <i class="fa fa-share"></i>
                <span>Proforma Transactions</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
		    <ul class="treeview-menu">
    		  <?php 
    		  	$currentYear = date('Y');
    				$startYear = $currentYear;
    
    				if (date('n') < 4) {
    				    $startYear--;
    				}
    				$endYear = $startYear + 1;
    				$financialYear = $startYear . '-' . $endYear;
    		  	if($this->common_model->check_user_permission('Generate Proforma','ProformaAdd')){
    		  		if($financialYear == $this->session->get('fin_yr_code')){
    		  ?>
    				<li><a href="<?=base_url();?>proforma_sales/service_gst"><i class="fa fa-circle-o"></i>Generate Proforma(GST)</a></li>
    				<li><a href="<?=base_url();?>proforma_sales_percentage/service_gst"><i class="fa fa-circle-o"></i>Generate Proforma by Percent</a></li>
    		  <?php } else { ?>
    		  	<li><a href="#" style="color: inherit;" onclick="showAlert();"><i class="fa fa-circle-o"></i>Generate Proforma(GST)</a></li>
    				<li><a href="#" style="color: inherit;" onclick="showAlert();"><i class="fa fa-circle-o"></i>Generate Proforma by Percent</a></li>
    		  <?php } } ?>
    		  <?php if($this->common_model->check_user_permission('Generate Proforma','ProformaListing')){ ?>
    				<li><a href="<?=base_url();?>proforma_sales/sales_list"><i class="fa fa-circle-o"></i>Proforma Bill Report</a></li>
    		  <?php }?>
		  </ul>
		</li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i>
            <span>Report</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
		<ul class="treeview-menu">
		  <?php if($this->common_model->check_user_permission('Report','WorkOrderReport')){ ?>
				<li><a href="<?=base_url();?>work_order_report"><i class="fa fa-circle-o"></i>Work Order Report</a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Report','CompanyPendingAmountReport')){?>
				<li><a href="<?=base_url();?>reports/masters/company_pending_amt"><i class="fa fa-circle-o"></i>Company Wise Pending <br/>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount Report</a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Report','WorkOrderReport')){?>
				<li><a href="<?=base_url();?>reports/monthly_work_order_generation"><i class="fa fa-circle-o"></i>Monthly Work Order <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Generating Report</a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Report','CompanyPendingAmountReport')){?>
				<li><a href="<?=base_url();?>reports/masters/pending_bill"><i class="fa fa-circle-o"></i>Payment Report </a></li>
			<?php }?>
			<?php if($this->common_model->check_user_permission('Report','CompanywiseInvoicePaymentReport')){?>
				<li><a href="<?=base_url();?>reports/masters/invoice_payment_data"><i class="fa fa-circle-o"></i>Companywise Invoice & <br/>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Report </a></li>
			<?php }?>
		  </ul>

		</li>
		<?php if($this->common_model->check_user_permission('Permission','PermissionHeadListing')){?>
		<li class="treeview">
			<a href="#">
			<i class="fa fa-list" aria-hidden="true"></i>
			<span>Permission</span>
			<i class="fa fa-angle-left pull-right"></i>
			</a>
			 <ul class="treeview-menu">
				<?php if($this->common_model->check_user_permission('Permission','PermissionHeadListing')){?>
					<li><a href="<?=base_url();?>permission"><i class="fa fa-circle-o"></i>Permission Head</a></li>
				<?php }
					 if($this->common_model->check_user_permission('Permission','PermissionSubHeadListing')){
				?>
					<li><a href="<?=base_url();?>permission/sub_head"><i class="fa fa-circle-o"></i>Permission Sub Head</a></li>
					 <?php }?>
			 </ul>
		</li>
		<?php }?>
		
     <!--<li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i>
            <span>Purchase</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url();?>purchase/purchase_gst"><i class="fa fa-circle-o"></i> Add Purchase(GST)</a></li>
            <li><a href="<?=base_url();?>purchase/purchase_list"><i class="fa fa-circle-o"></i>Purchase List</a></li>
            <li><a href="<?=base_url();?>purchases/purchase_payment"><i class="fa fa-circle-o"></i> Payment</a></li>
          
          </ul>
        </li>
         <?php //if($this->session->get('packageType')=="D" || $this->session->get('packageType')=="A"){?>
       <!-- <li class="treeview">
          <a href="#"><i class="fa fa-reply"></i> <span>Sales</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
           <!-- <li><a href="<?=base_url();?>sales/sales_gst"><i class="fa fa-circle-o"></i> Sales Invoice(GST)</a></li>-->
           <!-- <li><a href="<?=base_url();?>sales/service_gst"><i class="fa fa-circle-o"></i> Service Invoice(GST)</a></li>
            <li><a href="<?=base_url();?>sales/sales_list"><i class="fa fa-circle-o"></i> Sales</a></li>
            <li><a href="<?=base_url();?>collection"><i class="fa fa-circle-o"></i> Collection</a></li>
            <li><a href="<?=base_url();?>sales/sales_list"><i class="fa fa-circle-o"></i> Credit Slip</a></li>
          </ul>
        </li>
        <?php //}?>
		<?php //if($this->session->get('packageType')=="R" || $this->session->get('packageType')=="A"){?>
         <li class="treeview">
          <a href="#"><i class="fa fa-reply"></i> <span>Retail Sales</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url();?>retail/retail_sales_gst"><i class="fa fa-circle-o"></i> Sales Invoice(GST)</a></li>
            <li><a href="<?=base_url();?>retail/retail_sales_gst/sales_list"><i class="fa fa-circle-o"></i> GST Sales List</a></li>
       
          </ul>
        </li>
        <?php// }?>
        
         
      <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Reports</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
           
            <li>
              <a href="#"><i class="fa fa-circle-o"></i>Stock <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <!-- li><a href="<?=base_url();?>stock/stocks/expiry_wise_stock"><i class="fa fa-circle-o text-yellow"></i>Old Stock</a></li> -->
				<!--<li><a href="<?=base_url();?>stock/stocks/supplier_wise_stock"><i class="fa fa-circle-o text-aqua"></i>Supplier wise Stock</a></li>
                <li><a href="<?=base_url();?>stock/stocks/low_stock"><i class="fa fa-circle-o text-red"></i>Low Stock</a></li>
               
              </ul>
            </li>
           
          </ul>
        </li>-->
    
       <!--<li class="treeview">
        	<a href="<?=base_url();?>gst"><i class="fa fa-book"></i><span>GST ASSESMENT</span></a>
          	</li>-->
		
		<?php
		if($user_id == "3"){ 
			 if($this->common_model->check_user_permission('Setting','ThemeSetting')){
		?>	
			<li class="treeview">
				<a href="<?=base_url();?>settings"><i class="fa fa-th"></i><span>Select Theme</span></a>
			</li>
			 <?php } if($this->common_model->check_user_permission('Setting','CommonSetting')){
			?>
			<li class="treeview">
				<a href="<?=base_url();?>settings/common_setting"><i class="fa fa-cog"></i><span>Common Setting</span></a>
			</li>
			<?php } ?>
		<?php
		}
		?>
		
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script type="text/javascript">
  	function showAlert(){
  		alert("Kindly Select Current Financial Year");
  	}
  </script>