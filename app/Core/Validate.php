<?php

class Validate
{
    public $error = [];



    function checkBorn()
    {
        if (empty($_POST["birthday"])) {
            $this->error['birthday'] = "Vui lòng nhập ngày sinh !";
            return $this->error['birthday'];
        } else {
            $born_date = new DateTime($_POST["birthday"]);
            $current_date = new DateTime();
            if ($born_date > $current_date) {
                $this->error['birthday'] = "Ngày sinh phải nhỏ hơn ngày hiện tại !";
                return $this->error['birthday'];
            } else {
                return '';
            }
        }
    }

    function checkFullName()
    {
        if (empty($_POST["fullname"])) {
            $this->error['fullname'] = "Vui lòng nhập họ tên!";
            return $this->error['fullname'];
        } else {
            if (!preg_match("/^(?:\p{Lu}\p{Ll}*\s?)+$/u", $_POST["fullname"])) {

                $this->error['fullname'] = "Họ tên phải từ 2 kí tự và mỗi chữ đầu tiên của từ phải viết hoa !";
                return $this->error['fullname'];
            } else {
                return '';
            }
        }
    }


    function checkPhone()
    {
        if (empty($_POST["phone"])) {
            $this->error['phone'] = "Vui lòng nhập số điện thoại !";
            return $this->error['phone'];
        } else {
            if (!preg_match("/^0\d{9}$/", $_POST["phone"])) {
                $this->error['phone'] = "Số điện thoại phải bắt đầu từ số 0 và có phải có 10 số!";
                return $this->error['phone'];
            } else {
                return '';
            }
        }
    }


    function checkEmail()
    {
        if (empty($_POST["email"])) {
            $this->error['email'] = " Vui lòng nhập Email !";
            return $this->error['email'];
        } else {
            if (!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $_POST["email"])) {
                $this->error['email'] = " Email không đúng định dạng !";
                return $this->error['email'];
            } else {
                return '';
            }
        }
    }

    function checkPassword()
    {
        if (empty($_POST["password"])) {
            $this->error['password'] = " Vui lòng nhập mật khẩu !";
            return $this->error['password'];
        } else {
            if (strlen($_POST["password"]) < 6) {
                $this->error['password'] = " Mật khẩu phải có ít nhất 6 kí tự !";
                return $this->error['password'];
            } else {
                return '';
            }
        }
    }

    function confirmPassword()
    {
        if (empty($_POST["confirm_password"])) {
            $this->error['confirm_password'] = " Vui lòng nhập lại mật khẩu !";
            return $this->error['confirm_password'];
        } else {
            if ($_POST["confirm_password"] != $_POST["password"]) {
                $this->error['confirm_password'] = " Mật khẩu không khớp !";
                return $this->error['confirm_password'];
            } else {
                return '';
            }
        }
    }



    function checkGender()
    {
        if (empty($_POST["gender"])) {
            $this->error['gender'] = " Vui lòng chọn giới tính !";
            return $this->error['gender'];
        } else {
            return '';
        }
    }

    function checkNameMedicine()
    {
        if (empty($_POST["nameMedicine"])) {
            $this->error['nameMedicine'] = "Vui lòng nhập tên thuốc!";
            return $this->error['nameMedicine'];
        } else {
            return '';
        }
    }


    function checkTypeMedicine()
    {
        if (empty($_POST['typeMedicine'])) {
            if ($_POST["typeMedicine"] == 0) {
                $this->error['typeMedicine'] = "Vui lòng chọn loại thuốc!";
                return $this->error['typeMedicine'];
            } else {
                return '';
            }
        }
    }

    function checkQuantityMedicine()
    {
        if (empty($_POST['quantity'])) {

            $this->error['quantity'] = " Vui lòng nhập số lượng !";
            return $this->error['quantity'];
        } else {
            if ($_POST["quantity"] <= 0) {
                $this->error['quantity'] = "Số lượng phải lớn hơn 0!";
                return $this->error['quantity'];
            } else {
                return '';
            }
        }
    }

    function checkManufMedicine()
    {
        if (empty($_POST["manufacture"])) {
            $this->error['manufacture'] = "Vui lòng chọn ngày sản xuất của thuốc !";
            return $this->error['manufacture'];
        } else {
            $born_date = new DateTime($_POST["manufacture"]);
            $current_date = new DateTime();
            if ($born_date >= $current_date) {
                $this->error['manufacture'] = "Ngày sản xuất phải nhỏ hơn hoặc bằng ngày hiện tại!";
                return $this->error['manufacture'];
            } else {
                return '';
            }
        }
    }

    function checkExpiryMedicine()
    {
        if (empty($_POST["expiry"])) {
            $this->error['expiry'] = "Vui lòng chọn hạn sử dụng cho thuốc !";
            return $this->error['expiry'];
        } else {
            $born_date = new DateTime($_POST["expiry"]);
            $current_date = new DateTime();
            if ($born_date <= $current_date) {
                $this->error['expiry'] = "Hạn sử dụng phải lớn hơn ngày hiện tại!";
                return $this->error['expiry'];
            } else {
                return '';
            }
        }
    }

    function checkPriceMedicine()
    {
        if (empty($_POST['price'])) {

            $this->error['price'] = " Vui lòng nhập giá cho thuốc!";
            return $this->error['price'];
        } else {
            if ($_POST["price"] < 1000) {
                $this->error['price'] = "Gía phải lớn hơn hoặc bằng 1000!";
                return $this->error['price'];
            } else {
                return '';
            }
        }
    }

    function checkUnitMedicine()
    {
        if (empty($_POST['unit'])) {
            if ($_POST["unit"] == 0) {
                $this->error['unit'] = "Vui lòng chọn đơn vị thuốc!";
                return $this->error['unit'];
            } else {
                return '';
            }
        }
    }

    function checkCertificate()
    {
        if (empty($_POST["certificate"])) {
            $this->error['certificate'] = "Vui lòng cung cấp chứng chỉ cần thiết!";
            return $this->error['certificate'];
        } else {
            return '';
        }
    }

    function checkExperience()
    {
        if (empty($_POST["experience"])) {
            $this->error['experience'] = "Vui lòng chứng chỉ bằng cấp cần thiết!";
            return $this->error['experience'];
        } else {
            return '';
        }
    }

    function checkDescription()
    {
        if (empty($_POST["description"])) {
            $this->error['description'] = "Vui lòng nhập mô tả!";
            return $this->error['description'];
        } else {
            return '';
        }
    }

    function checkRole()
    {
        if (empty($_POST["role"])) {
            $this->error['role'] = "Vui lòng chọn vai trò người dùng!";
            return $this->error['role'];
        } else {
            return '';
        }
    }

    function checkDepartment()
    {

        if ($_POST["department"] == 0) {
            $this->error['department'] = "Vui lòng chọn chuyên khoa cho bác sĩ!";
            return $this->error['department'];
        } else {
            return '';
        }

    }

    function checkDoctor()
    {
        if ($_POST["department"] != 0) {
            if ($_POST["doctor"] == 0) {
                $this->error['doctor'] = "Vui lòng chọn một bác sĩ!";
                return $this->error['doctor'];
            } else {
                return '';
            }
        }
    }



}
