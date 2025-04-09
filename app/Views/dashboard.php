<?php $this->session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="<?= base_url();?>assets/images/favicon.ico"> -->

    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- App css -->
    <link href="<?= base_url();?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="<?= base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Datatables css -->
    <link href="<?= base_url();?>assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url();?>assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Datatables css -->
    <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    

    <style type="text/css">
    .bg-skyblue {
        background-color: #87CEEB !important;
        /* SkyBlue color */
    }

    #recent_invoices tr td:nth-child(4) {
        width: 42%;
    }

    .blinking-bg {
        width: 100%;
        /* Ensure consistent width */
        min-height: 150px;
        /* Adjust as needed */
        background-color: orange;
        color: black;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
        animation: blink-bg 1s infinite alternate;
        border: 2px solid red;
        /* Maintain consistent border */
    }

    @keyframes blink-bg {
        0% {
            background-color: rgba(255, 0, 0, 0.3);
            border-color: rgba(255, 0, 0, 0.3);
        }

        100% {
            background-color: white;
            border-color: rgba(255, 0, 0, 0.3);
            /* Keep border same to prevent size changes */
        }
    }

    .card {
        width: 100%;
        /* Ensure all cards take the same width */
        min-height: 150px;
        /* Ensure all cards have the same height */
        transition: background-color 0.3s ease-in-out;
        /* Smooth transition */
    }

    .modal-body {
        max-height: 70vh;
        /* Limits the height to 70% of the viewport */
        overflow-y: auto;
        /* Enables vertical scrolling */
    }
    .table-responsive {
        max-height: 50vh; /* Limits table height */
        overflow-y: auto; /* Enables scrolling within the table */
        /* border: 1px solid #ddd; Optional: Adds a border to the table */
    }

    /* Fix table header */
    .table thead th {
        position: sticky;
        top: 0;
        background: #343a40; /* Dark header background */
        color: white; /* White text */
        z-index: 2;
    }
    </style>
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

            <!-- <div style="padding-top:30px;padding-right:50px;">
                <button class="btn btn-primary float-end" data-toggle="modal" data-target="#exampleModalCenter">ADD
                    EMPLOYEE</button>
            </div> -->

            <!-- Modals -->

            <div class="col-md-12 col-xl-12" style="padding-top: 20px;">
                <div class="card d-flex justify-content-center align-items-center"
                    style="min-height: 80px; height: auto; padding: 5px;">
                    <h2 class="text-black mb-0 text-center">VACANT DESK</h2>
                </div>
            </div>

            <div class="row">

                <div class="col-md-6 col-xl-2"></div>
                <div class="col-md-6 col-xl-4">
                    <a href="<?php echo base_url();?>employee/vacantSystem" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body">
                                <div class="widget-first">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div
                                                    class="bg-primary-subtle rounded-2 p-1 me-2 border border-dashed border-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="#287F71"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M3 9l9 6 9-6-9-6-9 6z"></path>
                                                        <path d="M3 9v6l9 6 9-6V9"></path>
                                                        <path d="M9 3v6"></path>
                                                        <path d="M15 3v6"></path>
                                                    </svg>
                                                </div>
                                                <p class="mb-0 text-dark fs-15">
                                                <h5>MORNING SHIFT</h5>
                                                </p>
                                            </div>
                                            <h3 class="mb-0 fs-24 text-black me-2">
                                                <?php echo $count['vms'];  ?>
                                            </h3>
                                        </div>

                                        <div>
                                            <span class="text-primary fs-14 me-2"><i class="fs-18"></i></span>
                                            <!-- <div id="new-orders" class="apex-charts"></div> -->
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0 fs-13">
                                            &nbsp;
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-4">
                    <a href="<?php echo base_url();?>employee/vacantSystem" class="text-decoration-none">
                        <div class="card <?php //echo $classname;?>">
                            <div class="card-body">
                                <div class="widget-first">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div
                                                    class="bg-primary-subtle rounded-2 p-1 me-2 border border-dashed border-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="#287F71"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M3 9l9 6 9-6-9-6-9 6z"></path>
                                                        <path d="M3 9v6l9 6 9-6V9"></path>
                                                        <path d="M9 3v6"></path>
                                                        <path d="M15 3v6"></path>
                                                    </svg>
                                                </div>
                                                <p class="mb-0 text-dark fs-15">
                                                <h5>NIGHT SHIFT</h5>
                                                </p>
                                            </div>
                                            <h3 class="mb-0 fs-24 text-black me-2">
                                                <?php echo $count['vns'];   ?>
                                            </h3>
                                        </div>

                                        <div>
                                            <span class="text-primary fs-14 me-2"><i class="fs-18"></i></span>
                                            <!-- <div id="new-orders" class="apex-charts"></div> -->
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0 fs-13">
                                            &nbsp;
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-12 col-xl-12" style="padding-top: 20px;">
                <div class="card d-flex justify-content-center align-items-center"
                    style="min-height: 80px; height: auto; padding: 5px;">
                    <h2 class="text-black mb-0 text-center">INVENTORY</h2>
                </div>
            </div>
            <div class="row">

                <?php
                foreach($getdata as $data)
                {
                    if($data['current_quantity'] <= 5)
                    { 
                        $classname = 'blinking-bg';
                    }
                    else
                    {
                        $classname ='';
                    }

                ?>

                <div class="col-md-6 col-xl-3">
                    <a href="javascript:void(0)" onclick="gethistory('<?php echo $data['id'] ;?>');"
                        class="text-decoration-none">
                        <div class="card <?php echo $classname;?>">
                            <div class="card-body">
                                <div class="widget-first">
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div
                                                    class="bg-primary-subtle rounded-2 p-1 me-2 border border-dashed border-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 24 24" fill="none" stroke="#287F71"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M3 9l9 6 9-6-9-6-9 6z"></path>
                                                        <path d="M3 9v6l9 6 9-6V9"></path>
                                                        <path d="M9 3v6"></path>
                                                        <path d="M15 3v6"></path>
                                                    </svg>
                                                </div>
                                                <h5 class="mb-0 text-dark"><?php echo strtoupper($data['product']);?>
                                                </h5>
                                            </div>

                                            <!-- Three sections aligned horizontally with spacing -->
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div class="text-center flex-grow-1 px-3">
                                                    <p class="mb-1 text-muted fs-14"><b>Total</b></p>
                                                    <h4 class="mb-0 text-black fs-18"><?php echo $data['total_qty']; ?>
                                                    </h4>
                                                </div>
                                                <div class="text-center flex-grow-1 px-3 border-start">
                                                    <p class="mb-1 text-muted fs-14">Used</p>
                                                    <h4 class="mb-0 text-black fs-18">
                                                        <?php $used = $data['total_qty'] - $data['current_quantity']; if($used >0){echo$used;}else{echo 0;}?>
                                                    </h4>
                                                </div>
                                                <div class="text-center flex-grow-1 px-3 border-start">
                                                    <p class="mb-1 text-muted fs-14">Current</p>
                                                    <h4 class="mb-0 text-black fs-18">
                                                        <?php echo $data['current_quantity']; ?></h4>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-muted mb-0 fs-13">&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <?php } ?>

            </div>
        </div>



        <div class="modal fade bs-example-modal-center" id="myModal" tabindex="-1" onclick="closeModal();" role="dialog"
            aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ITEM HISTORY</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>
                    <div class="modal-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>SR NO</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Assigned Date</th> 
                            </tr>
                        </thead>
                        <tbody id="hbody">
                             
                        </tbody>
                    </table>
                </div>
                    </div>
                </div>
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
    <script src="<?= base_url();?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url();?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url();?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url();?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="<?= base_url();?>assets/libs/feather-icons/feather.min.js"></script>

    <!-- Apexcharts JS -->
    <script src="<?= base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- for basic area chart -->
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

    <!-- Widgets Init Js -->
    <script src="<?= base_url();?>assets/js/pages/apexcharts-column.init.js"></script>

    <!-- Boxplot Charts Init Js -->
    <script src="<?= base_url();?>assets/js/pages/apexcharts-pie.init.js"></script>

    <!-- Datatables js -->
    <!-- <script src="<?php //echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script> -->

    <!-- dataTables.bootstrap5 -->
    <script src="<?php echo base_url();?>assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- buttons.bootstrap5 -->
    <!-- <script src="<?php //echo base_url();?>assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script> -->

    <!-- dataTables.keyTable -->
    <!-- <script src="<?php //echo base_url();?>assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script> -->
    <!-- <script src="<?php //echo base_url();?>assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js"></script> -->

    <!-- dataTable.responsive -->
    <script src="<?php //echo base_url();?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="<?php //echo base_url();?>assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
    </script>

    <!-- dataTables.select -->
    <!-- <script src="<?php //echo base_url();?>assets/libs/datatables.net-select/js/dataTables.select.min.js"></script> -->
    <!-- <script src="<?php// echo base_url();?>assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script> -->

    <!-- Datatable Demo App Js -->
    <script src="<?php echo base_url();?>assets/js/pages/datatable.init.js"></script>

    <!-- App js-->
    <script src="<?php echo base_url();?>assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Datatables js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- buttons.colVis -->
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <!-- buttons.bootstrap5 -->
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <!-- dataTables.keyTable -->
    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js"></script>

    <!-- dataTable.responsive -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <!-- dataTables.select -->
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>
    
    
    
    <!-- Datatable Demo App Js -->
    <!-- <script src="assets/js/pages/datatable.init.js"></script> -->

    <script>
    function gethistory(id) {
         
        $.ajax({
            url: '<?php echo base_url();?>Dashboard/gethistory', // The PHP file that will process the data
            type: 'POST',
            data: { id: id },
            dataType: 'text', // Expecting plain HTML (not JSON)
            success: function(response) {
                $("#hbody").html(response);

                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show();

            },
            error: function(xhr, status, error) {

            }
        });
    }


    function closeModal() {
 
        var myModalEl = document.getElementById('myModal');
        var myModal = bootstrap.Modal.getInstance(myModalEl);
        
        if (myModal) {
            myModal.hide(); // Hide the modal
        }
    }

    </script>




</body>

</html>