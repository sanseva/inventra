<?php
$this->session = \Config\Services::session();
$this->common_model = model('Common_model');
$user_type = $this->session->get('user_type');
$user_id = $this->session->get('user_id');
?>
<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a class='logo logo-light' href='<?php echo base_url('Home');?>'>
                    <span class="logo-sm">
                        <img src="<?php //echo base_url();?>assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <!-- <img src="<?php //echo base_url();?>assets/images/logo-light.png" alt="" height="24"> -->
                    </span>
                </a>
                <a class='logo logo-dark' href='<?php echo base_url('Home');?>'>
                    <span class="logo-sm">
                        <!-- <img src="<?php //echo base_url();?>assets/images/logo-sm.png" alt="" height="22"> -->
                    </span>
                    <span class="logo-lg">
                        <h1 style="padding-top:15px;">INVENTRA</h1>
                        <!-- <img src="<?php //echo base_url();?>assets/images/logo-dark.png" alt="" height="30" width = "150"> -->
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu</li>
                <!-- 
                <li>
                    <a class='tp-link' href="<?=base_url();?>Home">
                        <i data-feather="home"></i>
                        <span> Home </span>
                    </a>
                </li> -->

                <!-- <li class="menu-title">MAIN NAVIGATION</li> -->

                <li>
                    <a href="<?php echo base_url();?>dashboard">
                        <i data-feather="grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i data-feather="grid"></i>
                        <span> Masters </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li><a class='tp-link' href="<?php echo base_url();?>employee">
                                    <i class="fa fa-circle-o"></i> Employee </a>
                            </li>
                        </ul>
                        <ul class="nav-second-level">
                            <li><a class='tp-link' href="<?php echo base_url();?>inventory">
                                    <i class="fa fa-circle-o"></i> Inventory</a>
                            </li>
                        </ul>
                        <!-- <ul class="nav-second-level">
                            <li><a class='tp-link' href="<?php //echo base_url();?>inventory/inventory_status">
                                    <i class="fa fa-circle-o"></i> Inventroy Status</a>
                            </li>
                        </ul> -->
                        <!-- <ul class="nav-second-level">
                            <li><a class='tp-link' href="<?php //echo base_url();?>employee/vacantSystem">
                                    <i class="fa fa-circle-o"></i> Vacant Systems </a>
                            </li>
                        </ul> -->
                        <!-- <ul class="nav-second-level">
                            <li><a class='tp-link' href="<?php // echo base_url();?>ticket/">
                                    <i class="fa fa-circle-o"></i> Tickets</a>
                            </li>
                        </ul> -->
                    </div>
                </li>

                <li>
                    <a href="#sidebarInventory" data-bs-toggle="collapse">
                        <i data-feather="grid"></i>
                        <span> Inventory </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarInventory">
                        <ul class="nav-second-level">
                            <li><a class='tp-link' href="<?php echo base_url();?>inventory/inventory_status">
                                    <i class="fa fa-circle-o"></i> Inventory Status</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="<?php echo base_url();?>employee/vacantSystem">
                        <i data-feather="grid"></i>
                        <span>Vacant Systems</span>
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url();?>TicketController">
                        <i data-feather="grid"></i>
                        <span>Tickets</span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarPermission" data-bs-toggle="collapse">
                        <i data-feather="grid"></i>
                        <span> Permission </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPermission">
                        <ul class="nav-second-level">
                            <li>
                                <a class='tp-link' href="<?php echo base_url();?>Permission/module">
                                    <i class="fa fa-circle-o"></i> Module
                                </a>
                            </li>
                            <li>
                                <a class='tp-link' href="<?php echo base_url();?>Permission/submodule">
                                    <i class="fa fa-circle-o"></i> Permission
                                </a>
                            </li>
                            <li>
                                <a class='tp-link' href="<?php echo base_url();?>Permission/access">
                                    <i class="fa fa-circle-o"></i> Access
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        </li>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
</div>
<!-- Left Sidebar End -->

<script type="text/javascript">
function removeSession() {
    $.ajax({
        url: '<?php //echo base_url('Common_controller/removeSessionVariable') ?>', // Change to the correct URL
        type: 'POST',
        success: function(response) {
            if (response.status === 'success') {
                console.log(response.message); // Optional: display a success message
                // Redirect or perform other actions after removing the session
                window.location.href = '<?= base_url('sales/service_gst') ?>';
            }
        },
        error: function() {
            console.error('Failed to remove session');
        }
    });
}

function removeproformaSession() {
    $.ajax({
        url: '<?php //echo base_url('Common_controller/removeSessionVariable') ?>', // Change to the correct URL
        type: 'POST',
        success: function(response) {
            if (response.status === 'success') {
                console.log(response.message); // Optional: display a success message
                // Redirect or perform other actions after removing the session
                window.location.href = '<?= base_url('proforma_sales/service_gst') ?>';
            }
        },
        error: function() {
            console.error('Failed to remove session');
        }
    });
}
</script>