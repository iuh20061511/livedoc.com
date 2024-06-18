<?php
class Admin extends Controller
{

    private $model;

    private $data = [];

    public function __construct()
    {
        $this->model = $this->model('AdminModel');
    }

    public function index()
    {
        $this->data['bookAppointment'] = $this->model->countAppointment();
        $this->data['bookAppointmentCheck'] = $this->model->countAppointment(" AND `check`= 1");

        $this->data['countPatient'] = $this->model->countPatient();
        $this->data['title'] = 'Trang Admin';
        $this->view("Admin/Home", $this->data);
    }

    public function message($id_patient = 0)
    {
        $this->data['message'] = $this->model->getListUserMessage();
        $this->data['messagePatient'] = $this->model->getListFromTowTables('message', 'patient', 'id_patient', 'id_patient', "WHERE message.id_patient = $id_patient");
        $this->data['patient'] = $this->model->getListTable('patient', "WHERE id_patient = $id_patient");
        $this->data['id_patient'] = $id_patient;
        if ($id_patient != 0 && $id_patient != '') {
            $updates = [
                'status' => 1
            ];
            $this->model->updateData('message', $updates, "id_sender = $id_patient");
        }
        $this->data['title'] = 'Phản hồi';

        $this->view("Admin/mes2", $this->data);
    }

    public function Postmessage($id_patient)
    {
        if (isset($_POST['content'])) {
            $data = [
                'id_patient' => $id_patient,
                'id_staff' => $_SESSION['is_login']['id_account'],
                'id_sender' => $_SESSION['is_login']['id_account'],
                'content' => $_POST['content'],
                'send_date' => date("Y-m-d H:i:s"),

            ];

            $this->model->InsertData('message', $data);

            $content = $_POST;
            require_once "./Library/Pusher/vendor/autoload.php";

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                'c83bb20ad7db10fd6cd6',
                '64998ac54bec60fd1c81',
                '1798222',
                $options
            );

            $data['message'] = $content;
            $pusher->trigger('my-channel', 'my-event', $data);
        }
        $this->view("Admin/Message", $this->data);
    }

    public function listMedicine()
    {
        $this->data['title'] = 'Danh sách thuốc';
        $this->data['listMedicine'] = $this->model->getListFromTowTables('medicine', 'type_medicine', 'id_type_medicine', 'id_type_medicine');
        $this->view("Admin/Medicine/listMedicine", $this->data);
    }

    public function addMedicine()
    {
        $this->data['title'] = 'Thêm thuốc mới';
        $this->data['listTypeMedicine'] = $this->model->getListTable('type_medicine');

        if (isset($_POST['addMedicine'])) {
            $this->data['error']['nameMedicine'] = $this->checkNameMedicine();
            $this->data['error']['typeMedicine'] = $this->checkTypeMedicine();
            $this->data['error']['quantity'] = $this->checkQuantityMedicine();
            $this->data['error']['manufacture'] = $this->checkManufMedicine();
            $this->data['error']['expiry'] = $this->checkExpiryMedicine();
            $this->data['error']['price'] = $this->checkPriceMedicine();
            $this->data['error']['unit'] = $this->checkUnitMedicine();

            $listMedicine = $this->model->getListTable('medicine');
            foreach ($listMedicine as $medicine) {
                if (strcasecmp(trim($_POST['nameMedicine']), trim($medicine['name_medicine'])) == 0) {
                    $this->data['error']['nameMedicine'] = 'Thuốc đã tồn tại!';
                }
            }

            if (
                $this->data['error']['nameMedicine'] == '' && $this->data['error']['typeMedicine'] == '' && $this->data['error']['quantity'] == ''
                && $this->data['error']['manufacture'] == '' && $this->data['error']['expiry'] == '' && $this->data['error']['price'] == ''
                && $this->data['error']['unit'] == ''
            ) {
                $this->data['error'] = array();
            }

            if (empty($this->data['error'])) {
                // Thêm dữ liệu vào cơ sở dữ liệu
                $data = [
                    'name_medicine' => $_POST['nameMedicine'],
                    'quantity' => $_POST['quantity'],
                    'date_manufacture' => $_POST['manufacture'],
                    'expiry' => $_POST['expiry'],
                    'medicine_price' => $_POST['price'],
                    'unit' => $_POST['unit'],
                    'id_type_medicine' => $_POST['typeMedicine']
                ];
                $result = $this->model->InsertData('medicine', $data);
                if ($result) {
                    echo "<script>alert('Thêm thành công thuốc mới')</script>";

                    $redirectUrl = _WEB_ROOT . "/admin/listMedicine";
                    header("refresh:0.5; url=$redirectUrl");
                    exit();
                }
            }
        }
        $this->view("Admin/Medicine/AddMedicine", $this->data);
    }

    public function deleteMedicine()
    {
        if (isset($_POST['id_medicine'])) {
            echo $_POST['id_medicine'];
            $id_medicine = $_POST['id_medicine'];
            $this->model->DeleteData("medicine", "WHERE id_medicine = $id_medicine");

        }

    }

    public function updateMedicine($id_medicine)
    {
        $this->data['Medicine'] = $this->model->getListFromTowTables('medicine', 'type_medicine', 'id_type_medicine', 'id_type_medicine', "Where medicine.id_medicine = $id_medicine");
        $this->data['TypeMedicine'] = $this->model->getListTable('type_medicine');
        $this->data['title'] = 'Cập nhật thuốc';
        if (isset($_POST['updateMedicine'])) {
            $this->data['error']['nameMedicine'] = $this->checkNameMedicine();
            $this->data['error']['typeMedicine'] = $this->checkTypeMedicine();
            $this->data['error']['quantity'] = $this->checkQuantityMedicine();
            $this->data['error']['manufacture'] = $this->checkManufMedicine();
            $this->data['error']['expiry'] = $this->checkExpiryMedicine();
            $this->data['error']['price'] = $this->checkPriceMedicine();
            $this->data['error']['unit'] = $this->checkUnitMedicine();

            $listMedicine = $this->model->getListTable('medicine');
            foreach ($listMedicine as $medicine) {
                if (strcasecmp(trim($_POST['nameMedicine']), trim($medicine['name_medicine'])) == 0 && $_POST['id_medicine'] != $medicine['id_medicine']) {
                    $this->data['error']['nameMedicine'] = 'Thuốc đã tồn tại!';
                }
            }

            if (
                $this->data['error']['nameMedicine'] == '' && $this->data['error']['typeMedicine'] == '' && $this->data['error']['quantity'] == ''
                && $this->data['error']['manufacture'] == '' && $this->data['error']['expiry'] == '' && $this->data['error']['price'] == ''
                && $this->data['error']['unit'] == ''
            ) {
                $this->data['error'] = array();
            }

            if (empty($this->data['error'])) {
                $data = [
                    'name_medicine' => $_POST['nameMedicine'],
                    'quantity' => $_POST['quantity'],
                    'date_manufacture' => $_POST['manufacture'],
                    'expiry' => $_POST['expiry'],
                    'medicine_price' => $_POST['price'],
                    'unit' => $_POST['unit'],
                    'id_type_medicine' => $_POST['typeMedicine']
                ];
                $id_medicine = $_POST['id_medicine'];
                $result = $this->model->UpdateData('medicine', $data, "id_medicine = $id_medicine");
                if ($result) {
                    echo "<script>alert('Cập nhật thành công thông tin thuốc')</script>";

                    $redirectUrl = _WEB_ROOT . "/admin/listMedicine";
                    header("refresh:0.5; url=$redirectUrl");
                    exit();
                }
            }


        }
        $this->view("Admin/Medicine/updateMedicine", $this->data);
    }


    public function addUsers()
    {
        $this->data['title'] = 'Thêm người dùng';
        $this->data['role'] = $this->model->getListTable('role');
        $this->data['department'] = $this->model->getListTable('department');
        $listUserPatient = $this->model->getListTable('patient');
        $listStaff = $this->model->getListTable('staff');


        if (isset($_POST['addUser'])) {
            $this->data['error']['fullname'] = $this->checkFullName();
            $this->data['error']['email'] = $this->checkEmail();
            $this->data['error']['gender'] = $this->checkGender();
            $this->data['error']['phone'] = $this->checkPhone();
            $this->data['error']['birthday'] = $this->checkBorn();
            $this->data['error']['certificate'] = $this->checkCertificate();
            $this->data['error']['experience'] = $this->checkExperience();
            $this->data['error']['description'] = $this->checkDescription();
            $this->data['error']['role'] = $this->checkRole();

            foreach (array_merge($listUserPatient, $listStaff) as $user) {
                if ($user['email'] == $_POST['email']) {
                    $this->data['error']['email'] = 'Email đã được sử dụng';
                }
                if ($user['phone'] == $_POST['phone']) {
                    $this->data['error']['phone'] = 'Số điện thoại đã được sử dụng';
                }
            }

            foreach ($this->data['error'] as $key => $value) {
                if ($value == '') {
                    unset($this->data['error'][$key]);
                }
            }

            if (empty($this->data['error'])) {
                $this->data['fullname'] = $_POST['fullname'];
                $this->data['email'] = $_POST['email'];
                $this->data['phone'] = $_POST['phone'];
                $this->data['role'] = $_POST['role'];
                $data = [
                    'full_name' => $_POST['fullname'],
                    'email' => $_POST['email'],
                    'password' => md5('123456'),
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'id_role' => $_POST['role'],
                    'certificate' => $_POST['certificate'],
                    'description' => $_POST['description'],
                    'experience' => $_POST['experience'],
                ];
                if ($_POST['role'] == 4) {
                    $data['id_department'] = $_POST['department'];
                } else {
                    $data['id_department'] = 7;
                }

                $result = $this->model->InsertData('staff', $data);
                if ($result) {
                    echo "<script>alert('Bạn đã thêm thành công tài khoản')</script>";
                    $this->view("Admin/Users/sendMailUser", $this->data);

                    $redirectUrl = _WEB_ROOT . "/admin/listUsersStaff";
                    header("refresh:0; url=$redirectUrl");
                }
            }

        }
        $this->view("Admin/Users/addUsers", $this->data);
    }


    public function listUsersStaff()
    {
        $this->data['title'] = 'Danh sách nhân viên';
        $this->data['listStaff'] = $this->model->getListFromThreeTables('role', 'staff', 'department', 'id_role', 'id_role', 'id_department', 'id_department', 'WHERE staff.status=1');
        $this->data['listStaffDelete'] = $this->model->getListFromThreeTables('role', 'staff', 'department', 'id_role', 'id_role', 'id_department', 'id_department', 'WHERE staff.status=0');

        $this->view("Admin/Users/listUsersStaff", $this->data);
    }


    public function listUsersPatient()
    {
        $this->data['listPatient'] = $this->model->getListFromTowTables('role', 'patient', 'id_role', 'id_role', 'WHERE patient.status=1');
        $this->data['listPatientDelete'] = $this->model->getListFromTowTables('role', 'patient', 'id_role', 'id_role', 'WHERE patient.status=0');

        $this->data['title'] = 'Danh sách bệnh nhân';

        $this->view("Admin/Users/ListUsersPatient", $this->data);
    }


    public function deleteUserStaff()
    {

        if (isset($_POST['id_staff'])) {
            $id_staff = $_POST['id_staff'];

            $updates = [
                'status' => 0
            ];
            $this->model->updateData('staff', $updates, "id_staff = $id_staff");


        }
    }

    public function deleteUserPatient()
    {

        if (isset($_POST['id_patient'])) {
            $id_patient = $_POST['id_patient'];

            $updates = [
                'status' => 0
            ];
            $this->model->updateData('patient', $updates, "id_patient = $id_patient");

        }
    }

    public function updateUser($id_staff)
    {
        $this->data['Staff'] = $this->model->getListFromThreeTables('role', 'staff', 'department', 'id_role', 'id_role', 'id_department', 'id_department', "WHERE  id_staff = $id_staff AND staff.status=1");
        $this->data['title'] = 'Cập nhật nhân viên';

        $this->data['role'] = $this->model->getListTable('role');
        $this->data['department'] = $this->model->getListTable('department');
        $listUserPatient = $this->model->getListTable('patient');
        $listStaff = $this->model->getListTable('staff');

        if (isset($_POST['upDate'])) {
            $this->data['error']['fullname'] = $this->checkFullName();
            $this->data['error']['email'] = $this->checkEmail();
            $this->data['error']['gender'] = $this->checkGender();
            $this->data['error']['phone'] = $this->checkPhone();
            $this->data['error']['birthday'] = $this->checkBorn();
            $this->data['error']['certificate'] = $this->checkCertificate();
            $this->data['error']['experience'] = $this->checkExperience();
            $this->data['error']['description'] = $this->checkDescription();
            $this->data['error']['role'] = $this->checkRole();
            $this->data['error']['department'] = $this->checkDepartment();

            foreach (array_merge($listUserPatient, $listStaff) as $user) {
                if ($user['email'] == $_POST['email'] && $_POST['id_staff'] != $user['id_staff']) {
                    $this->data['error']['email'] = 'Email đã được sử dụng';
                }
                if ($user['phone'] == $_POST['phone'] && $_POST['id_staff'] != $user['id_staff']) {
                    $this->data['error']['phone'] = 'Số điện thoại đã được sử dụng';
                }
            }

            foreach ($this->data['error'] as $key => $value) {
                if ($value == '') {
                    unset($this->data['error'][$key]);
                }
            }

            if (empty($this->data['error'])) {
                $data = [
                    'full_name' => $_POST['fullname'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone'],
                    'birthday' => $_POST['birthday'],
                    'gender' => $_POST['gender'],
                    'id_role' => $_POST['role'],
                    'certificate' => $_POST['certificate'],
                    'description' => $_POST['description'],
                    'experience' => $_POST['experience'],
                ];
                $id_staff = $_POST['id_staff'];
                if ($_POST['role'] == 4) {
                    $data['id_department'] = $_POST['department'];
                } else {
                    $data['id_department'] = 7;
                }
                $result = $this->model->UpdateData('staff', $data, "id_staff = $id_staff");
                if ($result) {
                    echo "<script>alert('Bạn đã cập nhật thành công thông tin tài khoản')</script>";
                    $redirectUrl = _WEB_ROOT . "/admin/ListUsersStaff";
                    header("refresh:0.5; url=$redirectUrl");
                    exit();
                }
            }

        }

        $this->view("Admin/Users/UpdateUser", $this->data);

    }



    public function listStaffDelete()
    {

        $this->data['listStaffDelete'] = $this->model->getListFromThreeTables('role', 'staff', 'department', 'id_role', 'id_role', 'id_department', 'id_department', 'WHERE staff.status=0');
        $this->data['title'] = 'Danh sách nhân viên đã xóa';
        $this->view("Admin/Users/ListStaffDelete", $this->data);

    }

    public function listPatientDelete()
    {

        $this->data['listPatientDelete'] = $this->model->getListFromTowTables('role', 'patient', 'id_role', 'id_role', 'WHERE patient.status=0');
        $this->data['title'] = 'Danh sách bệnh nhân đã xóa';
        $this->view("Admin/Users/ListPatientDelete", $this->data);

    }

    public function restoreStaff($id_staff)
    {

        if (isset($id_staff)) {

            $updates = [
                'status' => 1
            ];
            $result = $this->model->updateData('staff', $updates, "id_staff = $id_staff");
            if ($result) {
                echo "<script>alert('Khôi phục tài khoản thành công')</script>";
                $redirectUrl = _WEB_ROOT . "/admin/listStaffDelete";
                header("refresh:0.5; url=$redirectUrl");
            }
        }
    }
    public function restorePatient($id_patient)
    {

        if (isset($id_patient)) {

            $updates = [
                'status' => 1
            ];
            $result = $this->model->updateData('patient', $updates, "id_patient = $id_patient");
            if ($result) {
                echo "<script>alert('Khôi phục tài khoản thành công')</script>";
                $redirectUrl = _WEB_ROOT . "/admin/listPatientDelete";
                header("refresh:0.5; url=$redirectUrl");
            }
        }
    }
    public function DeleteStaffPermanent()
    {
        if (isset($_POST['id_staff'])) {
            $id_staff = $_POST['id_staff'];

            $this->model->DeleteData('staff', "WHERE id_staff = $id_staff");

        }
    }

    public function DeletePatientPermanent()
    {
        if (isset($_POST['id_patient'])) {
            $id_patient = $_POST['id_patient'];

            $this->model->DeleteData('patient', "WHERE id_patient = $id_patient");

        }
    }

    public function addPosts()
    {
        $this->data['title'] = 'Thêm bài viết';


        $this->view("Admin/Posts/AddPosts", $this->data);
    }


    public function addPostsInsert()
    {

        $data = array_merge($_POST, $_FILES);
        $posts = array();
        $i = 1;

        foreach ($data as $key => $value) {
            if (!empty($value)) {
                if (strpos($key, 'addContent') === 0) {
                    $posts['con'][$i]['content'] = htmlspecialchars('<p class=\"mb-1 textContent\">' . $value . '</p>');
                    $posts['con'][$i]['number'] = $i;
                }

                if (strpos($key, 'addTitle') === 0) {
                    $posts['con'][$i]['content'] = htmlspecialchars('<h3 class=\"fw-bolder mb-2\">' . $value . '</h3>');
                    $posts['con'][$i]['number'] = $i;
                }
                if (strpos($key, 'title') === 0) {
                    $posts['title'] = $value;
                }

                if (is_array($value) && strpos($key, 'addImage') === 0) {
                    $posts['con'][$i]['content'] = htmlspecialchars('<img class=\"previewImage\" src=\"' . _WEB_ROOT . '/public/img/posts/' . $value['name'] . '\" alt="\Preview\" >');
                    $posts['con'][$i]['number'] = $i;
                    move_uploaded_file($value['tmp_name'], "public/img/posts/" . $value['name']);
                }
                $i++;
            }
        }


        echo "<pre>";
        print_r($data);
        echo "<pre>";
        print_r($posts);



        $this->model->insertposts($posts);



        $this->view("Admin/Posts/AddPosts", $this->data);
    }

    public function listAppointment()
    {
        $this->data['title'] = "Tìm kiếm lịch hẹn";

        $id_appointment = null;
        $email_sdt = null;
        $formatted_date = null;
        $listPatient_appointment = $this->model->getListAppointment();
        if (isset($_REQUEST['btn_search']) && $_REQUEST['btn_search'] == 'Tìm kiếm') {
            $date_search = $_REQUEST['date_search'];
            if (!empty($date_search)) {
                $date_appointment = DateTime::createFromFormat('Y-m-d', $date_search);
                if ($date_appointment !== false) {
                    // Chuyển đổi định dạng thành 'd/m/Y'
                    $formatted_date = $date_appointment->format('d/m/Y');
                }
            }

            $email_sdt = $_REQUEST['search'];
        }

        foreach ($listPatient_appointment as $appointment) {
            if (strcasecmp(trim($formatted_date), trim($appointment['dateAppointment'])) == 0) {
                if (strcasecmp(trim($email_sdt), trim($appointment['emailPatient'])) == 0 || strcasecmp(trim($email_sdt), trim($appointment['phonePatient'])) == 0) {
                    $id_appointment = $appointment['id_appointment'];
                    $this->data['id_appointment'] = $id_appointment;
                    break;
                }
            }
        }

        if ($id_appointment !== null) {
            $this->data['infoAppointment'] = $this->model->getListAppointment('WHERE appointment.id_appointment = ' . $id_appointment);
        }
        $this->view("Admin/ListAppointment", $this->data);

    }

}
