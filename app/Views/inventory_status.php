<?php $this->session = \Config\Services::session();$this->common_model = model("Common_model");$this->permissions = $this->common_model->checkPermission(); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>Inventory Transaction |   </title>
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
    <!-- <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css"
        rel="stylesheet" type="text/css" />
    <!-- <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
        type="text/css" /> -->
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

            <div style="padding-top:30px;padding-right:50px;" class="d-flex flex-wrap gap-2">

            <?php
                    $search_code = "INVS-ADD-01";
                    $codes = array_column($this->permissions, 'code'); 

                    if (in_array($search_code, $codes))
                    { ?>
                        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                        data-bs-target=".bs-example-modal-center">ADD INVENTORY TRANSACTION</button>
            <?php } ?>


                <!-- <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center">ADD INVENTORY TRANSACTION</button> -->
            </div>

            <!-- Modals -->
            <div class="modal fade bs-example-modal-center" id="myModal" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">INVENTORY TRANSACTION</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <form action="javascript:void(0);" id="myForm" method="post">
                                    <div class="row g-3">

                                        <div class="col-xxl-12">
                                            <div>
                                                <label for="employee" class="form-label">Employee</label>
                                                <select class="form-control" id="employee_id"
                                                    name="employee_id"></select>
                                            </div>
                                        </div>

                                        <!-- Items Container -->
                                        <div id="items-container">
                                            <div class="row item-row ">
                                                <div class="col-md-5">
                                                    <label for="item_id" class="form-label">Item ID</label>
                                                    <select class="form-control item_id" id="item_id" name="item_id[]">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-label">Quantity</label>
                                                    <input type="number" class="form-control" id="quantity"
                                                        name="quantity[]" placeholder="Enter Quantity">
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-success mt-4"
                                                        onclick="addRow()">+</button>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- <div class="col-xxl-12">
                                            <div>
                                                <label for="Quantity" class="form-label">Quantity </label>
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                    placeholder="Enter Quantity">
                                            </div>
                                        </div> -->

                                        <div class="col-xxl-12">
                                            <input type="hidden" class="form-control" id="action" name="action"
                                                value="add">
                                            <input type="hidden" class="form-control" id="idd" name="idd" value="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light closee"
                                                data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary">Save</button>
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
                            <h5 class="card-title text-black mb-0">INVENTORY TRANSACTON</h5>
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
                                                <th>Item ID</th>
                                                <th>Employee Name</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
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
    <!-- <script src="<?php //echo base_url();?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
    </script> -->
    <!-- <script src="<?php //echo base_url();?>assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
    </script> -->

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
    <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js">
    </script>

    <!-- dataTables.select -->
    <script src="<?php echo base_url();?>assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>

    <!-- Datatable Demo App Js -->
    <!-- <script src="assets/js/pages/datatable.init.js"></script> -->

    <script>
    getitems();
    getemp();


    function getitems() {

        $.ajax({
            url: '<?php echo base_url();?>inventory/getitems', // The PHP file that will process the data
            type: 'GET',
            dataType: 'text', // Expecting plain HTML (not JSON)
            success: function(response) {
                $(".item_id").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching items: " + error);
            }
        });
    }

    function getemp() {

        $.ajax({
            url: '<?php echo base_url();?>inventory/getactiveemp', // The PHP file that will process the data
            type: 'GET',
            dataType: 'text', // Expecting plain HTML (not JSON)
            success: function(response) {
                $("#employee_id").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching items: " + error);
            }
        });
    }

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
                url: '<?php echo base_url();?>inventory/getinvstatusdata', // Replace with the server-side URL
                type: 'GET',
                dataSrc: function(json) {
                    // If you need to modify the data structure before adding it to the table, you can do so here
                    return json.data;
                }
            },
            columns: [{
                    "data": "0"
                }, // The column for Sr No.
                {
                    "data": "1"
                }, // product
                {
                    "data": "2"
                },
                {
                    "data": "3"
                },
                {
                    "data": "4",
                    "render": function(data, type, row) {
                        let badgeClass = (data === "A") ? "bg-primary" : "bg-warning";
                        let status = (data === "A") ? "Active" : "Inactive";

                        return `<span onclick="chagestatus('${row.id}')"  class="badge ${badgeClass} p-2" style="font-size: 14px; height: 20px; display: inline-flex; align-items: center;cursor:pointer">${status}</span>`;
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        
                        let buttons = '';

                        <?php   
                        $delPermission   = "INVS-DEL-03";
                        $codes = array_column($this->permissions, 'code'); 
  
                        if (in_array($delPermission, $codes))
                        { ?>
                        buttons +=
                        '<a id="sDeleteRetailGST" class="sDeleteRetailGST btn btn-danger btn-xs" data-id="' +
                            row.id + '"  data-item_id="' +
                            row.item_id + '" href="#"><i class="fa fa-times"></i></a>';
                        <?php } ?>

                        return buttons; 

 
                        // return '' +
                        //     '<a id="sDeleteRetailGST" class="sDeleteRetailGST btn btn-danger btn-xs" data-id="' +
                        //     row.id + '"  data-item_id="' +
                        //     row.item_id + '" href="#"><i class="fa fa-times"></i></a>';
                    }
                }
            ]
        });

        // Handling Delete action (assuming there's a delete API)
        $('#datatable-buttons').on('click', '.sDeleteRetailGST', function() {
            var id = $(this).data('id');
            var item_id = $(this).data('item_id');

            // Confirm and delete the record (you can send an AJAX request to delete this record)
            if (confirm('Are you sure you want to delete this record?')) {
                $.ajax({
                    url: '<?php echo base_url();?>inventory/deleteinvdata', // Server-side script for deletion
                    method: 'POST',
                    data: {
                        id: id,
                        item_id: item_id
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
            url: '<?php echo base_url();?>employee/getinvstatusdata', // The PHP file that will process the data
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

        $('#myForm').on('submit', function(e) {

            e.preventDefault(); // Prevent default form submission

            var dataToSend = $(this).serialize(); // Automatically serializes all form data

            var action = $("#action").val();

            if (action == 'add') {
                $.ajax({
                    url: '<?php echo base_url();?>inventory/saveinvdata', // The PHP file that will process the data
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
                    url: '<?php echo base_url();?>inventory/updateinvdata', // The PHP file that will process the data
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
    });

    function edit(id) {
        // Perform AJAX request
        $.ajax({
            url: '<?php echo base_url();?>inventory/getbyid', // The PHP file that will process the data
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                $("#item_id").val(response[0].item_id);
                $("#quantity").val(response[0].quantity);
                $("#action").val('update');
                $("#idd").val(response[0].id);

                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show(); // Show the modal


            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    }

    function addRow() {

        getitems();
        // Get the items container
        let container = document.getElementById("items-container");

        // Create a new row
        let newRow = document.createElement("div");
        newRow.classList.add("row", "item-row", "mt-2");
        newRow.innerHTML = `
            <div class="col-md-5">
                <select class="form-control item_id" id="item_id" name="item_id[]">
                    <option value="">Select Item</option>
                </select>
            </div>
            <div class="col-md-5">
                <input type="number" class="form-control" name="quantity[]" placeholder="Enter Quantity">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-btn" onclick="removeRow(this)">-</button>
            </div>
        `;

        // Append the new row to the container
        container.appendChild(newRow);
    }

    function removeRow(button) {
        // Remove the row where the delete button was clicked
        button.parentElement.parentElement.remove();
    }


    function chagestatus(id) {


        $.ajax({
            url: "<?php echo base_url(); ?>inventory/chagestatus", // Update with your API route
            type: "POST",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Refresh DataTable to show updated status
                    $('#datatable-buttons').DataTable().ajax.reload();
                } else {
                    alert("Failed to update status!");
                }
            },
            error: function() {
                alert("Error connecting to the server.");
            }
        });
    }
    </script>




</body>

</html>