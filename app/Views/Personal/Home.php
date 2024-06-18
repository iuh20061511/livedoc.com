<?php
require './app/Views/inc/HeaderPersonal.php';
?>



<main id="main" class="main">

    <div class="pagetitle">
        <h1>Thêm thuốc mới</h1>


        <!-- ========================================================================== -->

        <form class="row g-3 m-3">
            <div class="col-md-12">
                <label for="validationDefault01" class="form-label">Nhập tên thuốc:</label>
                <input type="text" class="form-control" id="validationDefault01" value="">
            </div>

            <div class="col-md-12">
                <label for="validationDefault04" class="form-label">Chọn loại thuốc:</label>
                <select class="form-select border" id="validationDefault04">
                    <option selected disabled value="">Chọn loại thuốc...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="validationDefault03" class="form-label">Nhập số lượng:</label>
                <input type="number" class="form-control" id="validationDefault03" required>
            </div>

            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Ngày sản xuất:</label>
                <input type="date" class="form-control" id="validationDefault02" value="Otto">
            </div>

            <div class="col-md-4">
                <label for="validationDefault02" class="form-label">Hạn sử dụng:</label>
                <input type="date" class="form-control" id="validationDefault02" value="Otto">
            </div>

            <div class="col-md-2">
                <label for="validationDefault04" class="form-label">Giá mỗi lọ:</label>
                <input type="number" class="form-control" id="validationDefault02" value="Otto">
            </div>

            <div class="col-md-2">
                <label for="validationDefault04" class="form-label">Giá mỗi hộp:</label>
                <input type="number" class="form-control" id="validationDefault02" value="Otto">
            </div>
            <div class="col-md-2">
                <label for="validationDefault04" class="form-label">Giá mỗi vỉ:</label>
                <input type="number" class="form-control" id="validationDefault02" value="Otto">
            </div>
            <div class="col-md-2">
                <label for="validationDefault04" class="form-label">Giá mỗi viên:</label>
                <input type="number" class="form-control" id="validationDefault02" value="Otto">
            </div>


            <div class="col-12 text-center">
                <input type="submit" class="btn btn-primary" value="Thêm">
            </div>
        </form>

</main>
<?php
require './app/Views/inc/FooterPersonal.php';
?>