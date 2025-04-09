<?php $this->session = \Config\Services::session(); ?>
<header class="main-header">
<style>
ul.ui-autocomplete li {
	border-bottom:1px solid black;
}
@media all and (max-width: 768px) {
  .sidebar-toggle{
    margin-top: -50px;
} 
}

</style>
    <!-- Logo -->
    <a href="<?=base_url();?>home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Bill</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?=$this->session->get('OrgName');?></b> Billing</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
   
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
           <li class="dropdown user user-menu">
            <a href="<?=base_url()?>change_organization">
                 <span class="">FY:<b><?=$this->session->get('OrgName');?> </b>[</b><?=$this->session->get('OrgType');?><b>]</b> </span>
				 
            </a>
            </li>
                   
           <li class="dropdown user user-menu">
            <a href="<?=base_url('org_selection')?>">
              
              FY:<?=$this->session->get('fin_yr_code');?>
            </a>
            </li>
                   
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url();?>img/avatar.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$this->session->get('user_name');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url();?>img/avatar.png" class="img-circle" alt="User Image">

                <p>
                  SCS Support
                  <small><i class="fa fa-mobile"></i> xxxx</small>
                </p>
              </li>
              <!-- Menu Body 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <a href="<?=base_url()?>purchase/purchase_list">Purchases</a>
                  </div>
                  <div class="col-xs-6 text-center">
                    <a href="<?=base_url()?>sales/sales_list">Sales</a>
                  </div>
                 
                </div>
                
              </li>
               Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url();?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>