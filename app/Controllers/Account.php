<?php


class Account extends Controller
{

    private $model;

    private $data = [];

    public function __construct()
    {
        $_SESSION['appointment']['check'] = false;
        $this->model = $this->model('AccountModel');
    }

    function login()
    {
        if (isset($_POST['login'])) {
            $this->data['error']['email'] = $this->checkEmail();
            $this->data['error']['password'] = $this->checkPassword();

            if ($this->data['error']['password'] == '' && $this->data['error']['email'] == '') {
                $listPatient = $this->model->getListFromTowTables('patient', 'role', 'id_role', 'id_role', 'WHERE status = 1');
                $listStaff = $this->model->getListFromTowTables('staff', 'role', 'id_role', 'id_role', 'WHERE status = 1');

                $checkAccount = false;

                foreach (array_merge($listPatient, $listStaff) as $user) {
                    if ($user['email'] == $_POST['email'] && $user['password'] == md5($_POST['password'])) {
                        $_SESSION['is_login'] = true;
                        $_SESSION['is_login'] = [];
                        if ($user['id_role'] == 5) {
                            $_SESSION['is_login']['id_account'] = $user['id_patient'];
                        } else {
                            $_SESSION['is_login']['id_account'] = $user['id_staff'];
                            $_SESSION['is_login']['certificate'] = $user['certificate'];
                            $_SESSION['is_login']['experience'] = $user['experience'];
                            $_SESSION['is_login']['description'] = $user['description'];

                        }

                        $_SESSION['is_login']['fullname'] = $user['full_name'];
                        $_SESSION['is_login']['email'] = $user['email'];
                        $_SESSION['is_login']['phone'] = $user['phone'];
                        $_SESSION['is_login']['birthday'] = $user['birthday'];
                        $_SESSION['is_login']['password'] = $user['password'];
                        $_SESSION['is_login']['gender'] = $user['gender'];
                        $_SESSION['is_login']['image'] = $user['image'];
                        $_SESSION['is_login']['fullname'] = $user['full_name'];
                        $_SESSION['is_login']['id_role'] = $user['id_role'];
                        $_SESSION['is_login']['name_role'] = $user['name_role'];
                        $checkAccount = true;
                        header("Location: " . _WEB_ROOT);

                        exit;
                    }
                }



                if (!$checkAccount) {
                    $this->data['error']['account'] = 'Email hoặc mật khẩu không chính xác!';
                }
            }
        }


        $this->view("Account/Login", $this->data);
    }



    function register()
    {
        if (isset($_POST['register'])) {



            $this->data['error']['email'] = $this->checkEmail();
            $this->data['error']['password'] = $this->checkPassword();
            $this->data['error']['confirm_password'] = $this->confirmPassword();
            $this->data['error']['fullname'] = $this->checkFullName();
            $this->data['error']['phone'] = $this->checkPhone();
            $this->data['error']['birthday'] = $this->checkBorn();
            $this->data['error']['gender'] = $this->checkGender();

            $listUserPatient = $this->model->getListTable('patient');
            $listStaff = $this->model->getListTable('staff');

            foreach (array_merge($listUserPatient, $listStaff) as $user) {
                if ($user['email'] == $_POST['email']) {
                    $this->data['error']['email'] = 'Email đã được sử dụng';
                }
                if ($user['phone'] == $_POST['phone']) {
                    $this->data['error']['phone'] = 'Số điện thoại đã được sử dụng';
                }
            }
            if ($_POST['password'] != $_POST['confirm_password']) {
                $this->data['error']['confirm_password'] = 'Mật khẩu bạn nhập lại không khớp';
            }

            foreach ($this->data['error'] as $key => $value) {
                if ($value == '') {
                    unset($this->data['error'][$key]);
                }
            }


            if (empty($this->data['error'])) {
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $birthday = $_POST['birthday'];
                $gender = $_POST['gender'];
                $password = $_POST['password'];
                $id_role = 5;
                $data = [
                    'full_name' => "$fullname",
                    'email' => "$email",
                    'password' => md5($password),
                    'phone' => "$phone",
                    'birthday' => $birthday,
                    'gender' => $gender,
                    'id_role' => $id_role,

                ];
                $result = $this->model->InsertData('patient', $data);
                if ($result) {

                    $this->data['email'] = $_POST['email'];
                    $this->data['fullname'] = $_POST['fullname'];

                    $this->view("Account/sendMailRegister", $this->data);
                    echo "<script>alert('Bạn đã đăng kí thành công tài khoản')</script>";

                    $redirectUrl = _WEB_ROOT . "/account/notifyRegister";
                    header("refresh:0.5; url=$redirectUrl");
                }
            }
        }


        $this->view("Account/Register", $this->data);

    }


    function confirmUser($email = '')
    {
        if (isset($email)) {
            $email = base64_decode($email);

            $updates = [
                'status' => 1
            ];
            $this->model->updateData('patient', $updates, "email = '$email' ");
            $redirectUrl = _WEB_ROOT . "/account/login";
            header("refresh:0; url=$redirectUrl");
        }



    }

    function ForgotPassword()
    {
        if (isset($_POST['sub_email'])) {
            $this->data['error']['email'] = $this->checkEmail();

            $listPatient = $this->model->getListTable('patient');
            $listStaff = $this->model->getListTable('staff');
            $checkEmail = false;
            foreach (array_merge($listPatient, $listStaff) as $user) {
                if ($user['email'] == $_POST['email']) {
                    $checkEmail = true;
                    $this->data['email'] = $_POST['email'];

                    $this->view("Account/sendMailForgotPassword", $this->data);
                    $redirectUrl = _WEB_ROOT . "/account/NotifyForgotPassword";
                    header("refresh:0; url=$redirectUrl");
                }

            }

            if ($checkEmail == false) {
                $this->data['error']['email'] = "Email không tồn tại";

            }

        }
        $this->view("Account/ForgotPassword", $this->data);

    }


    function logout()
    {
        unset($_SESSION['is_login']);
        $redirectUrl = _WEB_ROOT;
        header("refresh:0; url=$redirectUrl");

    }

    function notifyRegister()
    {

        $this->view("Account/NotifyRegister");
    }

    function NotifyForgotPassword()
    {

        $this->view("Account/NotifyForgotPassword");
    }

    function newPassword($email)
    {
        if (isset($email)) {
            $email = base64_decode($email);

            $listPatient = $this->model->getListTable('patient', 'where status = 1');
            $listStaff = $this->model->getListTable('staff', 'where status = 1');
            $checkEmail = '';
            if (isset($_POST['new_password'])) {

                $this->data['error']['password'] = $this->checkPassword();
                $this->data['error']['confirm_password'] = $this->confirmPassword();


                foreach ($this->data['error'] as $key => $value) {
                    if ($value == '') {
                        unset($this->data['error'][$key]);
                    }
                }

                if (empty($this->data['error'])) {
                    if ($_POST['password'] == $_POST['confirm_password']) {
                        foreach ($listPatient as $patient) {
                            if ($patient['email'] == $email) {
                                $checkEmail = 'patient';

                            }
                        }
                        foreach ($listStaff as $staff) {
                            if ($staff['email'] == $email) {
                                $checkEmail = 'staff';

                            }
                        }

                        if ($checkEmail == 'patient') {
                            $data = [
                                'password' => md5($_POST['confirm_password'])
                            ];

                            $result = $this->model->updateData('patient', $data, "email = '$email' ");
                            if ($result) {
                                echo "<script>alert('Cập nhật lại mật khẩu thành công')</script>";
                                $redirectUrl = _WEB_ROOT . "/account/login";
                                header("refresh:0; url=$redirectUrl");

                            } else {
                                echo "<script>alert('Tạo mật khẩu thất bại')</script>";

                            }
                        } else {
                            $data = [
                                'password' => md5($_POST['confirm_password'])
                            ];
                            $result = $this->model->updateData('staff', $data, "email = '$email' ");
                            if ($result) {
                                echo "<script>alert('Cập nhật lại mật khẩu thành công')</script>";
                                $redirectUrl = _WEB_ROOT . "/account/login";
                                header("refresh:0; url=$redirectUrl");

                            } else {
                                echo "<script>alert('Cập nhật lại mật khẩu thất bại')</script>";

                            }
                        }

                    } else {
                        $this->data['error']['confirm_password'] = 'Mật khẩu không khớp';
                    }
                }


            }
            $this->view("Account/NewPassword", $this->data);
        }

    }


}
