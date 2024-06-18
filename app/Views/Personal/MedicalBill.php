<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <title>Lập phiếu khám bệnh</title>



    <link rel="apple-touch-icon" sizes="180x180"
        href="<?php echo _WEB_ROOT; ?>/public/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon-16x16.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/favicon.ico">
    <link rel="manifest" href="<?php echo _WEB_ROOT; ?>/public/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?php echo _WEB_ROOT; ?>/public/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <link href="<?php echo _WEB_ROOT; ?>/public/css/theme.css" rel="stylesheet" />

</head>
<style>
    .option {
        list-style: none;
        padding: 0;
    }

    .option li {
        cursor: pointer;
        display: none;
        /* Ẩn tất cả các tùy chọn ban đầu */
    }


    .option li.visible {
        display: block;
        /* Hiển thị tùy chọn nếu được tìm thấy */
    }

    .option li:hover {
        background-color: #f0f0f0;
    }
</style>

<body>
    <a href="<?php echo _WEB_ROOT; ?>/Personal/" style="font-size: 20px; position:absolute; left: 20px;"><i
            class="bi bi-house-door" style="font-size: 50px;"></i><span>Quay lại</span></a>

    <div class="container border p-4 mt-3">

        <div class="row">
            <div class="col-xl-12 col-xxl-1">
                <img src="<?php echo _WEB_ROOT; ?>/public/img/gallery/logo.png" alt="" width="100px" class="mt-2">
            </div>
            <div class="col-xl-12 col-xxl-11">
                <span>Bệnh viện đa khoa LIVEDOC</span>
                <p>Địa chỉ: 12 Nguyễn Văn Bảo, Phường 4, Gò Vấp, Thành phố Hồ Chí Minh</p>
            </div>

            <hr>
            <div class="col-12 text-end m-3">
                <?php
                // Lấy ngày tháng năm hiện tại
                $ngayThangNam = date("\\n\g\à\y d \\t\h\á\\n\g m \\n\ă\m Y");

                ?>

                <span><b>TP Hồ Chí Minh</b>, <?php echo $ngayThangNam; ?></span>
            </div>

            <div class="col-12 text-center m-3">
                <h3>PHIẾU KHÁM BỆNH</h3>
            </div>
        </div>


        <form action="<?php echo _WEB_ROOT; ?>/Personal/prescription/<?php echo $id_appointment ?>" method="POST">
            <div class="form-group row">
                <div class="col-sm-12 col-md-6">
                    <label for="hoTen">Họ và Tên:</label>
                    <input type="text" class="border-0" name="fullname" placeholder="Nhập họ và tên..."
                        style="outline: none;" value="<?php echo $patient[0]['fullNamePatient'] ?>">
                    <input type="hidden" class="border-0" name="id_patient"
                        value="<?php echo $patient[0]['id_patient'] ?>">

                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="ngaySinh">Ngày Sinh:</label>
                    <input type="text" class="border-0" name="birthday" placeholder="Nhập ngày sinh..."
                        style="outline: none;"
                        value="<?php echo date("d/m/Y", strtotime($patient[0]['patientBirthday'])) ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="điện thoại">Điện thoại:</label>
                <input type="text" class="border-0" name="phone" placeholder="Nhập số điện thoại..."
                    style="outline: none;" value="<?php echo $patient[0]['patientPhone'] ?>">
            </div>

            <div class="form-group">
                <label for="trieuChung">Email:</label>
                <input type="text" class="border-0" name="email" placeholder="Nhập email..." style="outline: none;"
                    value="<?php echo $patient[0]['emailPatient'] ?>">
            </div>

            <div class="form-group">
                <label for="trieuChung">Giới tính:</label>
                <input type="text" class="border-0" name="gender" placeholder="Nhập giới tính..." style="outline: none;"
                    value="<?php echo $patient[0]['genderPatient'] ?>">
            </div>

            <div class="form-group row">
                <span class="col-lg-12 col-xl-2" for="" style="font-weight: 500;">Kết quả chuẩn đoán:</span>
                <textarea name="diagnose" id="responsiveTextarea" class="border-0 col-lg-12 col-xl-10"
                    style="margin-left: -20px; outline: none;" rows="5"
                    placeholder="Nhập chuẩn đoán kết quả khám..."></textarea>
            </div>

            <div class="form-group" style="position: relative;">
                <table class="table" id="medicineTable">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên thuốc</th>
                            <th scope="col">Đơn vị tính</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Đơn giá</th>
                            <th scope="col">Thành tiền</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php for ($i = 1; $i <= 3; $i++) { ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td> <input type="text" class="border-0" id="optionSearch<?php echo $i ?>"
                                        name="tenthuoc<?php echo $i ?>" placeholder="Nhập tên thuốc..."
                                        style="outline: none;">
                                    <ul class="option optionList<?php echo $i ?>">
                                        <?php foreach ($medicine as $item) { ?>
                                            <li><?php echo $item['name_medicine'] ?></li>
                                        <?php } ?>
                                    </ul>
                                </td>
                                <td id="unit<?php echo $i ?>"></td>
                                <input type="hidden" name="dvt<?php echo $i ?>" id="dvt<?php echo $i ?>">
                                <td><input type="text" class="border-0" name="sl<?php echo $i ?>" id="sl<?php echo $i ?>"
                                        placeholder="Nhập số lượng..." style="outline: none;"></td>
                                <td><input type="text" class="border-0" name="dg<?php echo $i ?>" id="dg<?php echo $i ?>"
                                        placeholder="Nhập đơn giá..." style="outline: none;"></td>
                                <td><input type="text" class="border-0" name="tt<?php echo $i ?>" id="tt<?php echo $i ?>"
                                        style="outline: none;" readonly></td>
                            </tr>


                        <?php } ?>

                        <i id="addRowBtn" class="bi bi-plus-circle"
                            style="position: absolute; right: 10px; bottom: -50px; font-size: 32px;"></i>


                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">Tổng tiền: </td>
                            <td><input class="border-0" type="text" id="total" name="total" style="outline: none;"
                                    readonly></td>
                        </tr>
                    </tfoot>
                </table>


            </div>

            <div class="col-12" style="margin-top: 50px;">

                <?php
                $thoiGianHienTai = date("H \g\\i\ờ i \p\h\ú\\t, \\n\g\à\y d \\t\h\á\\n\g m \\n\ă\m Y");
                ?>
                <p><?php echo $thoiGianHienTai; ?></p>
                <p> Bác sĩ khám: <?php echo $_SESSION['is_login']['fullname']; ?></p>
                <div class="row">
                    <span class="col-lg-12 col-xl-2" for="" style="font-weight: 500;">Lời dặn của bác sĩ:</span>
                    <textarea name="advice" id="responsiveTextarea" class="border-0 col-lg-12 col-xl-10"
                        style="margin-left: -30px; outline: none;" rows="4" placeholder="Nhập lời dặn..."></textarea>
                </div>
            </div>


            <div class="col-12 row">
                <div class="col-4 text-center">
                    <h5>Bệnh nhân</h5>
                    <p>(Ký, họ tên)</p>

                </div>
                <div class="col-4 text-center">
                    <h5>Nhân viên thu ngân</h5>
                    <p>(Ký, họ tên)</p>

                </div>
                <div class="col-4 text-center">
                    <h5>Bác sĩ</h5>
                    <p>(Ký, họ tên)</p>

                </div>
            </div>
            <div class="col-12 text-center" style="margin-bottom: 50px; margin-top: 100px;">
                <input type="submit" class="btn btn-primary text-center col-12" value="Xuất phiếu"
                    name="savebill"></input>
            </div>
        </form>

    </div>








</body>

</html>

<script>
    document.getElementById('addRowBtn').addEventListener('click', function () {
        var tableBody = document.querySelector('#medicineTable tbody');
        var rowCount = tableBody.getElementsByTagName('tr').length + 1;

        var newRow = document.createElement('tr');
        newRow.innerHTML = `
        <th scope="row">${rowCount}</th>
        <td>
            <input type="text" class="border-0" id="optionSearch${rowCount}" name="tenthuoc${rowCount}" placeholder="Nhập tên thuốc..." style="outline: none;">
            <ul class="option optionList${rowCount}">
            <ul class="option optionList${rowCount}">
            <?php foreach ($medicine as $item) { ?>
                    <li><?php echo $item['name_medicine'] ?></li>
            <?php } ?>
            </ul>
            </ul>
        </td>
        <td id="unit${rowCount}"></td>
        <input type="hidden" name="dvt${rowCount}" id="dvt${rowCount}">
        <td><input type="text" class="border-0" name="sl${rowCount}" id="sl${rowCount}" placeholder="Nhập số lượng..." style="outline: none;"></td>
        <td><input type="text" class="border-0" name="dg${rowCount}" id="dg${rowCount}" placeholder="Nhập đơn giá..." style="outline: none;"></td>
        <td><input type="text" class="border-0" name="tt${rowCount}" id="tt${rowCount}" style="outline: none;"></td>
    `;

        tableBody.appendChild(newRow);

        // Gán lại sự kiện cho các phần tử mới
        assignEventListeners(rowCount);
    });

    // Hàm gán lại sự kiện cho các phần tử mới
    function assignEventListeners(rowCount) {
        const inputId = `optionSearch${rowCount}`;
        const unitId = `unit${rowCount}`;
        const dgi = `dg${rowCount}`;
        const slInputId = `sl${rowCount}`;
        const dvt = `dvt${rowCount}`;

        const optionSearch = document.getElementById(inputId);
        const unitElement = document.getElementById(unitId);
        var donGiaInput = document.getElementById(dgi);
        var soLuongInput = document.getElementById(slInputId);
        var donvitinh = document.getElementById(dvt);



        optionSearch.addEventListener('blur', function () {
            const inputValue = optionSearch.value.trim();
            const unit = unitMap[inputValue];
            unitElement.textContent = unit ? `${unit.unit}` : "";
            donvitinh.value = unit ? `${unit.unit}` : "";
        });

        const optionListClass = `optionList${rowCount}`;
        const optionList = document.querySelector(`.${optionListClass}`);
        const options = optionList.querySelectorAll('li');

        optionSearch.addEventListener('input', function () {
            const inputValue = optionSearch.value.toLowerCase();

            if (inputValue === "") {
                options.forEach(function (option) {
                    option.classList.remove('visible');
                });
            } else {
                options.forEach(function (option) {
                    const optionText = option.textContent.toLowerCase();
                    const isMatch = optionText.indexOf(inputValue) !== -1;

                    if (isMatch) {
                        option.classList.add('visible');
                    } else {
                        option.classList.remove('visible');
                    }
                });
            }
        });

        optionSearch.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const visibleOptions = optionList.querySelectorAll('li.visible');

                if (visibleOptions.length === 1) {
                    optionSearch.value = visibleOptions[0].textContent;
                }

                options.forEach(function (option) {
                    option.classList.remove('visible');
                });
            }
        });

        optionList.addEventListener('click', function (event) {
            if (event.target.tagName === 'LI') {
                optionSearch.value = event.target.textContent;
            }
        });

        optionSearch.addEventListener('blur', function () {
            const inputValue = optionSearch.value.trim();
            const drugInfo = unitMap[inputValue];
            if (drugInfo) {
                unitElement.textContent = `${drugInfo.unit}`;

                donGiaInput.value = `${drugInfo.value}`;
            } else {
                unitElement.textContent = "";
                donGiaInput.value = ""; // Gán giá trị rỗng nếu không tìm thấy thông tin thuốc
            }
        });

        soLuongInput.addEventListener('input', function () {
            calculateSubtotal(); // Tính toán lại tổng số tiền khi có sự thay đổi số lượng
        });
    }

    // Định nghĩa  giữa tên thuốc và đơn vị tính
    <?php
    echo "const unitMap = {";
    foreach ($medicine as $item) {
        echo '"' . $item['name_medicine'] . '": { "unit": "' . $item['unit'] . '", "value": ' . $item['medicine_price'] . ' },';
    }
    echo "};";

    ?>


    // Hàm gán sự kiện cho việc tính toán tự động cột "Thành tiền"
    var total = 0;

    function calculateSubtotal() {
        let newTotal = 0;
        for (let i = 1; i <= 100; i++) {
            const slInput = document.getElementById(`sl${i}`);
            const dgInput = document.getElementById(`dg${i}`);
            const ttInput = document.getElementById(`tt${i}`);

            if (slInput && dgInput && ttInput) {
                const slValue = parseFloat(slInput.value);
                const dgValue = parseFloat(dgInput.value);
                const subtotal = slValue * dgValue;

                if (!isNaN(subtotal)) {
                    ttInput.value = subtotal.toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });

                    sum = subtotal;
                    newTotal += sum;

                } else {
                    ttInput.value = '';
                }
            }

        }
        total = newTotal; // Cập nhật lại tổng số tiền chính là tổng số tiền mới
        document.getElementById('total').value = total.toLocaleString('vi-VN', {
            style: 'currency',
            currency: 'VND'
        });

    }



    // Lặp qua tất cả các input tìm kiếm thuốc
    for (let i = 1; i <= 100; i++) {
        assignEventListeners(i);
    }
</script>
