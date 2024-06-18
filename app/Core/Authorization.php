<?php

$access_rights = [
    _WEB_ROOT . "/home/appointment" => 5,
    _WEB_ROOT . "/Home/appointmentDetail" => 5,


    _WEB_ROOT . "/Personal/medicalBill" => 4,
    _WEB_ROOT . "/Personal/workCalendar" => 4,
    _WEB_ROOT . "/Personal/prescription" => 4,
    _WEB_ROOT . "/Personal/medicalHistory" => 5,
    _WEB_ROOT . "/Personal/medicalBillPDF" => [4, 5],
    _WEB_ROOT . "/Personal/prescriptionPDF" => [4, 5],
    _WEB_ROOT . "/Personal/listAppointment" => 5,
    _WEB_ROOT . "/Personal/deleteAppointment" => 5,
    _WEB_ROOT . "/Personal/listAppointmentPDF" => 5,
    _WEB_ROOT . "/Personal/medicalHistoryPatient" => 4,


    _WEB_ROOT . "/admin" => [1, 2, 3],
    _WEB_ROOT . "/admin/message" => 2,
    _WEB_ROOT . "/admin/listmedicine" => 3,
    _WEB_ROOT . "/admin/addMedicine" => 3,
    _WEB_ROOT . "/admin/updateMedicine" => 3,
    _WEB_ROOT . "/admin/listUsersStaff" => 1,
    _WEB_ROOT . "/admin/listStaffDelete" => 1,
    _WEB_ROOT . "/admin/updateUser" => 1,
    _WEB_ROOT . "/admin/listUsersPatient" => 1,
    _WEB_ROOT . "/admin/listPatientDelete" => 1,
    _WEB_ROOT . "/admin/listAppointment" => 2,








];
?>