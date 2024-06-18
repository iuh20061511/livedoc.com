<!DOCTYPE html>
<html>

<head>
  <title>Đăng kí</title>
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

        <div class="card-body col-lg-12">
          <h4 class="title text-center mt-4">
            Đăng kí
          </h4>


          <form action="<?php echo _WEB_ROOT; ?>/account/register" method="POST">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for=""><b>Họ và tên:</b></label>
                <input type="text" class="form-control" placeholder="Họ và tên" value="<?php
                if (!empty($_POST['fullname']) && empty($error['fullname'])) {
                  echo $_POST['fullname'];
                } ?>" name="fullname">
                <p class="text-danger error"><?php
                if (!empty($error['fullname'])) {
                  echo $error['fullname'];
                } ?></p>
              </div>
              <div class="col-md-6 mb-3">
                <label for=""><b>số điện thoại:</b></label>
                <input type="number" class="form-control" placeholder="Số điện thoại" min="0" value="<?php
                if (!empty($_POST['phone']) && empty($error['phone'])) {
                  echo $_POST['phone'];
                } ?>" name="phone">
                <p class="text-danger error"><?php
                if (!empty($error['phone'])) {
                  echo $error['phone'];
                } ?></p>
              </div>
              <div class="col-md-6 mb-3 ">
                <label for=""><b>Email:</b></label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend3">@</span>
                  </div>
                  <input type="text" class="form-control " placeholder="Email" name="email" value="<?php
                  if (!empty($_POST['email']) && empty($error['email'])) {
                    echo $_POST['email'];
                  } ?>">
                </div>
                <p class="text-danger error"><?php
                if (!empty($error['email'])) {
                  echo $error['email'];
                } ?></p>
              </div>


              <div class="col-md-6 mb-3">
                <label for="validationServer03"><b>Ngày sinh:</b></label>
                <input type="date" class="form-control" placeholder="Ngày sinh" name="birthday" value="<?php
                if (!empty($_POST['birthday']) && empty($error['birthday'])) {
                  echo $_POST['birthday'];
                } ?>">
                <p class="text-danger error"><?php
                if (!empty($error['birthday'])) {
                  echo $error['birthday'];
                } ?></p>
              </div>

              <div class="col-md-6 mb-3">
                <label for=""><b>Giới tính:</b> </label>
                <input type="radio" name="gender" id="" value="Nam" class="ml-3" <?php
                if (!empty($_POST['gender']) && empty($error['gender'])) {
                  if ($_POST['gender'] == 'Nam') {
                    echo 'checked';
                  }
                }
                ?>>
                <label for="">Nam</label>
                <input type="radio" name="gender" id="" value="Nữ" class="ml-3" <?php
                if (!empty($_POST['gender']) && empty($error['gender'])) {
                  if ($_POST['gender'] == 'Nữ') {
                    echo 'checked';
                  }
                }
                ?>>
                <label for="">Nữ</label>
                <p class="text-danger error"><?php
                if (!empty($error['gender'])) {
                  echo $error['gender'];
                } ?></p>
              </div>

              <div class="col-md-12 mb-3">
                <label for=""><b>Mật khẩu:</b></label>
                <input type="password" class="form-control" placeholder="mật khẩu" min="0" name="password" value="<?php
                if (!empty($_POST['password']) && empty($error['password'])) {
                  echo $_POST['password'];
                } ?>">
                <p class="text-danger error"><?php
                if (!empty($error['password'])) {
                  echo $error['password'];
                } ?></p>
              </div>
              <div class="col-md-12 mb-3">
                <label for=""><b>Nhập lại mật khẩu:</b></label>
                <input type="password" class="form-control" placeholder="nhập lại mật khẩu" min="0"
                  name="confirm_password" value="<?php
                  if (!empty($_POST['confirm_password']) && empty($error['confirm_password'])) {
                    echo $_POST['confirm_password'];
                  } ?>">
                <p class="text-danger error"><?php
                if (!empty($error['confirm_password'])) {
                  echo $error['confirm_password'];
                } ?></p>
              </div>
            </div>
            <div class="form-row">



            </div>
            <div class="text-center">
              <input type="submit" value="Đăng kí" class="btn btn-primary" name="register">
            </div>
            <hr class="my-1">
            <div class="text-center mb-2">
              Bạn đã có tài khoản
              <b><a href="<?php echo _WEB_ROOT; ?>/account/login" class="text-danger">
                  Đăng nhập
                </a></b>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>