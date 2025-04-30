<?php $this->session = \Config\Services::session(); $this->common_model = model("Common_model");$this->permissions = $this->common_model->checkPermission();?>
 
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <title>Ticket</title>
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
            <div style="padding-top:30px;padding-right:50px;" class="d-flex flex-wrap gap-2">

                <?php
                    $search_code = "TIC-ADD-01";
                    $codes = array_column($this->permissions, 'code'); 

                    if (in_array($search_code, $codes))
                    { ?>
                <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center">ADD</button>

                <button type="button" class="btn btn-primary  " data-bs-toggle="modal"
                    data-bs-target=".upload-excel">IMPORT EXCEL</button>

                <?php } ?>


                <!-- <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-center">ADD Community Care </button> -->
            </div>

            <!-- Modals -->
            <div class="modal fade bs-example-modal-center" id="myModal" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD Community Care </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <form action="javascript:void(0);" id="myForm" method="post">
                                    <div class="row g-3">

                                        <div class="col-xxl-12">
                                            <label for="Name" class="form-label"> Contact Name</label>
                                            <input type="text" class="form-control" id="Name" name="Name"
                                                placeholder="Enter Your Name" required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <label for="Date" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="sdate" name="sdate" required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <label for="pname" class="form-label">Provider Name</label>
                                            <input type="text" class="form-control" id="Pname" name="Pname" required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <label for="taxno" class="form-label">Tax ID Number</label>
                                            <input type="text" class="form-control" id="taxno" name="taxno" required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <label for="mname" class="form-label">Member Name</label>
                                            <input type="text" class="form-control" id="mname" name="mname" required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <label for="memberid" class="form-label">Member ID</label>
                                            <input type="text" class="form-control" id="memberid" name="memberid"
                                                required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <label for="claimno" class="form-label">Claim Number</label>
                                            <input type="text" class="form-control" id="claimno" name="claimno"
                                                required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <label for="dos" class="form-label">Date of Service</label>
                                            <input type="date" class="form-control" id="dos" name="dos" required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <input type="hidden" class="form-control" id="action" name="action"
                                                value="add">
                                            <input type="hidden" class="form-control" id="idd" name="idd" value="">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
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

            <div class="modal fade upload-excel" id="myModal" tabindex="-1" role="dialog"
                aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">UPLOAD EXCEL </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                <form action="<?= base_url('communitycare/preview_excel') ?>" method="post"
                                    enctype="multipart/form-data">
                                    <div class="row g-3">

                                        <div class="col-xxl-12">
                                            <label for="Excel" class="form-label"> Upload Excel</label>
                                            <input type="file" class="form-control" id="excel_file" name="excel_file" accept=".xls,.xlsx" required>
                                        </div>

                                        <div class="col-xxl-12">
                                            <a href="<?= base_url();?>assets/sampledata/sampledata.xlsx"  download > Download Sample File </a >
                                        </div>



                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit">Preview</button>
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
                        <h5 class="card-title text-black mb-0">Community Care List</h5>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2"><input type="text" id="filterContactName" class="form-control" placeholder="Contact Name"></div>
                        <div class="col-md-2"><input type="date" id="filterDate" class="form-control"></div>
                        <div class="col-md-2"><input type="text" id="filterProviderName" class="form-control" placeholder="Provider Name"></div>
                        <div class="col-md-2"><input type="text" id="filterMemberName" class="form-control" placeholder="Member Name"></div>
                        <div class="col-md-2"><input type="text" id="filterClaimNumber" class="form-control" placeholder="Claim Number"></div>
                        <div class="col-md-2"><input type="text" id="filtercreatedby" class="form-control" placeholder="Added By"></div>
                    </div>

                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Contact Name</th>
                                    <th>Date</th>
                                    <th>Provider Name</th>
                                    <th>Member Name</th>
                                    <th>Claim Number</th>
                                    <th>Added By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- end start -->

    </div> <!-- container-fluid -->
    </div> <!-- content -->

    <!-- Footer Start -->
    <?php //echo view('includes/footer');?>
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

        $(document).ready(function () {
    function loadTable() {
        $('#datatable-buttons').DataTable({
            destroy: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            ajax: {
                url: '<?php echo base_url(); ?>CommunityCare/getdata',
                data: {
                    name: $('#filterContactName').val(),
                    date: $('#filterDate').val(),
                    pname: $('#filterProviderName').val(),
                    mname: $('#filterMemberName').val(),
                    claimno: $('#filterClaimNumber').val(),
                    createdby: $('#filtercreatedby').val()
                },
                type: 'GET',
                dataSrc: 'data'
            },
            columns: [
                { data: '0' },
                { data: '1' },
                { data: '2' },
                { data: '3' },
                { data: '4' },
                { data: '5' },
                { data: '6' },
                {
                    data: null,
                    render: function (data, type, row) {
                        let buttons = '';

                        <?php  
                        $editPermission  = "TIC-EDIT-02";
                        $delPermission   = "TIC-DEL-03";
                        $codes = array_column($this->permissions, 'code'); 

                        if (in_array($editPermission, $codes))
                        { ?>
                        buttons += '<a class="btn btn-success btn-xs"  onclick="edit(' + row
                            .user_id + ')"><i class="fa fa-pencil"></i></a>';
                        <?php }  

                        if (in_array($delPermission, $codes))
                        { ?>
                        buttons +=
                            '&nbsp<a id="sDeleteRetailGST" class="sDeleteRetailGST btn btn-danger btn-xs" data-id="' +
                            row.user_id + '" href="#"><i class="fa fa-times"></i></a>';
                        <?php }  if (in_array($delPermission, $codes))
                        { ?>


                        buttons +=
                            '&nbsp<a id="print" class="print btn btn-primary btn-xs" data-id="' +
                            row.user_id +
                            '" target="_blank" href="<?php echo base_url('CommunityCare/pdf'); ?>/' +
                            row.user_id + '"><i class="fa fa-eye"></i></a>';
                        <?php } ?>

                        return buttons;

                        
                    }
                }
            ]
        });
    }

    loadTable();

    // Bind filter events
    $('#filterContactName, #filterDate, #filterProviderName, #filterMemberName, #filterClaimNumber, #filtercreatedby')
        .on('keyup change', function () {
            loadTable();
        });

    // Delete
    $('#datatable-buttons').on('click', '.sDeleteRetailGST', function () {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this record?')) {
            $.post('<?php echo base_url(); ?>CommunityCare/deletedata', { id }, function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                    loadTable();
                } else {
                    alert(response.message);
                }
            }, 'json');
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

        $('#myForm').on('submit', function(e) {

            e.preventDefault(); // Prevent default form submission

            // Serialize the form data automatically
            var dataToSend = $(this).serialize(); // Automatically serializes all form data


            var action = $("#action").val();
            $('#myModal').modal('hide');

            if (action == 'add') {

                // Perform AJAX request
                $.ajax({
                    url: '<?php echo base_url();?>CommunityCare/save_data', // The PHP file that will process the data
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        alert('Form submitted successfully!'); // Show the response from PHP (success or error)
                         $('#datatable-buttons').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + ": " + error);
                    }
                });
            } else {
                $.ajax({
                    url: '<?php echo base_url();?>CommunityCare/update_data', // The PHP file that will process the data
                    type: 'POST',
                    data: dataToSend,
                    success: function(response) {
                        alert('Data Updated successfully!'); // Show the response from PHP (success or error)
                        location.reload();

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
            url: '<?php echo base_url();?>CommunityCare/getdatabyid', // The PHP file that will process the data
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {

                $("#Name").val(response[0].name);
                $("#sdate").val(response[0].date);
                $("#Pname").val(response[0].pname);
                $("#taxno").val(response[0].taxno);
                $("#action").val('update');
                $("#mname").val(response[0].mname);
                $("#memberid").val(response[0].memberid);
                $("#idd").val(response[0].id);
                $("#claimno").val(response[0].claimno);
                $("#dos").val(response[0].dos);

                var myModal = new bootstrap.Modal(document.getElementById('myModal'));
                myModal.show(); // Show the modal
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + ": " + error);
            }
        });
    }
    </script>



</body>

</html>