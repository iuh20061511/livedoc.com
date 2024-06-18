<!DOCTYPE html>
<html>

<head>
  <title>Quên mật khẩu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon.ico">

  <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT; ?>/public/css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

<body style="  background: url('<?php echo _WEB_ROOT; ?>/public/img/gallery/hero-bg.png');">
  <div class="container">
    <div class="row px-3">
      <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"
          style="background: url('<?php echo _WEB_ROOT; ?>/public/img/gallery/hero.png') center;">

        </div>

        <div class="card-body">
          <h4 class="title text-center mt-4">
            Quên tài khoản
          </h4>
          <form action="" class="form-box px-3" method="POST">
            <div class="form-input">
              <span><i class="fa fa-envelope-o"></i></span>
              <input type="email" name="email" placeholder="Nhập email..." tabindex="10" required>
              <p class="text-danger error">
                <?php
                if (!empty($error['email'])) {
                  echo $error['email'];
                } ?>
              </p>
            </div>


            <div class="mb-3">
              <input type="submit" value="Xác nhận" class="btn btn-primary form-control" name="sub_email">
            </div>

            <div class="text-center">
            <b><a href="<?php echo _WEB_ROOT; ?>/account/login" class="text-danger">
                Đăng nhập
              </a></b>
            </div>
            

        </div>

        <hr class="my-4">


        </form>
      </div>
    </div>
  </div>
  </div>
</body>

</html>