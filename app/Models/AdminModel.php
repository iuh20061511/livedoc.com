<?php


class AdminModel extends Model
{

    public function getListUserMessage($condition = '')
    {
        $query = "SELECT patient.*, message.id_patient, COUNT(message.id_patient) AS message_count, message.send_date FROM patient 
        INNER JOIN message ON patient.id_patient = message.id_patient WHERE message.status=0 AND message.id_sender % 2 = 1 GROUP BY patient.id_patient 
        ORDER BY message.send_date DESC;";
        $result = mysqli_query($this->connect, $query);
        $data = array();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function countAppointment($check = '')
    {
        $query = "SELECT COUNT(id_appointment) AS total_appointments FROM  appointment WHERE MONTH(date) = MONTH(CURRENT_DATE()) AND YEAR(date) = YEAR(CURRENT_DATE()) $check ";
        $result = mysqli_query($this->connect, $query);
        $data = array();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function countPatient()
    {
        $query = "SELECT COUNT(id_patient) AS total_patient FROM patient ";
        $result = mysqli_query($this->connect, $query);
        $data = array();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getListAppointment($condition = ""){
        $query = "SELECT
            appointment.id_appointment as id_appointment,
            appointment.check as statusAppointment,
            appointment.date as dateAppointment,
            appointment.hour as hourAppointment,
            appointment.describe_problem as describe_problem,
            patient.full_name as fullNamePatient,
            patient.email as emailPatient,
            patient.gender as genderPatient,
            patient.birthday as birthdayPatient,
            patient.phone as phonePatient,
            staff.image as imageStaff,
            staff.full_name as fullNameStaff
        FROM patient
        INNER JOIN appointment ON patient.id_patient = appointment.id_patient
        INNER JOIN staff ON appointment.id_staff = staff.id_staff
        INNER JOIN department ON department.id_department = staff.id_department
        $condition";
        
        $result = mysqli_query($this->connect, $query);
        $data = array();
        
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Chuyển đổi ngày về định dạng dd/mm/yyyy
                if (!empty($row['dateAppointment'])) {
                    $date = DateTime::createFromFormat('Y-m-d', $row['dateAppointment']);
                    if ($date) {
                        $row['dateAppointment'] = $date->format('d/m/Y');
                    }
                }
                if (!empty($row['birthdayPatient'])) {
                    $date = DateTime::createFromFormat('Y-m-d', $row['birthdayPatient']);
                    if ($date) {
                        $row['birthdayPatient'] = $date->format('d/m/Y');
                    }
                }
                $data[] = $row;  // Thêm mỗi hàng vào mảng
            }
        }
        
        return $data;
    }
    
    


    // public function insertposts($posts)
    // {
    //     $insert = '';

    //     $title = $posts['title'];
    //     $created_at = date('Y-m-d');
    //     $id_staff =  $_SESSION['is_login']['id_account'];

    //     $insert  = "INSERT INTO `posts`(title, created_at, id_staff) VALUES('$title', '$created_at','$id_staff');";

    //     $insert .= "INSERT INTO `postcontents`(content_order, content, id_post) VALUES  ";
    //     foreach ($posts['con'] as $item) {
    //         $con = $item['content'];
    //         $number =  $item['number'];
    //         $insert .= "('$number', '$con', LAST_INSERT_ID()),";  //@@IDENTITY
    //     }
    //     $insert = rtrim($insert, ",");

    //     $kq = mysqli_multi_query($this->connect, $insert);
    //     return $kq;
    // }
}
