<?php
require './app/Views/inc/HeaderAdmin.php';

?>
<div class="section__content section__content--p30">
  <h4 class="text-center"><?php echo $title; ?></h4>
  <div class="container-fluid">

    <div class="card-body" style="background-color: #fff; padding: 20px;">



      <form class="row g-3 m-3" action="" method="POST">
        <div class="col-md-12 mb-1">
          <label for="nameMedicine" class="form-label">Nhập tên thuốc:</label>
          <input type="text" class="form-control" name="nameMedicine" id="nameMedicine" placeholder="Tên thuốc" value="<?php
          if (!empty($_POST['nameMedicine']) && empty($error['nameMedicine'])) {
            echo $_POST['nameMedicine'];
          } ?>">
          <p class="text-danger mt-2"><b><?php
          if (!empty($error['nameMedicine'])) {
            echo $error['nameMedicine'];
          } ?></b></p>
        </div>

        <div class="col-4 mb-1">
          <label for="validationDefault04" class="form-label">Chọn loại thuốc:</label>
          <select class="form-select" name="typeMedicine">
            <option value="0">Chọn loại thuốc...</option>
            <?php
            foreach ($listTypeMedicine as $type) { ?>
              <option value="<?php echo $type['id_type_medicine']; ?>"><?php echo $type['name_type_medicine']; ?></option>
              <?php
            }
            ?>
          </select>
          <p class="text-danger mt-2"><b><?php
          if (!empty($error['typeMedicine'])) {
            echo $error['typeMedicine'];
          } ?></b></p>
        </div>

        <div class="col-4 mb-3">
          <label for="validationDefault03" class="form-label">Nhập số lượng:</label>
          <input type="number" class="form-control" name="quantity" placeholder="Số lượng" value="<?php
          if (!empty($_POST['quantity']) && empty($error['quantity'])) {
            echo $_POST['quantity'];
          } ?>">
          <p class="text-danger mt-2"><b><?php
          if (!empty($error['quantity'])) {
            echo $error['quantity'];
          } ?></b></p>
        </div>

        <div class="col-4 mb-3">
          <label for="validationDefault02" class="form-label">Ngày sản xuất:</label>
          <input type="date" class="form-control" name="manufacture" value="<?php
          if (!empty($_POST['manufacture']) && empty($error['manufacture'])) {
            echo $_POST['manufacture'];
          } ?>">
          <p class="text-danger mt-2"><b><?php
          if (!empty($error['manufacture'])) {
            echo $error['manufacture'];
          } ?></b></p>
        </div>

        <div class="col-4 mb-3">
          <label for="validationDefault02" class="form-label">Hạn sử dụng:</label>
          <input type="date" class="form-control" name="expiry" value="<?php
          if (!empty($_POST['expiry']) && empty($error['expiry'])) {
            echo $_POST['expiry'];
          } ?>">
          <p class="text-danger mt-2"><b><?php
          if (!empty($error['expiry'])) {
            echo $error['expiry'];
          } ?></b></p>
        </div>

        <div class="col-4 mb-3">
          <label for="validationDefault02" class="form-label">Giá:</label>
          <input type="number" class="form-control" name="price" placeholder="Giá " value="<?php
          if (!empty($_POST['price']) && empty($error['price'])) {
            echo $_POST['price'];
          } ?>">
          <p class="text-danger mt-2"><b><?php
          if (!empty($error['price'])) {
            echo $error['price'];
          } ?></b></p>
        </div>

        <div class="col-4 mb-3">
          <label for="validationDefault02" class="form-label">Đơn vị:</label>
          <select class="form-select" name="unit">
            <option value="0">---Chọn---</option>
            <option value="Hộp">Hộp</option>
            <option value="Lọ">Lọ</option>
            <option value="Viên">Viên</option>
            <option value="Vỉ">Vỉ</option>
            <option value="Gói">Gói</option>
            <option value="Tuýt">Tuýt</option>
            <option value="Ống">Ống</option>
          </select>
          <p class="text-danger mt-2"><b><?php
          if (!empty($error['unit'])) {
            echo $error['unit'];
          } ?></b></p>
        </div>

        <div class="col-12 text-center">
          <input type="submit" class="btn btn-primary" value="Thêm thuốc mới" name="addMedicine">

        </div>
      </form>


    </div>
  </div>

  <?php
  require './app/Views/inc/FooterAdmin.php';
  ?>