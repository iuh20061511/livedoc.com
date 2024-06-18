<?php
require './app/Views/inc/HeaderPersonal.php';
?>



<main id="main" class="main">

    <div class="container-fluid px-4 calendar">

        <h3>Lịch sử khám bệnh</h3><br>
        <div class="table-responsive p-3">
            <table class="table table table-striped table-hover" id="dataTable">
                <thead>
                    <tr class="text-center">
                        <th>STT</th>
                        <th>Thời gian khám</th>
                        <th>Bác sĩ</th>
                        <th>Phiếu Khám</th>
                        <th>Cách dùng thuốc</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($medicalHistory as $item) { ?>
                        <tr>
                            <td>
                                <?php echo $i++ ?>
                            </td>
                            <td>
                                <?php echo date("d/m/Y", strtotime($item['date_create'])); ?>
                            </td>
                            <td>
                                <?php echo $item['full_name'] ?>
                            </td>
                            <td>
                                <a href="<?php echo _WEB_ROOT ?>/Personal/medicalBillPDF/<?php echo $item['id_record'] ?>"
                                    class="text-danger">Xem <i class="bi bi-filetype-pdf"></i></a>

                            </td>
                            <td>
                                <a href="<?php echo _WEB_ROOT ?>/Personal/prescriptionPDF/<?php echo $item['id_record'] ?>"
                                    class="text-danger">Xem <i class="bi bi-filetype-pdf"></i></a>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
    </div>
</main>

<?php
require './app/Views/inc/FooterPersonal.php';

?>