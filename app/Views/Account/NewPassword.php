<!DOCTYPE html>
<html>

<head>
    <title>Cập nhật lại mật khẩu</title>
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
                        Tạo lại tài khoản
                    </h4>
                    <form action="" class="form-box px-3" method="POST">
                        <div class="form-input">
                            <label for=""><b>Mật khẩu mới:</b></label>
                            <input type="password" class="form-control" placeholder="mật khẩu" min="0" name="password"
                                value="<?php
                                if (!empty($_POST['password']) && empty($error['password'])) {
                                    echo $_POST['password'];
                                } ?>">
                            <p class="text-danger error">
                                <?php
                                if (!empty($error['password'])) {
                                    echo $error['password'];
                                } ?>
                            </p>
                        </div>

                        <div class="form-input">
                            <label for=""><b>Nhập lại mật khẩu:</b></label>
                            <input type="password" class="form-control" placeholder="nhập lại mật khẩu" min="0"
                                name="confirm_password" value="<?php
                                if (!empty($_POST['confirm_password']) && empty($error['confirm_password'])) {
                                    echo $_POST['confirm_password'];
                                } ?>">
                            <p class="text-danger error">
                                <?php
                                if (!empty($error['confirm_password'])) {
                                    echo $error['confirm_password'];
                                } ?>
                            </p>
                        </div>


                        <div class="pt-3">
                            <input type="submit" value="Xác nhận" class="btn btn-primary form-control"
                                name="new_password">
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