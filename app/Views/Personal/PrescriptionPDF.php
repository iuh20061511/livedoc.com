<?php
use Dompdf\Dompdf;

$dompdf = new Dompdf();
// echo "<pre>";
// print_r($medicalBill);

$fullNameStaff = $medicalBill[0]['fullNameStaff'];
$fullNamePatient = $medicalBill[0]['fullNamePatient'];
$phone = $medicalBill[0]['phone'];
$emailPatient = $medicalBill[0]['emailPatient'];
$genderPatient = $medicalBill[0]['genderPatient'];
$diagnose = $medicalBill[0]['diagnose'];
$birthday = $medicalBill[0]['diagnose'];
$patientBirthday = date("d/m/Y", strtotime($medicalBill[0]['patientBirthday']));
$fullNameStaff = $medicalBill[0]['fullNameStaff'];
$advice = $medicalBill[0]['advice'];
$date = date('d \n\g\à\y m \n\ă\m Y', strtotime($medicalBill[0]['date_create']));
$dateTime = date('H \g\i\ờ\ i \p\h\ú\t\, \n\g\à\y d \t\h\á\n\g m \n\ă\m Y', strtotime($medicalBill[0]['date_create']));
$html = "<html>
<head>
<meta charset='UTF-8'>
<style>
body {
  font-family: DejaVu Sans, sans-serif;
}
tr, thead, tbody {
   border:1px solid; 
}
td {
text-align:center;
padding: 5px;
}
</style>
</head>
<body>
<div class='container border p-4 mt-3'>
<div style='margin-bottom:40px;'>
    <div>
    <h1 style='margin-top:-30px; color:#1B11A1'>LIVEDOC</h1>  
    <p style='margin-top:-30px; color:#1B11A1'>Bệnh viện đa khoa LIVEDOC</p>
    <p style='margin-top:-20px; color:#1B11A1'>Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, Thành phố Hồ Chí Minh</p>
    </div>
    <hr>
    <div style='float:right'>
        <span><b>TP Hồ Chí Minh</b>, $date</span>
    </div>
</div>
<h2 style='position:relative; left:220px; color:red;'>CÁCH DÙNG THUỐC</h2>
    <div class='form-group row'>
    <div style='float:right'>
       <label for='ngaySinh'>Ngày Sinh:</label>
       $patientBirthday
     </div>
        <div>
            <label for='hoTen'>Họ và Tên:</label>
            $fullNamePatient
        </div>
       <div>
        <label for='điện thoại'>Điện thoại:</label>
         $phone
    </div>
    <div>
        <label for='trieuChung'>Email:</label>
        $emailPatient 
    </div>
    <div>
        <label for='trieuChung'>Giới tính:</label>
        $genderPatient
    </div>
    <div style='margin-bottom:20px'> 
        <span>Kết quả chuẩn đoán:</span>
        $diagnose
    </div>
    <div class='form-group' style='position:relative;'>
        <table style='border:1px solid; width:100%;'>
            <thead>
                <tr>
                    <th scope='col'>STT</th>
                    <th scope='col'>Tên thuốc</th>
                    <th scope='col'>Số lượng</th>
                    <th scope='col'>Đơn vị</th>
                    
                </tr>
            </thead>
            <tbody>";

foreach ($medicalBill as $item) {
    $name_medicine = $item['name_medicine'];
    $unit = $item['unit'];
    $billQuantity = $item['billQuantity'];
    $medicine_price = currency_format($item['medicine_price']);
    $instructions = $item['instructions'];
    $html .= "
    <tr>
        <th>1</th>
        <td>$name_medicine</td>
        <td>$billQuantity</td>
        <td>$unit</td>
        
    </tr>
                <tr>
                   <td colspan='4' style='text-align:left; color:red'>Cách dùng: $instructions</td>
                </tr>
                <tr>
                <td colspan='4'><hr></td>
             </tr>";
             
}
$html .= "
            </tbody>
        </table>
    </div>
    <div style='margin-bottom:30px'>
        <p>Thời gian: $dateTime </p>
        <p>Bác sĩ khám: $fullNameStaff</p>
        <div class='row'>
            <span><b>Lời dặn của bác sĩ:</b></span>
            $advice
        </div>
    </div>
   
</div>
</body>
</html>";


// Load HTML vào Dompdf
$dompdf->loadHtml($html, 'UTF-8');

// Render HTML thành PDF
$dompdf->render();

// Lấy dữ liệu PDF
$pdfContent = $dompdf->output();

// Hiển thị dữ liệu PDF trong một trang HTML
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview PDF</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        iframe {
            border: none;
            width: 100%;
            height: 100%;

        }
    </style>
</head>

<body>
    <iframe src="data:application/pdf;base64,<?= base64_encode($pdfContent); ?>"></iframe>
</body>

</html>

