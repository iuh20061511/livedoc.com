<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <title>Livedoc</title>



  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon.ico">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <link rel="manifest" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="<?php echo _WEB_ROOT; ?>/public/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">


  <link href="<?php echo _WEB_ROOT; ?>/public/css/theme.css" rel="stylesheet" />
  <link href="<?php echo _WEB_ROOT; ?>/public/admin/css/theme.css" rel="stylesheet" media="all">
</head>


<body>


  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block"
      data-navbar-on-scroll="data-navbar-on-scroll">
      <div class="container"><a class="navbar-brand" href="<?php echo _WEB_ROOT; ?>"><img
            src="<?php echo _WEB_ROOT; ?>/public/img/gallery/logo.png" width="118" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
            class="navbar-toggler-icon"> </span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
            <?php if (isset($_SESSION['login'])) { ?>
              <li class="nav-item px-2" data-bs-toggle="collapse" id="userProfileRespionsive"
                data-bs-target="#userProfile" style="position: relative;"><img
                  src="<?php echo _WEB_ROOT; ?>/public/img/gallery/laboratories.png" alt="" width="40px"
                  style="border-radius: 50%;">
                <span class="text-dark">
                  <?php echo $_SESSION['is_login']['fullname'] ?>
                </span>
              </li>

            <?php } ?>
            <li class="nav-item px-2"><a class="nav-link" aria-current="page" href="#home">Giới thiệu</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="#department">Bộ phận</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="#doctor">Bác sĩ</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="#posts">Bài viết</a></li>

            <?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 5) { ?>
              <li style="margin-top: -5px;" class="nav-item px-2 "><a class="nav-link"
                  href="<?php echo _WEB_ROOT; ?>/home/appointment"><i style="font-size: 22px;"
                    class="bi bi-calendar3 m-1"></i><span>Đặt lịch</span></a></li>
            <?php } ?>
            <?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] == 4) { ?>
              <li id="userProfileRespionsive" class="nav-item px-2"><a class="nav-link" href="#appointment">Lịch làm
                  việc</a></li>
            <?php } ?>

            <?php if (isset($_SESSION['is_login']['id_role']) && $_SESSION['is_login']['id_role'] != 4 && $_SESSION['is_login']['id_role'] != 5) { ?>
              <li id="userProfileRespionsive" class="nav-item px-2"><a class="nav-link"
                  href="<?php echo _WEB_ROOT; ?>/admin">Chức năng</a>
              </li>
            <?php } ?>


            <li id="userProfileRespionsive" class="nav-item px-2"><a class="nav-link" href="#appointment"><span>Đăng
                  xuất</span></a></li>





            <?php if (isset($_SESSION['is_login'])) { ?>
              <li class="nav-item px-2">
                <button type="button" data-toggle="collapse" data-target="#userProfile" aria-expanded="false"
                  aria-controls="userProfile">
                  <img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $_SESSION['is_login']['image'] ?>" alt=""
                    width="40px" style="border-radius: 50%; height: 40px;">
                </button>
              </li>
            <?php } else { ?>
              <li class="nav-item px-2 mb-2"><a class="nav-link badge bg-secondary rounded text-light p-2"
                  href="<?php echo _WEB_ROOT; ?>/account/login">Đăng
                  nhập</a></li>
              <li class="nav-item px-2"><a class="nav-link badge bg-danger rounded text-light p-2"
                  href="<?php echo _WEB_ROOT; ?>/account/register">Đăng
                  kí</a></li>
            <?php } ?>
          </ul>

          <div class="collapse multi-collapse " id="userProfile" class="collapse p-3 shadow-sm p-3 mb-5 bg-body"
            style="position: absolute; top: 60px; width: 250px; right: 20px; background-color: #fff; border-radius: 10px; box-shadow: 1px 2px 3px #000;">
            <div class="text-start text-dark border-bottom">
              <img class="m-2"
                src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $_SESSION['is_login']['image'] ?>" alt=""
                width="40px" style="border-radius: 50%; height: 40px;">
              <span class="" style="font-size: 14px;">
                <?php echo $_SESSION['is_login']['fullname'] ?>
              </span>

            </div>

            <div class="m-2 border-bottom pb-2">
              <a class="text-decoration-none text-dark" href="<?php echo _WEB_ROOT; ?>/Personal">
                <i class="bi bi-person-circle text-info m-1"></i>
                <span>Hồ sơ cá nhân</span>
                <span style="font-size: 10px;">(
                  <?php echo $_SESSION['is_login']['name_role'] ?>)
                </span>

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