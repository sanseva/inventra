<?php $this->session = \Config\Services::session(); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>Module | Inventra</title>
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
    <link href="<?php echo base_url();?>assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />

    <style type="text/css">
    .bg-skyblue {
        background-color: #87CEEB !important;
        /* SkyBlue color */
    }

    #recent_invoices tr td:nth-child(4) {
        width: 42%;
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





            <div class="col-md-12 col-xl-12" style="padding-top: 80px;">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title text-black mb-0">ACCESS</h5>
                        </div>
                    </div>

                    <!-- Button Datatable -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <form action="javascript:void(0);" id="myForm" method="post">
                                                <div class="row g-3">


                                                    <div class="col-xxl-4">
                                                        <div>
                                                            <label for="Module Name" class="form-label">Select Employee
                                                                : </label>
                                                            <select class="form-control modulename"
                                                                onchange="getaccess()" id="emp_id" name="emp_id">
                                                                <!-- <option value="s">John</option>
                                                                <option value="s">Tom</option>
                                                                <option value="s">Johny</option>
                                                                <option value="s">JSON</option> -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead class="table">
                                                                <tr>
                                                                    <th>SR NO</th>
                                                                    <th>Module Name</th>
                                                                    <th>Sub Module Name</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="hbody">

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div><!-- end row -->
                                            </form> <!-- end form -->
                                        </div> <!-- end modal body -->
                                    </div>

                                </div>

                            </div>
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
    <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
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
    <script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>

    <!-- buttons.colVis -->
    <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

    <!-- buttons.bootstrap5 -->
    <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

    <!-- dataTables.keyTable -->
    <script src="<?php echo base_url();?>assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js">
    </script>

    <!-- dataTable.responsive -->
    <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script>

    <!-- dataTables.select -->
    <script src="<?php echo base_url();?>assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>

    <!-- Datatable Demo App Js -->
    <!-- <script src="assets/js/pages/datatable.init.js"></script> -->

    <script>
    getemp();

    function getemp() {

        $("#emp_id").html('');

        $.ajax({
            url: '<?php echo base_url();?>permission/getemp', // The PHP file that will process the data
            type: 'GET',
            dataType: 'html', // Expecting plain HTML (not JSON)
            success: function(response) {
                $("#emp_id").append(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching items: " + error);
            }
        });
    }  
 
    function getaccess() {

        var empid = $('#emp_id').val();

        $("#hbody").html('');

        $.ajax({
            url: '<?php echo base_url();?>permission/getaccess', // The PHP file that will process the data
            type: 'POST',
            data: {
                'empid': empid
            },
            dataType: 'html', // Expecting plain HTML (not JSON)
            success: function(response) {
                $("#hbody").append(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching items: " + error);
            }
        });
    }

    function assignaccess(mid, pid, code, element) {

        var empid = $('#emp_id').val();
        var isChecked = $(element).prop('checked') ? 1 : 0; // Check if selected or unselected

        if(isChecked)
        {
            $.ajax({
                url: '<?php echo base_url();?>permission/saveaccess', // The PHP file that will process the data
                type: 'POST',
                data: {
                    'mid': mid,
                    'pid': pid,
                    'code': code,
                    'empid': empid
                },
                dataType: 'html', // Expecting plain HTML (not JSON)
                success: function(response) {

                },
                error: function(xhr, status, error) {
                    console.error("Error fetching items: " + error);
                }
            });
        }
        else
        {
            $.ajax({
                url: '<?php echo base_url();?>permission/deleteaccess', // The PHP file that will process the data
                type: 'POST',
                data: {
                    'mid': mid,
                    'pid': pid,
                    'code': code,
                    'empid': empid
                },
                dataType: 'html', // Expecting plain HTML (not JSON)
                success: function(response) {

                },
                error: function(xhr, status, error) {
                    console.error("Error fetching items: " + error);
                }
            });
        }

        // $.ajax({
        //     url: '<?php //echo base_url();?>permission/saveaccess', // The PHP file that will process the data
        //     type: 'POST',
        //     data: {
        //         'mid': mid,
        //         'pid': pid,
        //         'code': code,
        //         'empid': empid
        //     },
        //     dataType: 'html', // Expecting plain HTML (not JSON)
        //     success: function(response) {

        //     },
        //     error: function(xhr, status, error) {
        //         console.error("Error fetching items: " + error);
        //     }
        // });

    }


    // $("input[type='checkbox']").on("change", function () {
    //     if ($(this).is(":checked")) {
    //         alert("Checkbox is checked");
    //     } else {
    //         alert("Checkbox is unchecked");
    //     }
    // });

    // function sss(mid, pid, code) {

    //     var checkboxes = document.getElementsByClassName("ischecked"); // Select all checkboxes with name="permission"

    // checkboxes.forEach(function(checkbox) {
    //     if (checkbox.checked) {
    //         console.log("Checkbox with name 'permission' and value " + checkbox.value + " is checked");
    //     } else {
    //         console.log("Checkbox with name 'permission' and value " + checkbox.value + " is unchecked");
    //     }
    // });

    // }



    </script>




</body>

</html>