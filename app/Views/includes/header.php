<?php $this->session = \Config\Services::session(); ?>
<style type="text/css">
    div.jtable-main-container table.jtable tbody > tr > td .jtable-delete-command-button {
        background: none;
        width: 32px !important;
        height: 32px !important;
      }
      .modal-header .close {
        margin-left: auto;
        background-color: red;
        border: none;
       }
       .breadcrumb-item + .breadcrumb-item::before {
            content: none;
        }
</style>
<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button class="button-toggle-menu nav-link">
                        <i data-feather="menu" class="noti-icon"></i>
                    </button>
                </li>
                <li class="d-none d-lg-block">
                    <li class="d-none d-lg-block">
                        <h5 class="mb-0">Welcome, <?=$this->session->get('user_name');?></h5>
                    </li>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                <li class="d-none d-lg-block">
                     
                </li> 
                 
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <i data-feather="maximize" class="align-middle fullscreen noti-icon"></i>
                    </button>
                </li>
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?=base_url();?>img/user.jpg" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            <?=$this->session->get('user_name');?> <i class="mdi mdi-chevron-down"></i> 
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a class='dropdown-item notify-item'>
                            <i class="mdi mdi-key-outline fs-16 align-middle"></i>
                            <span>Change Password</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a class='dropdown-item notify-item' href='<?=base_url();?>login/logout'>
                            <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                            <span>Sign out</span>
                        </a>

                    </div>
                </li>

            </ul>
        </div>

    </div>
   
</div>