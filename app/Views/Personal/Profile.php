<?php
require './app/Views/inc/HeaderPersonal.php';
?>

<script>
    $(document).ready(() => {
        const avatarFile = $("#avatarFile");
        avatarFile.change(function (e) {
            const imgURL = URL.createObjectURL(e.target.files[0]);
            $("#avatarPreview").attr("src", imgURL);
            $("#avatarPreview").css({ "display": "block" });
        });
    });
</script>

<main id="main" class="main">
    <section style="background-color: #eee; ">
        <div class="container" style="margin-top: -100px;">
            <div class="update-proftle m-1">
                <a href="<?php echo _WEB_ROOT ?>/Personal?update"><button class="btn-primary">Chỉnh sửa thông tin cá
                        nhân</button></a>
                <a href="<?php echo _WEB_ROOT ?>/Personal?updatePass"><button class="btn-primary">Đổi mật
                        khẩu</button></a>
            </div>
            <div class="m-3">
                <?php if (isset($_GET['update'])) { ?>
                    <form action="<?php echo _WEB_ROOT; ?>/Personal?update" method="post" class="row"
                        enctype="multipart/form-data">
                        <div class="col-6">
                            <label for="">Họ tên: </label>
                            <input type="text" style="width: 70%; float: right" value="<?php
                            if (!empty($_POST['fullname']) && empty($error['fullname'])) {
                                echo $_POST['fullname'];
                            } else {
                                echo $_SESSION['is_login']['fullname'];
                            } ?>" name="fullname">
                            <p class="text-danger error" style="margin-left: 30%;"><?php
                            if (!empty($error['fullname'])) {
                                echo $error['fullname'];
                            } ?></p>
                        </div>
                        <div class="col-6">
                            <label for="">Email: </label>
                            <input type="text" style="width: 70%; float: right" name="email" value="<?php
                            if (!empty($_POST['email']) && empty($error['email'])) {
                                echo $_POST['email'];
                            } else {
                                echo $_SESSION['is_login']['email'];
                            } ?>">
                            <p class="text-danger error" style="margin-left: 30%;"><?php

                            if (!empty($error['email'])) {
                                echo $error['email'];
                            } ?></p>

                        </div>
                        <div class="col-6">
                            <label for="">Số điện thoại: </label>
                            <input type="text" id="" style="width: 70%; float: right" value="<?php
                            if (!empty($_POST['phone']) && empty($error['phone'])) {
                                echo $_POST['phone'];
                            } else {
                                echo $_SESSION['is_login']['phone'];
                            } ?>" name="phone">
                            <p class="text-danger error" style="margin-left: 30%;"><?php
                            if (!empty($error['phone'])) {
                                echo $error['phone'];
                            } ?></p>
                        </div>
                        <div class="col-6">
                            <label for="">Năm sinh: </label>
                            <input type="date" id="" style="width: 70%; float: right" name="birthday" value="<?php
                            if (!empty($_POST['birthday']) && empty($error['birthday'])) {
                                echo $_POST['birthday'];
                            } else {
                                echo $_SESSION['is_login']['birthday'];
                            } ?>">
                            <p class="text-danger error" style="margin-left: 30%;"><?php
                            if (!empty($error['birthday'])) {
                                echo $error['birthday'];
                            } ?></p>
                        </div>
                        <div class="col-6 ">
                            <label for="avatarFile" class="form-label">Ảnh: </label>
                            <input type="file" name="file" id="avatarFile" accept=".png, .jpg, .jpeg"
                                style="width: 70%; float: right" />
                            <img style="max-height: 250px; display: none; margin-left: 30%;" alt="avatar preview"
                                id="avatarPreview" />

                        </div>
                        <div class="col-12 text-center m-3">
                            <input type="submit" name="btn_save" value="Lưu thay đổi" class="btn-success">
                        </div>
                    </form>
                <?php }
                if (isset($_GET['updatePass'])) { ?>
                    <form action="<?php echo _WEB_ROOT; ?>/Personal?updatePass" method="post" class="row">
                        <div class="col-7">
                            <label for="">Nhập mật khẩu hiện tại: </label>
                            <input type="password" id="" style="width: 70%; float: right" name="passwordCurrent">
                            <p class="text-danger error" style="margin-left: 30%;"><?php
                            if (!empty($error['passwordCurrent'])) {
                                echo $error['passwordCurrent'];
                            } ?></p>
                        </div>
                        <div class="col-7">
                            <label for="">Nhập mật khẩu mới: </label>
                            <input type="password" id="" style="width: 70%; float: right" name="password" value="<?php
                            if (!empty($_POST['password']) && empty($error['password'])) {
                                echo $_POST['password'];
                            } ?>">
                            <p class="text-danger error" style="margin-left: 30%;"><?php
                            if (!empty($error['password'])) {
                                echo $error['password'];
                            } ?></p>
                        </div>
                        <div class="col-7">
                            <label for="">Nhập lại mật khẩu mới: </label>
                            <input type="password" style="width: 70%; float: right" name="confirm_password" value="<?php
                            if (!empty($_POST['confirm_password']) && empty($error['confirm_password'])) {
                                echo $_POST['confirm_password'];
                            } ?>">
                            <p class="text-danger error" style="margin-left: 30%;"><?php
                            if (!empty($error['confirm_password'])) {
                                echo $error['confirm_password'];
                            } ?></p>
                        </div>

                        <div class="col-7 text-center m-3">
                            <input type="submit" value="Lưu thay đổi" class="btn-success" name="btn_updatePass">
                        </div>
                    </form>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $_SESSION['is_login']['image'] ?>"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                            <h5 class="m-2"><?php echo $_SESSION['is_login']['fullname'] ?></h5>
                            <p class="text-muted mb-1"><?php echo $_SESSION['is_login']['name_role'] ?></p>

                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Họ và tên:</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="fullname" id="fullname" class="border-0"
                                        value="<?php echo $_SESSION['is_login']['fullname'] ?>" width="100%">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Giới tính:</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="" id="" class="border-0"
                                        value="<?php echo $_SESSION['is_login']['gender'] ?>">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email:</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="" id="" class="border-0"
                                        value="<?php echo $_SESSION['is_login']['email'] ?>">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Số điện thoại:</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="" id="" class="border-0"
                                        value="<?php echo $_SESSION['is_login']['phone'] ?>">

                                </div>
                            </div>

                            <hr>
                            <?php if (isset($_SESSION['is_login']['certificate'])) { ?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Bằng cấp:</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="" id="" class="border-0"
                                            value="<?php echo $_SESSION['is_login']['certificate'] ?>" style="width: 100%;">

                                    </div>
                                </div>

                                <hr>
                            <?php } ?>
                            <?php if (isset($_SESSION['is_login']['experience'])) { ?>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Kinh nghiệm:</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php
                                        $string = $_SESSION['is_login']['experience'];
                                        $segments = explode(".", $string);
                                        foreach ($segments as $segment) {
                                            echo $segment . "<br>";
                                        } ?></p>
                                    </div>
                                </div>
                                <hr>
                            <?php } ?>

                            <?php if (isset($_SESSION['is_login']['description'])) { ?>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Mô tả:</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php
                                        $string = $_SESSION['is_login']['description'];
                                        $segments = explode(".", $string);
                                        foreach ($segments as $segment) {
                                            echo $segment . "<br>";
                                        } ?></p>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
</main>

<?php
require './app/Views/inc/FooterPersonal.php';
?>