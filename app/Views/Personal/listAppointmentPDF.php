<?php
use Dompdf\Dompdf;

$dompdf = new Dompdf(array('enable_remote' => true));

;

$fullName = $appointment[0]['fullNamePatient'];
$genderPatient = $appointment[0]['genderPatient'];
$patientBirthday = date("d/m/Y", strtotime($appointment[0]['patientBirthday']));

$describe_problem = $appointment[0]['describe_problem'];

$image = _WEB_ROOT . '/public/img/users/' . $appointment[0]['patientImage'];

$room = $appointment[0]['id_staff'];

$html = "
<!DOCTYPE html>
<html lang='vi'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Document</title>
    <style>
        body {
             font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>
<body>

    <div style='float:left;'>
        <span style='color:blue'><b>Bệnh viện đa khoa LIVEDOC </b></span><br>
        <span style='font-size: 12px;'>Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, TPHCM</span>
    </div>
    <div style='float:right; text-align:center'>
        <span>Cộng hòa xã hội chủ nghĩa Việt Nam</span><br>
        <span style='font-size: 12px;  text-decoration: underline;'><b> Độc lập - Tự do - Hạnh phúc </b></span>
    </div>
    <div style='clear: left; clear: right;'></div>
    <hr>
    <h2 style='text-align:center; color:blue'>GIẤY KHÁM BỆNH</h2>
    <p style='font-size: 10px; margin-top: -25px; text-align:center'>(Tòa A Phòng A4.$room  )</p>
   <div style='margin-top:70px; width: 160px; display: inline-block;'>
    <img src='$image' alt='' style='width:140px;height: 100px'>
   </div>
    <div style='position: absolute; top: 160px; left: 200px'>
        <span>Họ và tên: $fullName 
        </span><br>
        <span>giới tính: $genderPatient
        </span><br>
        <span>Năm sinh: $patientBirthday
        </span><br>
        <span>Chỗ ở: </span><br>
        <span>Triệu chứng: $describe_problem
        </span><br>
    </div>


    <h4 style='text-align:center; color:blue;'>TIỀN SỬ CỦA ĐỐI TƯỢNG KHÁM SỨC KHỎE</h4>
    <p><b>1. Tiền sử gia đình</b></p>
    <p style='margin-top:-20px'>Có ai trong gia đình ông
        (bà) mắc một trong các bệnh: truyền nhiễm,
        tim mạch, đái tháo đường, ung thư,
        động kinh, rối loạn tâm thần:    </p>
        <div style='margin-top:-20px'>
    
        <span style='margin-right:100px'>    ☐ Có  </span>
        <span style='margin-right:100px'> ☐ Không </span>
        <span> ☐ Nếu có đề nghi ghi cụ  thể tên bệnh .............
        ............................................................................................................................................
    </span>
    </div>


    <p class='text-start'><b>2. Tiền sử bản thân</b></p>
    <p style='margin-top:-20px'>Ông (bà) có đã đang mắc
        một trong các bệnh: truyền nhiễm, tim mạch,
        đái tháo đường, ung thư,
        động kinh, rối loạn tâm thần:
        </span> <br>
        <span style='margin-right:100px'>    ☐ Có  </span>
        <span style='margin-right:100px'> ☐ Không </span>
        <span> ☐ Nếu có đề nghi ghi cụ  thể tên bệnh .............
        ............................................................................................................................................
    </span>

    <p class='text-start'><b>3. Câu hỏi khác (nếu
            có)</b></p>
            <p style='margin-top:-20px'>Ông (bà) có đang điều trị
        bệnh gì không. Nếu có hãy liệt kê các thuốc
        và liều lượng đang dùng:
        ............................................................................................................................................
        ............................................................................................................................................

    </p>

    <div style='position: absolute; bottom: 70px; left: 0px; width: 250px'>
        <p class='text-start'>Tôi xin cam đoan những điều
            khai trên đây,
            hoàn toàn đúng với sự thật theo hiểu
            biết của tôi</p>
    </div>
    <div class='col-2'>

    </div>
    <div  style='float:right'>
        <p>..........Ngày.........tháng.........Năm.........
        </p>
        <h5 style='text-align:center; margin-top:-20px'>Đề nghị khám sức khỏe</h5>
        <p style='text-align:center; margin-top:-25px; font-size:10px'>(Ký rõ họ và tên)</p>
    </div>
    <div style='height: 100px;'>

    </div>
    <span style='font-size: 10px; position: absolute; bottom: 0px; left: 0px; color:red'>* Vui
        lòng in phiếu trước khi đến khám bệnh</span>
   

</body>
</html>
";


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
            margin-left: auto;
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