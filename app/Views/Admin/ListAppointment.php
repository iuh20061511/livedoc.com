<?php
require './app/Views/inc/HeaderAdmin.php';
?>
<div class="container text-center">
    <h4 class="text-center" style="color: #283779;font-weight: 700">
        <?php echo $title; ?>
    </h4>
    <form action="" method="post">
        <input type="date" name="date_search" style="width: 20%;" class="p-1 rounded mr-5">
        <input type="search" name="search" style="width: 60%;" class="p-1 rounded ">
        <input type="submit" name="btn_search" value="Tìm kiếm" class="p-1 rounded btn-primary pl-2 pr-2">
    </form>
    <div class="row">
        <?php
        if(empty($_POST['date_search']) || empty($_POST['search'])){
            echo '<div class="row">
                <p style="color: #283779;font-weight: 700; margin-top:10px">Vui lòng chọn và nhập đầy đủ thông tin cần tìm kiếm</p>
                </div>';
            echo '<div class="container border p-4 mt-3" style="border: 1px solid #C5C5D2 !important; display:none;">';
        }else if (empty($id_appointment)) {
            echo '<div class="row">
                <p style="color: #283779;font-weight: 700; margin-top:10px">Không tìm thấy thông tin phiếu đặt hẹn</p>
                </div>';
            echo '<div class="container border p-4 mt-3" style="border: 1px solid #C5C5D2 !important; display:none;">';
        } else {
            echo '<div class="container border p-4 mt-3" style="border: 1px solid #C5C5D2 !important;">';
        }
        ?>

        <div class="row">
            <div class="col-xl-12 col-xxl-1">
                <img src="<?php echo _WEB_ROOT; ?>/public/img/gallery/logo.png" alt="" width="100px" class="mt-2">
            </div>
            <hr>

            <div class="col-12 text-center m-3">
                <h3 style="color: #283779;font-weight: 700">PHIẾU ĐĂNG KÝ KHÁM BỆNH</h3>
            </div>
        </div>

        <div class="row">
            <table width="1149" height="370" align="center">
                <tbody>
                    <tr>
                        <td width="170" height="60" style="color: #283779;font-weight: 700" align="left">Mã phiếu
                        </td>
                        <td width="221" align="left"><?php echo $infoAppointment[0]['id_appointment']; ?></td>
                        <td height="60" align="left" style="color: #283779;font-weight: 700">Ngày đặt hẹn</td>
                        <td align="left"><?php echo $infoAppointment[0]['dateAppointment']; ?></td>
                        <td width="365" align="center" style="color: #283779;font-weight: 700">BÁC SĨ PHỤ TRÁCH</td>
                    </tr>

                    <tr>
                        <td height="60" align="left" style="color: #283779;font-weight: 700">Họ tên bệnh nhân</td>
                        <td align="left"><?php echo $infoAppointment[0]['fullNamePatient']; ?></td>
                        <td height="60" align="left" style="color: #283779;font-weight: 700">Giờ hẹn</td>
                        <td align="left"><?php echo $infoAppointment[0]['hourAppointment']; ?></td>

                        <td rowspan="4" align="center"><img
                                src="<?php echo _WEB_ROOT; ?>/public/img/users/<?php echo $infoAppointment[0]['imageStaff']; ?>"
                                width="250" height="202" alt="" /></td>
                    </tr>

                    <tr>
                        <td height="60" align="left" style="color: #283779;font-weight: 700">Ngày sinh</td>
                        <td align="left"><?php echo $infoAppointment[0]['birthdayPatient']; ?></td>
                        <td colspan="2" align="left" style="color: #283779;font-weight: 700">Vấn đề sức khỏe được
                            khai báo trước đó
                        </td>
                    </tr>

                    <tr>
                        <td height="60" align="left" style="color: #283779;font-weight: 700">Email</td>
                        <td align="left"><?php echo $infoAppointment[0]['emailPatient']; ?></td>
                        <td colspan="2" rowspan="3" align="center" style="border: solid 1px #C5C5D2;">
                            <?php echo $infoAppointment[0]['describe_problem']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td height="60" align="left" style="color: #283779;font-weight: 700">Số điện thoại</td>
                        <td align="left"><?php echo $infoAppointment[0]['phonePatient']; ?></td>
                    </tr>

                    <tr>
                        <td height="60" align="left" style="color: #283779;font-weight: 700">Trạng thái</td>
                        <td align="left"><?php
                        if ($infoAppointment[0]['statusAppointment'] == 1) {
                            echo "Đã khám";
                        } else {
                            echo "Chưa khám";
                        }
                        ?>
                        </td>
                        <td align="center" style="color: #283779;font-weight: 700">
                            <?php echo $infoAppointment[0]['fullNameStaff']; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr style="border: 1px solid #C5C5D2 !important;">
        <div class="row">
            <p style="color: #283779;font-weight: 700">Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, Thành phố
                Hồ Chí Minh</p>
            <p style="color: #283779;font-weight: 700">Số điện thoại: 0888-112-112</p>
        </div>


    </div>
</div>
<?php
require './app/Views/inc/FooterAdmin.php';

?>