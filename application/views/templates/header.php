<?php  
$user = $this->db->get_where('tbl_login', ['username' => $this->session->userdata('username')])->row_array();
$uri = $this->uri->segment(1);
if($this->uri->segment(2)){
  $uri .= '/'.$this->uri->segment(2);
  if($this->uri->segment(3)){
    $uri .= '/'.$this->uri->segment(3);
    if($this->uri->segment(4)){
      $uri .= '/'.$this->uri->segment(4);
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="" type="image/ico" />

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="<?= base_url() ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url() ?>vendors/fontawesome5/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url() ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?= base_url() ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?= base_url() ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

    
    <link href="<?= base_url() ?>vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>


    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>build/css/custom.min.css" rel="stylesheet">
    
    
    <!-- jQuery -->
    <script src="<?= base_url() ?>vendors/jquery/dist/jquery.min.js"></script>
    
    <!-- PNotify -->
    <link href="<?= base_url() ?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url() ?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    
  </head>
  <body class="nav-md">
  
  

  <div class="container body">
      <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
              <a style="height: 100%; font-size: 17px; line-height: 20px; padding-top: 10px" href="<?= site_url('') ?>" class="site_title"><span></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img style="width: 60px; height: 60px" src="" alt="..." class="img-circle profile_img mCS_img_loaded">
              </div>
              <div class="profile_info">
                <span>Selamat datang,</span><?php
                if ($this->session->userdata('role_id') != 5) { ?>
                <h2><?= $user['name'] ?></h2>
                <?php }
                else{ ?>
                <h2><?= $this->session->userdata('username') ?></h2>
                <?php } ?>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br>

            <!-- sidebar menu -->
            <div style="margin-top: -20px" id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section active">
                <ul class="nav side-menu" style="">
                <?php
                if ($this->session->userdata('role_id') == 5) { ?>
                <li class="<?= ($title == 'Files') ? 'active' : NULL ; ?>"><a href="<?= site_url('FileSiswa') ?>"><i class="fa fa-file-alt"></i> Files</a>
                  <ul class="nav" style="display: block;">
                  </ul>
                </li>
                <?php }else{
                if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3) {
                ?>
                  <li class="<?= ($title == 'Dashboard') ? 'active' : NULL ; ?>"><a href="<?= site_url('home') ?>"><i class="fa fa-home"></i>Dashboard</a>
                    <ul class="nav" style="display: block;">
                    </ul>
                  </li>
                  
                  <?php } 
                  if ($this->session->userdata('role_id') == 4) {
                    $nip  = $this->db->get_where('tbl_login',['username' => $this->session->userdata('username')])->row()->nip;
                    if ($nip != NULL) { ?>
                      <li class="<?= ($title == 'Absen') ? 'active' : NULL ; ?>"><a href="<?= site_url('absen') ?>"><i class="fa fa-calendar"></i>Absen</a>
                        <ul class="nav" style="display: block;">
                        </ul>
                      </li>
                    <?php
                    } ?>
                    <li class="<?= ($title == 'Files') ? 'active' : NULL ; ?>"><a href="<?= site_url('Files/private') ?>"><i class="fa fa-file-alt"></i> Files</a>
                      <ul class="nav" style="display: block;">
                      </ul>
                    </li>
                    <?php
                  }
                  else { ?>
                  <?php }
                  if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3) {
                  ?>
                  <li><a><i class="fa fa-users"></i>Anggota<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= site_url('anggota/form') ?>"><i class="fa fa-user-plus"></i> Tambah Anggota</a></li>
                      <li><a href="<?= site_url('anggota/') ?>"><i class="fa fa-table"></i> Data Anggota</a></li>
                    </ul>
                  </li>
                  <?php } ?>
                  <?php
                  if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3) {
                  ?>
                  <?php }} ?>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <?php
                if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3) {
              ?>
              <?php } ?>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>
      </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="" alt=""><?= $user['username'] ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    
                    <li><a href="<?= base_url('auth/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
