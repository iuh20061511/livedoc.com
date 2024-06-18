<?php



class Home extends Controller
{

    private $model;
    private $data = [];



    public function __construct()
    {
        $this->model = $this->model('HomeModel');


        require_once "./Library/Pusher/vendor/autoload.php";

        if (isset($_POST['content'])) {

            $data = [
                'id_patient' => $_POST['id'],
                'id_staff' => 6,
                'id_sender' => $_SESSION['is_login']['id_account'],
                'content' => $_POST['content'],
                'send_date' => date("Y-m-d H:i:s"),

            ];

            $this->model->InsertData('message', $data);

            $message = $_POST;
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                'ba446993eba998736b81',
                '1573c3e0dab7aeb46261',
                '1798446',
                $options
            );


            $data['message'] = $message;
            $pusher->trigger('my-channel', 'my-event', $data);


        }
    }
    public function index()
    {
        $dk = "";
        if (isset($_SESSION['is_login']['id_account'])) {
            $acc = $_SESSION['is_login']['id_account'];
            $dk = "WHERE id_patient = $acc";
        }

        $this->data['doctor'] = $this->model->getListFromTowTables('staff', 'department', 'id_department', 'id_department', "WHERE staff.id_department != 7");
        $this->data['message'] = $this->model->getListTable('message', "$dk");

        $this->view("Home/Home", $this->data);
    }

    public function error()
    {
        $this->view("Error/404");
    }



    public function appointment()
    {
        $dk = "";
        if (isset($_SESSION['is_login']['id_account'])) {
            $acc = $_SESSION['is_login']['id_account'];
            $dk = "WHERE id_patient = $acc";
        }
        $this->data['message'] = $this->model->getListTable('message', "$dk");
        $this->data['departments'] = $this->model->getListTable('department');
        $this->data['doctors'] = $this->model->getListTable('staff', 'WHERE id_role=4');

        if (isset($_POST['sub_appointment'])) {
            if ((isset($_POST['department']) && $_POST['department'] != 0) && (isset($_POST['doctor']) && $_POST['doctor'] != 0)) {
                $_SESSION['appointment']['department'] = $_POST['department'];
                $_SESSION['appointment']['doctor'] = $_POST['doctor'];

                $redirectUrl = _WEB_ROOT . "/home/appointmentDetail";
                header("refresh:0; url=$redirectUrl");
            }

        }

        $this->view("Home/Appointment", $this->data);
    }

    public function appointmentDetail()
    {


        if (isset($_GET['day']) && isset($_GET['month']) && isset($_GET['year'])) {

            $date = $_GET['year'] . '-' . $_GET['month'] . '-' . $_GET['day'];
            $_SESSION['day'] = $_GET['day'];
            $_SESSION['month'] = $_GET['month'];
            $_SESSION['year'] = $_GET['year'];

            $id_staff = $_SESSION['appointment']['doctor'];
            $this->data['appointment'] = $this->model->getListTable('appointment', "WHERE date='$date' AND id_staff =  $id_staff");

        }


        if (isset($_POST['appointmentDetail'])) {

            if (isset($_POST['hour'])) {
                $dateAp = $_SESSION['year'] . '-' . $_SESSION['month'] . '-' . $_SESSION['day'];
                $id_patient = $_SESSION['is_login']['id_account'];
                $appointTime = $this->model->getListTable('appointment', "WHERE date='$dateAp' AND id_patient = $id_patient");

                $check = true;
                foreach ($appointTime as $item) {
                    if ($item['hour'] == $_POST['hour']) {
                        $check = false;

                    }
                }

                if ($check == true) {

                    $data = [
                        'date' => $_POST['date'],
                        'hour' => $_POST['hour'],
                        'describe_problem' => $_POST['describe_problem'],
                        'id_patient' => $_SESSION['is_login']['id_account'],
                        'id_staff' => $_POST['doctor']

                    ];

                    $this->model->InsertData('appointment', $data);

                    require_once "./Library/Pusher/vendor/autoload.php";

                    $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                    );
                    $pusher = new Pusher\Pusher(
                        'be39c21145a308bb822e',
                        'a3ac9c4ef3152b39c6a7',
                        '1772586',
                        $options
                    );

                    $hour = $_POST['hour'];
                    $date = $_POST['date'];
                    $doctor = $_POST['doctor'];

                    $data = array(
                        'hour' => $hour,
                        'date' => $date,
                        'doctor' => $doctor
                    );
                    $pusher->trigger('my-channel', 'my-event', $data);
                    echo "<script>alert('Đặt lịch khám thành công')</script>";
                    unset($_POST);
                } else {
                    echo "<script>alert('Bạn đã đặt giờ khám ngày này rồi! Vui lòng chọn giờ khám khác')</script>";
                    $redirectUrl = _WEB_ROOT . '/home' . '/appointmentDetail?day=' . $_SESSION['day'] . '&month=' . $_SESSION['month'] . '&year=' . $_SESSION['year'];
                    header("refresh:0; url=$redirectUrl");
                    unset($_POST);

                }
            } else {
                echo "<script>alert('Vui lòng chọn giờ khám !')</script>";
                $redirectUrl = _WEB_ROOT . '/home' . '/appointmentDetail?day=' . $_SESSION['day'] . '&month=' . $_SESSION['month'] . '&year=' . $_SESSION['year'];
                header("refresh:0; url=$redirectUrl");

            }

        }
        $dk = "";
        if (isset($_SESSION['is_login']['id_account'])) {
            $acc = $_SESSION['is_login']['id_account'];
            $dk = "WHERE id_patient = $acc";
        }
        $this->data['message'] = $this->model->getListTable('message', "$dk");

        $this->view("Home/AppointmentDetail", $this->data);
    }



    public function posts($conditionContent = 1)
    {
        $this->data['post'] = $this->model->getListFromTowTablesCondition('posts', 'postcontents', 'id_post', 'id_post', "posts.id_post = $conditionContent");


        $this->view("Home/Posts", $this->data);
    }

}
