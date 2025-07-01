<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url() ?>favicon.ico" type="image/x-icon">
    <!-- Optional: you can also add a PNG favicon -->
    <link rel="icon" href="<?php echo base_url() ?>favicon.png" type="image/png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->session->userdata('business') ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url() ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url() ?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url() ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/starrr/dist/starrr.css" rel="stylesheet">
   
    <link href="<?php echo base_url() ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url() ?>vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url() ?>vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url() ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url() ?>build/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>build/css/custom_chat.css" rel="stylesheet">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/sweetalert/sweetalert.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url() ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Dropzone.js -->
    <link href="<?php echo base_url() ?>vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/fullcalendar/dist/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <link href="<?php echo base_url() ?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="https://onixlabs.tech/SalamInfinity/namecard/style.css" /> -->
    <style type="text/css">
      @media print {
        .fa-bars.no-print {
          display: none !important;
        }
        .dropdown.no-print {
          display: none !important;
        }
        .dropdown-toggle.no-print {
          display: none !important; 
        }
      }
      .fc-event,
      .fc-event-dot {
        background-color: #385645;
        color: #ffffff;
        border: solid 1px #385645;
      }
      a:focus, a:hover {
        color: #fff;
        text-decoration: underline;
      }
      .btn-success {
        background: #385645;
        border: 1px solid #385645;
      }
      .left_col {
        background: #385645;
      }
      .fc-unthemed td.fc-today {
        background: #ffd600;
      }
    </style>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url('cms/home') ?>" class="site_title"><img src="<?php echo base_url('assets/images/logo_sahira_group_white.png') ?>" width="25%"></a>
            </div>
            <div class="clearfix"></div>
            <input type="hidden" name="RateNow" id="RateNow">
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- <img src="images/img.jpg" alt="..." class="img-circle profile_img"> -->
              </div>
              <div class="profile_info">
                <span><?php echo $this->session->userdata('business') ?></span>
                <h2><?php echo substr($this->session->userdata('emailuser'), 0, 28) ?>..</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <!-- <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('cms/home') ?>">Dashboard</a></li>
                      <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 7 || $this->session->userdata('level') == 3) { ?>
                        <li><a href="<?php echo base_url('cms/home/chat') ?>">Live Chat</a></li>
                      <?php } ?>
                      <li><a href="<?php echo base_url('cms/home/editKaryawan/'.$this->session->userdata('idKaryawan').'/') ?>">Profile</a></li>
                      <li><a href="<?php echo base_url('cms/home/dev') ?>">Dev</a></li>
                    </ul>
                  </li> -->
                  <?php
                    $access = array();
                    $accessName = array();
                    $this->db->from('access');
                    $this->db->where('idUser', $this->session->userdata('idUser'));
                    $query = $this->db->get();
                    if ($query->num_rows() > 0)
                    {
                      foreach ($query->result() as $row)
                      {
                        $data[] = $row;
                        $accessName[] = $row->menuName;
                      }
                    }
                    $query->free_result();
                    if (count($accessName) == 0 && $this->session->userdata('level') == 1) {
                      $accessName = array("HRD", "ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL", "RATE_STRUCTURE", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB", "TOOL_MARKETING");
                    }
                    if (count($accessName) == 0 && $this->session->userdata('level') == 2) {
                      $accessName = array("ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL");
                    }
                    if (count($accessName) == 0 && $this->session->userdata('level') == 3) {
                      $accessName = array("HRD", "ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL", "RATE_STRUCTURE", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB", "VOUCHER_CATALOG");
                    }
                    if (count($accessName) == 0 && $this->session->userdata('level') == 4) {
                      $accessName = array("ROOM_REPORT", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB");
                    }
                    if (count($accessName) == 0 && $this->session->userdata('level') == 5) {
                      $accessName = array("ROOM_REPORT", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB");
                    }
                    if (count($accessName) == 0 && $this->session->userdata('level') == 6) {
                      if ($this->session->userdata('dep') == 5) {
                        $accessName = array("FNB", "VOUCHER_CATALOG");
                      } else if ($this->session->userdata('dep') == 8) {
                        $accessName = array("FRONT_OFFICE");
                      } else if ($this->session->userdata('dep') == 7) {
                        $accessName = array("HOUSE_KEEPING");
                      } else if ($this->session->userdata('dep') == 10) {
                        $accessName = array("TOOL_MARKETING");
                      }
                    }
                    if (count($accessName) == 0 && $this->session->userdata('level') == 7) {
                      $accessName = array("BUSINESS_DEVELOPMENT", "APP_SETTING", "HRD", "ROOM_REPORT", "INVESTMENT_HOTEL", "BUDGETING_HOTEL", "RATE_STRUCTURE", "INVENTORY", "MEMBERSHIP", "HOUSE_KEEPING", "FRONT_OFFICE", "FNB", "VOUCHER_CATALOG");
                    }
                  ?>
                  <?php if($this->session->userdata('dep') == 4) { ?>
                  <li><a><i class="fa fa-user"></i> Filling & Recording <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="#">Karyawan<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo base_url('cms/home/viewKaryawan') ?>">View</a></li>
                          <li><a href="<?php echo base_url('cms/home/inputKaryawan') ?>">Input</a></li>
                        </ul>
                      </li>
                      <li><a href="<?php echo base_url('cms/home/sop') ?>">SOP</a></li> -->
                      <li><a href="<?php echo base_url('cms/home/training') ?>">Training Module</a></li>
                    </ul>
                  </li>
                  <?php } ?>
                  <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 7) { ?>
                  <li><a><i class="fa fa-list"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('cms/home/reportkeuangan') ?>">Keuangan</a></li>
                      <li><a href="<?php echo base_url('cms/home/reportengineering') ?>">Engineering</a></li>
                      <li><a href="<?php echo base_url('cms/home/reporthousekeeping') ?>">Housekeeping</a></li>
                      <li><a href="<?php echo base_url('cms/home/reportsecurity') ?>">Security</a></li>
                    </ul>
                  </li>
                  <?php } ?>
                  <!-- <li><a href="#">Business User<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('cms/home/viewKaryawan') ?>">View</a></li>
                      <li><a href="<?php echo base_url('cms/home/inputKaryawan') ?>">Input</a></li>
                    </ul>
                  </li> -->
                  <?php
                    if (in_array("FNB", $accessName)) {
                  ?>
                  <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 7) { ?>
                    <li><a><i class="fa fa-database"></i> Food Center <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <?php
                        $business = array();
                        if ($this->session->userdata('level') == '1') {
                          $this->db->from('Business_Detail');
                          $this->db->where('typeBusiness', 'HOTEL');
                          $this->db->where('idGroup', $this->session->userdata('idGroup'));
                        } else if ($this->session->userdata('level') == '7') {
                          $this->db->from('Business_Detail');
                          $this->db->where('typeBusiness', 'HOTEL');
                          $this->db->or_where('typeBusiness', 'CAFE');
                        }else {
                          $this->db->from('Business_Detail');
                          $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                          $this->db->where('typeBusiness', 'HOTEL');
                          $this->db->or_where('typeBusiness', 'CAFE');
                        }
                        $query = $this->db->get();
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            $business[] = $row;
                          }
                        }
                        $query->free_result();
                        foreach($business as $row) {
                          ?>
                          <li><a href="#"><?php echo substr($row->Name, 0, 23) ?>..<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <!-- <li><a href="<?php echo base_url('cms/home/viewFnbDashboard/'.$row->idBusiness.'/') ?>">Dashboard</a></li> -->
                              <li><a href="<?php echo base_url('cms/home/viewAdditionalFnb/'.$row->idBusiness.'/') ?>">Input Additional Bill</a></li>
                              <li><a href="<?php echo base_url('cms/home/viewReportFnb/'. $row->idBusiness.'/') ?>">View Report Bill</a></li>
                              <li><a href="<?php echo base_url('cms/home/viewFnBmenu/'.$row->idBusiness.'/') ?>">View Menu </a></li>
                              <li><a href="<?php echo base_url('cms/home/inputFnbMenu/'.$row->idBusiness.'/') ?>">Input Menu </a></li>
                              <li><a href="<?php echo base_url('cms/home/viewFnbMenuType/'.$row->idBusiness.'/') ?>">View Category Menu </a></li>
                              <li><a href="<?php echo base_url('cms/home/inputFnbMenuType/'.$row->idBusiness.'/') ?>">Input Category Menu </a></li>
                            </ul>
                          </li>
                        <?php } ?>
                      </ul>
                    </li>
                    <?php } else { ?>
                      <li><a><i class="fa fa-cutlery"></i> Food & Beverage <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <!-- <li><a href="<?php echo base_url('cms/home/viewFnbDashboard/'. $this->session->userdata('idBusiness')  . '/') ?>">Dashboard</a></li> -->
                          <?php if($this->session->userdata('level') == '5' || $this->session->userdata('level') == '7') { ?>
                            <li><a href="<?php echo base_url('cms/home/viewAdditionalFnb/'. $this->session->userdata('idBusiness')  . '/') ?>">Input Additional Bill</a></li>
                            <li><a href="<?php echo base_url('cms/home/viewReportFnb/'. $this->session->userdata('idBusiness')  . '/') ?>">View Report Bill</a></li>
                          <?php } else { ?>
                          <li><a href="<?php echo base_url('cms/home/viewFnBmenu/'.$this->session->userdata('idBusiness').'/') ?>">View Menu </a></li>
                          <li><a href="<?php echo base_url('cms/home/inputFnbMenu/'.$this->session->userdata('idBusiness').'/') ?>">Input Menu </a></li>
                          <li><a href="<?php echo base_url('cms/home/viewFnbMenuType/'.$this->session->userdata('idBusiness').'/') ?>">View Category Menu </a></li>
                          <li><a href="<?php echo base_url('cms/home/inputFnbMenuType/'.$this->session->userdata('idBusiness').'/') ?>">Input Category Menu </a></li>
                          <?php } ?>
                        </ul>
                      </li>
                      <?php
                      if (in_array("VOUCHER_CATALOG", $accessName)) {
                        ?>
                        <li><a><i class="fa fa-coupon"></i> Voucher Catalog <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li><a href="<?php echo base_url('cms/home/viewVoucherCatalog') ?>">View Voucher Catalog</a></li>
                            <li><a href="<?php echo base_url('cms/home/viewClaimVoucherCatalog') ?>">View Claim Voucher Catalog</a></li>
                            <li><a href="<?php echo base_url('cms/home/viewOrderVoucherCatalog') ?>">View Order Voucher Catalog</a></li>
                          </ul>
                        </li>
                      <?php
                      }
                      ?>
                    <?php } ?>
                  <?php
                    }
                  ?>
                  <!-- level HO s/d GM -->
                    <?php
                    if (in_array("BUSINESS_DEVELOPMENT", $accessName)) {
                      ?>
                      <?php
                        if ($this->session->userdata('level') != '1') {
                      ?>
                      <!-- <li><a><i class="fa fa-user"></i> Bis Dev <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a>Business Detail<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('cms/home/viewBusinessDetail') ?>">View Business</a></li>
                              <li><a href="<?php echo base_url('cms/home/inputBusinessDetail') ?>">Insert Business</a></li>
                            </ul>
                          </li>
                          <li><a href="#">Business User<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('cms/home/viewKaryawan') ?>">View</a></li>
                              <li><a href="<?php echo base_url('cms/home/inputKaryawan') ?>">Input</a></li>
                            </ul>
                          </li>
                        </ul>
                      </li> -->
                      <li><a><i class="fa fa-home"></i> Site Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 7 || $this->session->userdata('level') == 3) { ?>
                            <li><a href="<?php echo base_url('cms/home/viewSiteSettingHeader') ?>">Main Header</a></li>
                            <li><a href="<?php echo base_url('cms/home/viewSiteSettingHeaderMeta') ?>">Header Meta</a></li>
                            <li><a href="#">Unit Settings<span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                <?php
                                  $business = array();
                                  if ($this->session->userdata('level') == '1') {
                                    $this->db->from('Business_Detail');
                                    $this->db->where('typeBusiness', 'HOTEL');
                                  } else if ($this->session->userdata('level') == '7') {
                                    $this->db->from('Business_Detail');
                                    $this->db->where('typeBusiness', 'HOTEL');
                                  } else {
                                    $this->db->from('Business_Detail');
                                    $this->db->where('typeBusiness', 'HOTEL');
                                    $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                                  }
                                  $query = $this->db->get();
                                  if ($query->num_rows() > 0) {
                                    foreach ($query->result() as $row) {
                                      $business[] = $row;
                                    }
                                  }
                                  $query->free_result();
                                  foreach($business as $row) {
                                ?>
                                <li><a href="#"><?php echo substr($row->Name, 0, 15) ?>..<span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu">
                                    <li><a href="<?php echo base_url('cms/home/viewSiteSettingHeaderHotel/'.$row->idBusiness.'/') ?>">Header</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewSiteSettingSliderHotel/'.$row->idBusiness.'/') ?>">Sliders</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewSiteSettingTestimonialsHotel/'.$row->idBusiness.'/') ?>">Testimonials</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewSiteSettingJoinMemberHotel/'.$row->idBusiness.'/') ?>">Join Member</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewSiteSettingStayInTouchHotel/'.$row->idBusiness.'/') ?>">Stay In Touch</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewSiteSettingFacilitiesHotel/'.$row->idBusiness.'/') ?>">Facilities</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewSiteSettingGalleryHotel/'.$row->idBusiness.'/') ?>">Gallery</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewPackage/'.$row->idBusiness.'/') ?>">Special Offers</a></li>
                                    <li><a href="<?php echo base_url('cms/home/viewKamar/'.$row->idBusiness.'/') ?>">Rooms</a></li>
                                  </ul>
                                </li>
                                <?php } ?>
                              </ul>
                            </li>
                            <li><a href="#">Home<span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingSlider') ?>">Sliders</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingOurHotels') ?>">Our Hotels</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingHomeOffers') ?>">Special Offers</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingTestimonials') ?>">Testimonials</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingLocalAttractions') ?>">Local Attractions</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingJoinMember') ?>">Join Member</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingStayInTouch') ?>">Stay In Touch</a></li>
                              </ul>
                            </li>
                            <li><a href="#">About Us<span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                <li><a href="<?php echo base_url('cms/home/viewSiteSettingAbout') ?>">About Us</a></li>
                                <!-- <li><a href="<?php echo base_url('cms/home/viewSiteSettingGallery') ?>">Gallery</a></li> -->
                              </ul>
                            </li>
                            <li><a href="<?php echo base_url('cms/home/viewNewsletter') ?>">Input Email Newsletter</a></li>
                            <li><a href="<?php echo base_url('cms/home/viewNotificationCenter') ?>">Input Notification Center</a></li>
                          <?php } ?>
                          <li><a href="<?php echo base_url('cms/home/viewSiteSettingPressRelease') ?>">Press Release</a></li>
                          <li><a href="<?php echo base_url('cms/home/viewSiteSettingCareer') ?>">Career</a></li>
                        </ul>
                      </li>
                      <?php
                      }
                      ?>
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("APP_SETTING", $accessName)) {
                      ?>
                      <!-- <li><a><i class="fa fa-mobile"></i> App Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo base_url('cms/home/viewApplicationSettings') ?>">Input Background Discover</a></li>
                          <li><a href="<?php echo base_url('cms/home/inputFacility/'.$this->session->userdata('idBusiness').'/') ?>">Input facility icon</a></li>
                        </ul>
                      </li> -->
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("HRD", $accessName)) {
                      ?>
                      
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("ROOM_REPORT", $accessName)) {
                      ?>
                      <!-- <li><a><i class="fa fa-database"></i> Room & Report<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php
                            $business = array();
                            if ($this->session->userdata('level') == '1') {
                              $this->db->from('Business_Detail');
                              $this->db->where('typeBusiness', 'HOTEL');
                              $this->db->where('idGroup', $this->session->userdata('idGroup'));
                            } else if ($this->session->userdata('level') == '7') {
                              $this->db->from('Business_Detail');
                              $this->db->where('typeBusiness', 'HOTEL');
                            } else {
                              $this->db->from('Business_Detail');
                              $this->db->where('typeBusiness', 'HOTEL');
                              $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                            }
                            $query = $this->db->get();
                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $business[] = $row;
                              }
                            }
                            $query->free_result();
                            foreach($business as $row) {
                          ?>
                          <li><a href="#"><?php echo substr($row->Name, 0, 23) ?>..<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="#">Pembayaran<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url('cms/home/viewPembayaran/'.$row->idBusiness.'/') ?>">View Daftar Pembayaran</a></li>
                                  <li><a href="<?php echo base_url('cms/home/viewBuktiPembayaran/'.$row->idBusiness.'/') ?>">View Bukti Pembayaran</a></li>
                                  <li><a href="<?php echo base_url('cms/home/viewADP/'.$row->idBusiness.'/') ?>">View ADP</a></li>
                                </ul>
                              </li>
                              <li><a href="<?php echo base_url('cms/home/viewReport/'.$row->idBusiness.'/') ?>">Data Report</a></li>
                              <li><a href="<?php echo base_url('cms/home/viewKamar/'.$row->idBusiness.'/') ?>">View Kamar</a></li>
                            </ul>
                          </li>
                          <?php } ?>
                        </ul>
                      </li> -->
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("FRONT_OFFICE", $accessName)) {
                    ?>
                    <?php if($this->session->userdata('level') == 7 || $this->session->userdata('level') == 6) { ?>
                      <li><a><i class="fa fa-database"></i> Front Office<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php if ($this->session->userdata('level') == '7') { ?>
                          <?php
                            $business = array();
                            if ($this->session->userdata('level') == '1') {
                              $this->db->from('Business_Detail');
                              $this->db->where('typeBusiness', 'HOTEL');
                              $this->db->where('idGroup', $this->session->userdata('idGroup'));
                            } else if ($this->session->userdata('level') == '7') {
                              $this->db->from('Business_Detail');
                              $this->db->where('typeBusiness', 'HOTEL');
                            } else {
                              $this->db->from('Business_Detail');
                              $this->db->where('typeBusiness', 'HOTEL');
                              $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                            }
                            $query = $this->db->get();
                            if ($query->num_rows() > 0) {
                              foreach ($query->result() as $row) {
                                $business[] = $row;
                              }
                            }
                            $query->free_result();
                            foreach($business as $row) {
                          ?>
                          <li><a href="#"><?php echo substr($row->Name, 0, 23) ?>..<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <!-- <li><a href="<?php echo base_url('cms/home/inputBooking/'.$row->idBusiness.'/') ?>">Booking Room</a></li> -->
                              <li><a href="<?php echo base_url('cms/home/viewBooking/'.$row->idBusiness.'/') ?>">Data Booking</a></li>
                              <!-- <li><a href="<?php echo base_url('cms/home/viewCheckout') ?>">Data Checkout</a></li>
                              <li><a href="<?php echo base_url('cms/home/viewRoomAttendantFO') ?>">Data Kamar</a></li>
                              <li><a href="<?php echo base_url('cms/home/inputBookingMeeting') ?>">Paket Grup</a></li>
                              <li><a href="#">Data Grup<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url('cms/home/viewDataPaketMeeting') ?>">List Paket Group</a></li>
                                  <?php if($nopage == 32) {
                                  ?>
                                  <li><a href="<?php echo base_url('cms/home/inputAdditionalBookingMeeting/'.$new_invoice_number.'/') ?>">Detail</a></li>
                                  <li><a href="<?php echo base_url('cms/home/inputMemberRoomMeeting/'.$new_invoice_number.'/') ?>">Detail Room</a></li>
                                  <?php
                                  }
                                  ?>
                                </ul>
                              </li>
                              <li><a>Company <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url('cms/home/viewCompany') ?>">List Company</a></li>
                                  <li><a href="<?php echo base_url('cms/home/viewCompanyMember') ?>">List Company Member</a></li>
                                </ul>
                              </li>
                              <li><a href="<?php echo base_url('cms/home/viewKamar/'.$row->idBusiness.'/') ?>">View Kamar</a></li>
                              <li><a>Rate Structure <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url('cms/home/viewRateStructure/'.$row->idBusiness.'/') ?>">Rate Structure</a></li>
                                </ul>
                              </li> -->
                            </ul>
                          </li>
                          <?php 
                            } 
                          } else {
                          ?>
                          <li><a><i class="fa fa-database"></i> Front Office<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <!-- <li><a href="<?php echo base_url('cms/home/inputBooking/'.$this->session->userdata('idBusiness').'/') ?>">Booking Room</a></li> -->
                              <li><a href="<?php echo base_url('cms/home/viewBooking/'.$this->session->userdata('idBusiness').'/') ?>">Data Booking</a></li>
                              <!-- <li><a href="<?php echo base_url('cms/home/viewCheckout') ?>">Data Checkout</a></li>
                              <li><a href="<?php echo base_url('cms/home/viewRoomAttendantFO') ?>">Data Kamar</a></li>
                              <li><a href="<?php echo base_url('cms/home/inputBookingMeeting') ?>">Paket Grup</a></li>
                              <li><a href="#">Data Grup<span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url('cms/home/viewDataPaketMeeting') ?>">List Paket Group</a></li>
                                  <?php if($nopage == 32) {
                                  ?>
                                  <li><a href="<?php echo base_url('cms/home/inputAdditionalBookingMeeting/'.$new_invoice_number.'/') ?>">Detail</a></li>
                                  <li><a href="<?php echo base_url('cms/home/inputMemberRoomMeeting/'.$new_invoice_number.'/') ?>">Detail Room</a></li>
                                  <?php
                                  }
                                  ?>
                                </ul>
                              </li>
                              <li><a>Company <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url('cms/home/viewCompany') ?>">List Company</a></li>
                                  <li><a href="<?php echo base_url('cms/home/viewCompanyMember') ?>">List Company Member</a></li>
                                </ul>
                              </li>
                              <li><a href="<?php echo base_url('cms/home/viewKamar/'.$this->session->userdata('idBusiness').'/') ?>">View Kamar</a></li>
                              <li><a>Rate Structure <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url('cms/home/viewRateStructure/'.$this->session->userdata('idBusiness').'/') ?>">Rate Structure</a></li>
                                </ul>
                              </li> -->
                            </ul>
                          </li>
                          <?php
                          }
                          ?>
                        </ul>
                      </li>
                      <li><a><i class="fa fa-users"></i> Membership <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo base_url('cms/home/viewMembership') ?>">List Membership</a></li>
                        </ul>
                      </li>
                      <?php if($this->session->userdata('level') == 7) { ?>
                      <li><a><i class="fa fa-user"></i> HRD <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="#">Karyawan<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('cms/home/viewKaryawan') ?>">View</a></li>
                              <li><a href="<?php echo base_url('cms/home/inputKaryawan') ?>">Input</a></li>
                            </ul>
                          </li>
                          <!-- <li><a href="<?php echo base_url('cms/home/sop') ?>">SOP</a></li> -->
                          <li><a href="<?php echo base_url('cms/home/training') ?>">Filling & Recording</a></li>
                        </ul>
                      </li>
                      <!-- <li><a href="#">Business User<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo base_url('cms/home/viewKaryawan') ?>">View</a></li>
                          <li><a href="<?php echo base_url('cms/home/inputKaryawan') ?>">Input</a></li>
                        </ul>
                      </li> -->
                      <?php } ?>
                    <?php } ?>
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("INVESTMENT_HOTEL", $accessName)) {
                      ?>
                      <!-- <li><a><i class="fa fa-database"></i> Investment Hotels<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php
                          $business = array();
                          if ($this->session->userdata('level') == '1') {
                            $this->db->from('Business_Detail');
                            $this->db->where('typeBusiness', 'HOTEL');
                            $this->db->where('idGroup', $this->session->userdata('idGroup'));
                          } else if ($this->session->userdata('level') == '7') {
                            $this->db->from('Business_Detail');
                            $this->db->where('typeBusiness', 'HOTEL');
                          }else {
                            $this->db->from('Business_Detail');
                            $this->db->where('typeBusiness', 'HOTEL');
                            $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                          }
                          $query = $this->db->get();
                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                              $business[] = $row;
                            }
                          }
                          $query->free_result();
                          foreach($business as $row) {
                          ?>
                          <li><a href="#"><?php echo substr($row->Name, 0, 23) ?>..<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('cms/home/viewInvestmentFIT/'.$row->idBusiness.'/') ?>">View Data FIT</a></li>
                              <li><a href="<?php echo base_url('cms/home/viewInvestmentOTA/'.$row->idBusiness.'/') ?>">View Data OTA</a></li>
                            </ul>
                          </li>
                          <?php } ?>
                        </ul>
                      </li> -->
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("BUDGETING_HOTEL", $accessName)) {
                      ?>
                      <!-- <li><a><i class="fa fa-calendar"></i> Budgeting Hotels <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo base_url('cms/home/viewMonthlyBudget/'.$this->session->userdata('idBusiness').'/') ?>">Mounthly</a></li>
                        </ul>
                      </li> -->
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("RATE_STRUCTURE", $accessName)) {
                      ?>
                      <!-- <li><a><i class="fa fa-bars"></i> Rate Structure <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo base_url('cms/home/viewRateStructure/'.$this->session->userdata('idBusiness').'/') ?>">Rate Structure</a></li>
                        </ul>
                      </li> -->
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("INVENTORY", $accessName)) {
                      ?>
                      <!-- <li><a><i class="fa fa-recycle"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo base_url('cms/home/viewInventory') ?>">View Inventory</a></li>
                          <li><a href="<?php echo base_url('cms/home/viewInventoryType') ?>">View Type Barang</a></li>
                        </ul>
                      </li> -->
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("MEMBERSHIP", $accessName)) {
                      ?>
                      
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("HOUSE_KEEPING", $accessName)) {
                    ?>
                      <li><a><i class="fa fa-database"></i> Room Attendant<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php
                          $business = array();
                          if ($this->session->userdata('level') == '1') {
                            $this->db->from('Business_Detail');
                            $this->db->where('typeBusiness', 'HOTEL');
                            $this->db->where('idGroup', $this->session->userdata('idGroup'));
                          } else if ($this->session->userdata('level') == '7') {
                            $this->db->from('Business_Detail');
                            $this->db->where('typeBusiness', 'HOTEL');
                          }else {
                            $this->db->from('Business_Detail');
                            $this->db->where('typeBusiness', 'HOTEL');
                            $this->db->where('idBusiness', $this->session->userdata('idBusiness'));
                          }
                          $query = $this->db->get();
                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $row) {
                              $business[] = $row;
                            }
                          }
                          $query->free_result();
                          foreach($business as $row) {
                          ?>
                          <li><a href="#"><?php echo substr($row->Name, 0, 23) ?>..<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('cms/home/viewRoomAttendant/'.$row->idBusiness.'/') ?>">Room Attendant</a></li>
                            </ul>
                          </li>
                          <?php } ?>
                        </ul>
                      </li>
                    <?php
                    }
                    ?>
                    <?php
                    if (in_array("TOOL_MARKETING", $accessName)) {
                      ?>
                      <!-- <li><a><i class="fa fa-mobile"></i> Tool Marketing <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php
                          if (in_array("VOUCHER_CATALOG", $accessName)) {
                            ?>
                            <li><a>Voucher Catalog <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                <li><a href="<?php echo base_url('cms/home/viewVoucherCatalog') ?>">View Voucher Catalog</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewClaimVoucherCatalog') ?>">View Claim Voucher Catalog</a></li>
                                <li><a href="<?php echo base_url('cms/home/viewOrderVoucherCatalog') ?>">View Order Voucher Catalog</a></li>
                              </ul>
                            </li>
                          <?php
                          }
                          ?>
                          <li><a href="<?php echo base_url('cms/home/viewNewsletter/'.$this->session->userdata('idBusiness').'/') ?>">Input Email Newsletter</a></li>
                          <li><a href="<?php echo base_url('cms/home/viewNotificationCenter/'.$this->session->userdata('idBusiness').'/') ?>">Input Notification Center</a></li>
                          <?php
                          if ($this->session->userdata('dep') == '1') {
                          ?>
                          <li><a>Business Detail<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                              <li><a href="<?php echo base_url('cms/home/viewBusinessDetail') ?>">View Business</a></li>
                              <li><a href="<?php echo base_url('cms/home/inputBusinessDetail') ?>">Insert Business</a></li>
                            </ul>
                          </li>
                          <?php
                          } ?>
                        </ul>
                      </li> -->
                    <?php
                    }
                    ?>
                  <?php 
                    if($this->session->userdata('level') == 7) {
                  ?>
                  <li><a href="<?php echo base_url('cms/home/viewlog') ?>"><i class="fa fa-list"></i> Log user</a>
                  <?php
                    }
                  ?>
                  <li><a href="<?php echo base_url('cms/home/logout') ?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        <div class="top_nav">
          <div class="nav_menu">
            <div class="nav toggle">
              <a id="menu_toggle">
                <i class="fa fa-bars"></i>
              </a>
            </div>
          </div>
        </div>