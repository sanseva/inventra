<?php $this->session = \Config\Services::session();
$this->common_model = model("Common_model"); ?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/silva/html/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:41:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

  <meta charset="utf-8" />
  <title>Common Settings | <?php echo TITLE; ?></title>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

  <?php echo view('includes/common_css_js');?>
  <style>
    .table { font-size: 12px; }
    .breadcrumb { background: none; padding: 0; }
    .breadcrumb a { color: #007bff; }
    .breadcrumb .active { color: #6c757d; }
    .label_control { font-weight: normal; }
    .form-group { margin-bottom: 1.5rem; }
    .form-check-label { margin-left: 10px; }
    .box-body { padding: 20px; }
    .btn-save { width: 100px; background-color: #28a745; color: white; }
    .row { margin-bottom: 15px; }
    /* Add background color, padding, and box-shadow to the box-body for better contrast */
    .box-body {
      background-color: #ffffff; /* Light background color to match the UI */
      padding: 20px;
      border-radius: 8px; /* Rounded corners */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

/* Additional styling for buttons to match UI theme */
.btn-save {
  width: 100px;
  background-color: #28a745;
  color: white;
  border-radius: 4px; /* Rounded corners for the button */
  padding: 10px 20px; /* Spacing inside the button */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow effect for the button */
  transition: background-color 0.3s ease; /* Smooth transition on hover */
}

.btn-save:hover {
  background-color: #309f8d; /* Darker shade on hover */
}

/* Additional hover effect for form checkboxes if desired */
input[type="checkbox"]:hover {
  background-color: #28a745; /* Green color on hover */
}

}.box {
  border: 1px solid #ddd;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #f9f9f9;
}
.box-header h3 {
  color: #333;
  font-weight: 600;
  margin-bottom: 20px;
}
.label_control {
  font-size: 16px;
  color: #555;
}
#btnSave {
  background-color: #309f8d;
  border-color: #309f8d ;
  font-size: 16px;
  padding: 8px 16px;
}
#btnSave:hover {
  background-color: #ffffff;
  border-color: #309f8d;
  color: #309f8d;
}
.checkbox-space {
  margin-right: 10px; /* Adds space between the checkbox and label */
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
      <div class="content">
        <div class="container-fluid">
          <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
              <h4 class="fs-18 fw-semibold m-0">Common Settings</h4>
            </div>
            
            <div class="text-end">
              <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);"><a href="<?php echo base_url('home');?>">Home /</a></a></li>
                <li class="breadcrumb-item active">Common Settings</li>
              </ol>
            </div>
          </div>

          <!-- Main content -->
          <section class="content">
            <div class="box">
              <div class="box-body">
                <div class="row">
                  <form id="frm" name="frm">
                    <?php 
                    if(!empty($org)){
                      foreach($org as $org_id){ ?>
                        <div class="col-md-6 col-lg-4 mb-3 d-flex align-items-center">
                          <input type="hidden" name="<?=$org_id['org_id'];?>" />
                          <input type="checkbox" id="checkbox_<?=$org_id['org_id'];?>" name="<?=$org_id['org_id'];?>" value="Y" <?php if($org_id['setting_value']=='Y'){echo 'checked';} ?> class="checkbox-space"/>
                          <label class="label_control mb-0" for="checkbox_<?=$org_id['org_id'];?>"><?=$org_id['OrgName'];?></label>
                        </div>
                        <?php 
                      }
                    }
                    ?>
                    <div class="col-12 mt-4 text-right">
                      <button class="btn btn-success" id="btnSave">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>

        </div>
        <!-- /.content -->
      </div>
    </div>
    <!-- Footer Start -->
    <?php echo view('includes/footer');?>
    <!-- end Footer -->
  </div>
  <!-- <script src="< ?= base_url();?>assets/libs/jquery/jquery.min.js"></script> -->
  <script src="<?= base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
  <script src="<?= base_url();?>assets/libs/node-waves/waves.min.js"></script>
  <script src="<?= base_url();?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
  <script src="<?= base_url();?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
  <script src="<?= base_url();?>assets/libs/feather-icons/feather.min.js"></script>

  <!-- Apexcharts JS -->
  <script src="<?= base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>

  <!-- Widgets Init Js -->
  <script src="<?= base_url();?>assets/js/pages/crm-dashboard.init.js"></script>

  <!-- App js-->
  <script src="<?= base_url();?>assets/js/app.js"></script>
  <script type="text/javascript">
    var baseUrl='<?=base_url()?>';
  </script>
  <script src="<?=base_url();?>js/settings.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>

    $("#btnSave").click(function(e){
  //  var $btn = $("#btnSave").button('loading');
      e.preventDefault();
      var form=$("#frm");
      if(form.valid())
        $( "#frm" ).submit();
    });
    $("#frm").on('submit',(function(e) {
     e.preventDefault();
     $.ajax({
      url: "<?php echo base_url();?>settings/add_setting",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false,
      processData:false,
      dataType:'json',
      success: function(response) {
        if (response.success) {
            toastr.success(response.message); 
        } else {
            toastr.error(response.message);  
        }
      },
       error: function(xhr, status, error) {
          console.error("Request failed: " + status + ", " + error);
          toastr.error("There was an error with the request");
      }
    });
   }));
 </script>
</body>
</html>