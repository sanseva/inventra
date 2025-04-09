<?php $this->request = \Config\Services::request(); ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/silva/html/auth-login by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:42:43 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8" />
    <title>Log In | <?php echo TITLE; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="<?php echo base_url();?>/assets/images/favicon.ico"> -->

    <!-- App css -->
    <link href="<?php echo base_url();?>/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="<?php echo base_url();?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="bg-primary-subtle">
    <!-- Begin page -->
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0">

                <div class="col-xl-7">
                    <div class="account-page-bg p-md-5 p-4">
                        <div class="text-center">
                            <div class="auth-image">
                                <img src="<?php echo base_url();?>assets/images/auth-images.svg"
                                    class="mx-auto img-fluid" alt="images">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card p-3 mb-0">
                                <div class="card-body">

                                    <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                                        <div class="mb-4 p-0 text-center">
                                            <a class='auth-logo' href='<?php echo base_url('Login'); ?>'>
                                                <!-- <img src="<?php echo base_url();?>assets/i mages/logo-dark.png" alt="logo-dark" class="mx-auto" height="38" /> -->
                                            </a>
                                        </div>

                                        <div class="auth-title-section mb-3 text-center">
                                            <h3 class="text-dark fs-20 fw-medium mb-2">Welcome back</h3>
                                            <p class="text-dark text-capitalize fs-14 mb-0">Login in to continue to
                                                INVENTRA <?php //echo TITLE; ?>.</p>
                                        </div>

                                        <div class="saprator my-4"><span>LOGIN</span></div>

                                        <div class="pt-0">
                                            <form class="my-4">
                                                <div class="form-group mb-3">
                                                    <label for="user_id" class="form-label">Username</label>
                                                    <input class="form-control" type="text" id="user_id" name="user_id"
                                                        required="" placeholder="Enter your username">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input class="form-control" type="password" required=""
                                                        id="user_pass" name="user_pass"
                                                        placeholder="Enter your password">
                                                </div>

                                                <div class="form-group mb-0 row">
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary" type="submit" id="login">
                                                                Log In </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="error-message" class="text-center text-danger mt-3"
                                                    style="display: none;"></div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="<?php echo base_url();?>assets/libs/feather-icons/feather.min.js"></script>

    <!-- App js-->
    <script src="<?php echo base_url();?>assets/js/app.js"></script>

    <script>
    $('#login').click(function(e) {

        e.preventDefault();

        $.ajax({
            url: '<?= base_url();?>Login/Check_login',
            data: {
                "user_id": $("#user_id").val(),
                "user_pass": $("#user_pass").val(),
                "fy": $("#fy").val()
            },
            type: "post",
            dataType: 'json',
            success: function(resObj) {
                if (resObj.success == true) {
                    <?php 
                            
                                if($this->request->getGet('url')=="") { ?>
                    window.location = '<?php echo base_url();?>Dashboard';
                    <?php
                                }else 
                                {
                                    ?>
                    window.location = '<?php echo $this->request->getGet('url')?>';
                    <?php 
                                }
                            ?>

                } else {
                    $("#error-message").html('<div class="alert alert-warning alert-dismissable">' +
                        resObj.msg + '<i class="fa fa-warning"></i></div>');
                    $btn.button('reset')
                }
            },
            error: function() {
                $btn.button('reset')
            }
        });
    });
    </script>
</body>

<!-- Mirrored from zoyothemes.com/silva/html/auth-login by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Oct 2024 05:42:43 GMT -->

</html>