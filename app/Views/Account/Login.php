<!DOCTYPE html>
<html>

<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo  _WEB_ROOT; ?>/public/img/favicons/favicon.ico">

    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT; ?>/public/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

<body style="  background: url('<?php echo _WEB_ROOT;  ?>/public/img/gallery/hero-bg.png');">
    <div class="container">
        <div class="row px-3">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
                <div class="img-left d-none d-md-flex" style="background: url('<?php echo _WEB_ROOT;  ?>/public/img/gallery/hero.png') center;">

                </div>

                <div class="card-body">
                    <h4 class="title text-center mt-4">
                        Đăng nhập
                    </h4>
                    <form class="form-box px-3" action="<?php echo _WEB_ROOT; ?>/account/login" method="POST">
                        <div class="form-input">
                            <span><i class="fa fa-envelope-o"></i></span>
                            <input type="text" name="email" placeholder="Email">
                            <p class="text-danger error"><?php
                                                            if (!empty($error['email'])) {
                                                                echo $error['email'];
                                                            } ?></p>
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" name="password" placeholder="Password">
                            <p class="text-danger error"><?php
                                                            if (!empty($error['password'])) {
                                                                echo $error['password'];
                                                            } ?></p>
                        </div>
                        <p class="text-danger text-center error"><?php
                                                                    if (!empty($error['account'])) {
                                                                        echo $error['account'];
                                                                    } ?></p>
                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="cb1" name="">
                                <label class="custom-control-label" for="cb1">Ghi nhớ đăng nhập</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="submit" value="Đăng nhập" class="btn btn-primary form-control" name="login">
                        </div>

                        <div class="text-right">
                            <a href="<?php echo _WEB_ROOT; ?>/account/forgotPassword" class="forget-link">
                                Quên mật khẩu
                            </a>
                        </div>

                        <div class="text-center mb-3">
                            Đăng nhập với
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <a href="#" class="btn btn-block btn-social btn-facebook">
                                    facebook
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="#" class="btn btn-block btn-social btn-google">
                                    google
                                </a>
                            </div>


                        </div>

                        <hr class="my-4">

                        <div class="text-center mb-2">
                            Bạn chưa có tài khoản
                            <a href="<?php echo _WEB_ROOT; ?>/account/register" class="register-link">
                                Đăng kí
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>