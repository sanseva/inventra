<?php $this->session = \Config\Services::session();$this->common_model = model("Common_model");$this->permissions = $this->common_model->checkPermission(); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>Inventory | Inventra</title>
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



            <div style="padding-top:30px;padding-right:50px;" class="d-flex flex-wrap gap-2">


                <?php
                    $search_code = "INV-ADD-01";
                    $codes = array_column($this->permissions, 'code'); 

                    if (in_array($search_code, $codes))
                    { ?>
                <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center">ADD INVENTORY</button>
                <?php } ?>

                <!-- <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center">ADD INVENTORY</button> -->
            </div>

            <!-- Modals -->
            <div class="modal fade bs-example-modal-center" id="myModal" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD INVENTORY</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <form action="javascript:void(0);" id="myForm" method="post">
                                    <div class="row g-3">
                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="Productname" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="productname"
                                                    name="productname" placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="Productname" class="form-label">Product Description</label>
                                                <input type="text" class="form-control" id="productdesc"
                                                    name="productdesc" placeholder="Enter Product Description">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="total" class="form-label">Quantity</label>
                                                <input type="text" class="form-control" id="total" name="total"
                                                    placeholder="Enter Total">
                                            </div>
                                        </div>
                                        <!-- <div class="col-xxl-12">
                                            <div>
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" class="form-control" id="price" name="price"
                                                    placeholder="Enter Total Price">
                                            </div>
                                        </div> -->
                                        <!-- <div class="col-xxl-12">
                                            <label for="emailInput" class="form-label">Email</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div> -->
                                        <div class="col-xxl-12">
                                            <input type="hidden" class="form-control" id="action" name="action"
                                                value="add">
                                            <input type="hidden" class="form-control" id="idd" name="idd" value="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light closee"
                                                data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" onclick="saveform()">Save</button>
                                        </div>
                                        <!--end col-->
                                    </div><!-- end row -->
                                </form> <!-- end form -->
                            </div> <!-- end modal body -->
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <div class="col-md-12 col-xl-12" style="padding-top: 80px;">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title text-black mb-0">INVENTORY LIST</h5>
                        </div>
                    </div>

                    <!-- Button Datatable -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable-buttons"
                                        class="table table-striped table-bordered dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>Sr No.</th>
                                                <th>Product</th>
                                                <th>Description</th>
                                                <th>Initial Quantity</th>
                                                <th>Current Quantity</th>
                                                <!-- <th>Cost</th> -->
                                                <!-- <th>status</th> -->
                                                <th nowrap>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody id="shodata">

                                        </tbody>
                                    </table>
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


    

    <!-- jQuery Validation Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>



    <script>
    $(document).ready(function() {

        // Initialize DataTable only if not already initialized
        if ($.fn.dataTable.isDataTable('#datatable-buttons')) {
            $('#datatable-buttons').DataTable().destroy(); // Destroy the current instance
        }

        // Initialize DataTable
        var table = $('#datatable-buttons').DataTable({
            dom: 'Bfrtip', // Button integration (optional)
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print' // Enable export buttons (optional)
            ],
            ajax: {
                url: '<?php echo base_url();?>inventory/getdata', // Replace with the server-side URL
                type: 'GET',
                dataSrc: function(json) {
                    // If you need to modify the data structure before adding it to the table, you can do so here
                    return json.data;
                }
            },
            columns: [{
                    "data": "0"
                },
                {
                    "data": "1"
                },
                {
                    "data": "2"
                },
                {
                    "data": "3"
                },
                {
                    "data": "4"
                },
                // { "data": "5" },  
                {
                    "data": null,
                    "render": function(data, type, row) {



                        let buttons = '';

                        <?php  
                        $editPermission  = "INV-EDIT-02";
                        $delPermission   = "INV-DEL-03";
                        $codes = array_column($this->permissions, 'code'); 

                        if (in_array($editPermission, $codes))
                        { ?>
                        buttons += '<a class="btn btn-success btn-xs" onclick="edit(' + row.id +
                            ')"><i class="fa fa-pencil"></i></a>';
                        <?php }  

                        if (in_array($delPermission, $codes))
                        { ?>
                        buttons +=
                            '<a id="sDeleteRetailGST" class="sDeleteRetailGST btn btn-danger btn-xs" data-id="' +
                            row.id + '" href="#"><i class="fa fa-times"></i></a>';
                        <?php } ?>

                        return buttons;

                        // Rendering buttons for edit and delete operations
                        // return '<a class="btn btn-success btn-xs" onclick="edit(' + row.id +
                        //     ')"><i class="fa fa-pencil"></i></a>' +
                        //     '<a id="sDeleteRetailGST" class="sDeleteRetailGST btn btn-danger btn-xs" data-id="' +
                        //     row.id + '" href="#"><i class="fa fa-times"></i></a>';
                    }
                }
            ]
        });

        // Handling Delete action (assuming there's a delete API)
        $('#datatable-buttons').on('click', '.sDeleteRetailGST', function() {
            var id = $(this).data('id');

            // Confirm and delete the record (you can send an AJAX request to delete this record)
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '<?php echo base_url();?>inventory/deletedata', // Server-side script for deletion
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json', // Specify that the response is expected to be JSON
                    success: function(response) {
                        console.log('Response from server:',
                            response); // Log the entire response object

                        // Check the response status
                        if (response.status === 'success') {
                            // Show success message
                            alert(response.message);
                            table.ajax.reload(); // Reload DataTable to reflect changes
                        } else {
                            // Show error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        console.error("An error occurred: " + error);
                        alert("An error occurred: " +
                            error); // Show error message in case of failure
                    }
                });
            }
        });
    });

    function getempdata() {

        $.ajax({
            url: '<?php echo base_url();?>employee/getempdata', // The PHP file that will process the data
            type: 'GET',
            dataType: 'text', // Expecting plain HTML (not JSON)
            success: function(response) {
                $("#showdata").html(response);
            },
            error: function(xhr, status, error) {

            }
        });
    }

    $(document).ready(function() {

        // $('#myForm').on('submit', function(e) {

        //     e.preventDefault(); // Prevent default form submission

        //     // Serialize the form data automatically
        //     var dataToSend = $(this).serialize(); // Automatically serializes all form data

        //     // Perform AJAX request

        //     var action = $("#action").val();

        //     if (action == 'add') {
        //         $.ajax({
        //             url: '<?php //echo base_url();?>inventory/save_data', // The PHP file that will process the data
        //             type: 'POST',
        //             data: dataToSend,
        //             success: function(response) {
        //                 alert('Form submitted successfully! Response: ' +
        //                 response); // Show the response from PHP (success or error)
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error("AJAX Error: " + status + ": " + error);
        //             }
        //         });
        //     } else {
        //         $.ajax({
        //             url: '<?php //echo base_url();?>inventory/update_data', // The PHP file that will process the data
        //             type: 'POST',
        //             data: dataToSend,
        //             success: function(response) {
        //                 alert(
        //                 'Data Updated successfully!'); // Show the response from PHP (success or error)
        //             },
        //             error: function(xhr, status, error) {
        //                 console.error("AJAX Error: " + status + ": " + error);
        //             }
        //         });
        //     }

        // });
    });


    function edit(id) {
        // Perform AJAX request
        $.ajax({
            url: '<?php echo base_url();?>inventory/getdatabyid', // The PHP file that will process the data
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $("#productname").val(response[0].product);

                $("#productdesc").val(response[0].prod_desc);


                $("#total").val(response[0].total);

                // $("#price").val(response[0].unit_price);

                // $("#status").val(response[0].status);

                $("#action").val('update');
                $("#idd").val(response[0].id);


                // var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                // myModal.show(); // Show the modal
                $('#myModal').modal('show');


            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    }

    //   $(".closee").click(function() {
    //     var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    //     myModal.show(); // Show the modal
    //                     });




    function saveform() {

        // event.preventDefault();

        var form = $("#myForm");

        form.validate({
            ignore: [],
            rules: {
                productname: {
                    required: true,
                },
                total: {
                    required: true,
                }
               
            },
            messages: {
                productname: "<span style='color: red; font-weight: bold;'>Please Enter Product Name</span>",
                total: "<span style='color: red; font-weight: bold;'>Please Enter Quantity</span>" 
                 
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element); // Place error message after the input field
            }
        });

        if (!form.valid()) {
            return; // Stop execution if validation fails
        }


        if (form.valid()) {
            $("#myForm").submit();
        }

        $('#myForm').on('submit', function(e) {

            e.preventDefault(); // Prevent default form submission

            // Serialize the form data automatically
            var dataToSend = $(this).serialize(); // Automatically serializes all form data

            var action = $("#action").val();

            if (action == 'add') {

                // Perform AJAX request
                $.ajax({
                    url: '<?php echo base_url();?>inventory/save_data', // The PHP file that will process the data
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        alert('Form submitted successfully! Response: ' +
                            response); // Show the response from PHP (success or error)
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + ": " + error);
                    }
                });
            } else {
                $.ajax({
                    url: '<?php echo base_url();?>inventory/update_data', // The PHP file that will process the data
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        alert(
                            'Data Updated successfully!'
                        ); // Show the response from PHP (success or error)
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + ": " + error);
                    }
                });
            }
        });
    }
    </script>




</body>

</html>