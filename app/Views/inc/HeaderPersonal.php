<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>OneKill</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <link href="<?php echo _WEB_ROOT; ?>/img/favicon.png" rel="icon">
  <link href="<?php echo _WEB_ROOT; ?>/public/img/apple-touch-icon.png" rel="apple-touch-icon">



  <link href="<?php echo _WEB_ROOT; ?>/public/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo _WEB_ROOT; ?>/public/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link href="<?php echo _WEB_ROOT; ?>/public/css/infor.css" rel="stylesheet">



  <!-- --------------------------- -->

  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="manifest" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/manifest.json">
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="<?php echo _WEB_ROOT; ?>/public/css/theme.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/vendor/simple-datatables/style.css">

</head>

<body>


  <header id="header" class="header fixed-top d-flex align-items-center">

    <a class="navbar-brand m-3" href="<?php echo _WEB_ROOT; ?>"><img
        src="<?php echo _WEB_ROOT; ?>/public/img/gallery/logo.png" width="118" alt="logo" /></a>
    <i class="bi bi-list toggle-sidebar-btn" style="margin-left:90px"></i>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block"
      style="margin-top: 0px; width: 70%; margin-left: 20%" data-navbar-on-scroll="data-navbar-on-scroll">


      <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
          style="position: absolute; right: -40px; top: -5px;"><span class="navbar-toggler-icon"> </span></button>


        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent"
          style="margin-right: -15%; background-color: #fff;">
          <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base " style="margin-top: -5px;">
            <li class="nav-item px-2" data-bs-toggle="collapse" id="userProfileRespionsive"
              data-bs-target="#userProfile" style="position: relative;"><img
                src="<?php echo _WEB_ROOT; ?>/public/img/gallery/laboratories.png" alt="" width="40px"
                style="border-radius: 50%;">
              <span class="text-dark"><?php echo $_SESSION['is_login']['fullname'] ?></span>
            </li>

            <?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 5) { ?>
              <li style="margin-top: -5px;" class="nav-item px-2 "><a class="nav-link"
                  href="<?php echo _WEB_ROOT; ?>/home/appointment"><i style="font-size: 22px;"
                    class="bi bi-calendar3 m-1"></i><span>Đặt lịch</span></a></li>
            <?php } ?>
            <li id="userProfileRespionsive" class="nav-item px-2">
              <a class="nav-link" href="<?php echo _WEB_ROOT; ?>/Personal/workCalendar">Lịch làm việc</a>
            </li>
            <li id="userProfileRespionsive" class="nav-item px-2"><a class="nav-link"
                href="<?php echo _WEB_ROOT; ?>/admin">Chức năng</a>
            </li>





            <li class="nav-item px-2">
              <button type="button" data-toggle="collapse" data-target="#userProfile" aria-expanded="false"
                aria-controls="userProfile" style="border: none; background-color: #fff; border-radius: 10px;">
                <img src="<?php echo _WEB_ROOT; ?>/public/img/users/user_account.png" alt="" width="40px"
                  style="border-radius: 50%; ">
              </button>
            </li>

            <li id="userProfileRespionsive" class="nav-item px-2"><a class="nav-link" href="#appointment"><span>Đăng
                  xuất</span></a></li>
          </ul>
          <div class="collapse multi-collapse" id="userProfile" class="collapse p-3 p-3 mb-5 bg-body"
            style="position: absolute; top: 50px; width: 250px; right: -120px; background-color: #fff; border-radius: 10px;  background-color: #fff; border-radius: 10px; box-shadow: 1px 2px 3px #000;">
            <div class="text-start text-dark border-bottom">
              <img class="m-2" src="<?php echo _WEB_ROOT; ?>/public/img/users/user_account.png" alt="" width="40px"
                style="border-radius: 50%;">
              <span class="text-center m-1"
                style="font-size: 14px;"><?php echo $_SESSION['is_login']['fullname'] ?></span>
            </div>

            <div class="m-2 border-bottom pb-2">
              <a class="text-decoration-none text-dark" href="<?php echo _WEB_ROOT; ?>/Personal">
                <i class="bi bi-person-circle text-info m-1"></i>
                <span>Hồ sơ cá nhân</span>
                <span style="font-size: 10px;">(<?php echo $_SESSION['is_login']['name_role'] ?>)</span>


              </a>
            </div>
            <?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 4) { ?>
              <div class="m-2 border-bottom pb-2">
                <a class="text-decoration-none text-dark" href="<?php echo _WEB_ROOT; ?>/Personal/workCalendar">
                  <i class="bi bi-calendar2-check text-info m-1"></i>
                  <span>Lịch làm việc</span>
                </a>
              </div>
            <?php } ?>
            <?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] != 4 && $_SESSION['is_login']['id_role'] != 5) { ?>
              <div class="m-2 border-bottom pb-2">
                <a class="text-decoration-none text-dark" href="<?php echo _WEB_ROOT; ?>/admin">
                  <i class="bi bi-gear text-info m-1"></i>
                  <span>Chức năng</span>
                </a>
              </div>
            <?php } ?>
            <div class="m-2 border-bottom pb-2">
              <a class="text-decoration-none text-dark" href="<?php echo _WEB_ROOT; ?>/account/logout">
                <i class="bi bi-box-arrow-right text-info m-1"></i>
                <span>Đăng xuất</span>
              </a>
            </div>


          </div>
        </div>
      </div>
    </nav>

  </header>

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="<?php echo _WEB_ROOT; ?>/Personal">
          <i class="bi bi-grid"></i>
          <span>Trang cá nhân</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 5) { ?>

        <li class="nav-item">
          <a class="nav-link collapsed" href="<?php echo _WEB_ROOT; ?>/Personal/medicalHistory">
            <i class="bi bi-file-earmark"></i>
            <span>Lịch sử khám bệnh</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="<?php echo _WEB_ROOT; ?>/Personal/listAppointment">
            <i class="bi bi-card-list"></i>
            <span>Lịch khám bệnh</span>
          </a>
        </li>
      <?php } ?>
      <!-- 

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li>

      

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>

  

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li> -->

    </ul>

  </aside><!-- End Sidebar-->