<?php
    require './app/Views/inc/HeaderAdmin.php';

    ?>
    <div class="section__content section__content--p30">
      <h4 class="text-center"><?php echo $title; ?></h4>


      <div class="container-fluid">

        <div class="card-body" style="background-color: #fff; padding: 20px;">



          <form class="row g-3 m-3" id="insert_data_user" method="POST" action="">
            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Nhập họ tên:</b></label>
              <input type="text" class="form-control" placeholder="Họ tên" id="fullname" name="fullname" value="<?php
                if (!empty($_POST['fullname']) && empty($error['fullname'])) 
                {
                  echo $_POST['fullname'];
                }else {
                    echo $Staff[0]['full_name'];
                } ?>">
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['fullname'])) {
                                                echo $error['fullname'];
                                              } ?></b></p>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Nhập email:</b></label>
              <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="<?php
                if (!empty($_POST['email']) && empty($error['email'])) 
                {
                  echo $_POST['email'];
                }else {
                  echo $Staff[0]['email'];
                }  ?>">
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['email'])) {
                                                echo $error['email'];
                                              } ?></b></p>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Chọn giới tính:</b></label><br>
              <input type="radio" name="gender" id="gender" value="Nam"
              <?php
                  if (!empty($Staff[0]['gender']) && empty($error['gender'])) {
                    if($Staff[0]['gender']=='Nam'){
                       echo 'checked';
                    }
                  } 
                ?>>
              <label for="" class="mr-3">Nam</label>
              <input type="radio" name="gender" class="ml-3" id="gender" value="Nữ"
              <?php
                  if (!empty($Staff[0]['gender']) && empty($error['gender'])) {
                    if($Staff[0]['gender']=='Nữ'){
                       echo 'checked';
                    }
                  } 
                ?>>
              <label for="">Nữ</label>
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['gender'])) {
                                                echo $error['gender'];
                                              } ?></b></p>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Nhập số điện thoại:</b></label>
              <input type="number" class="form-control" placeholder="số điện thoại" id="phone" name="phone"value="<?php
                if (!empty($_POST['phone']) && empty($error['phone'])) 
                {
                  echo $_POST['phone'];
                }else {
                  echo $Staff[0]['phone'];
                }  ?>">
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['phone'])) {
                                                echo $error['phone'];
                                              } ?></b></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Nhập năm sinh:</b></label>
              <input type="date" class="form-control" placeholder="năm sinh" id="birthday" name="birthday" value="<?php
                if (!empty($_POST['birthday']) && empty($error['birthday'])) 
                {
                  echo $_POST['birthday'];
                }else {
                  echo $Staff[0]['birthday'];
                }  ?>">
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['birthday'])) {
                                                echo $error['birthday'];
                                              } ?></b></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Nhập bằng cấp:</b></label>
              <input type="text" class="form-control" placeholder="Bằng cấp" id="certificate" name="certificate" value="<?php
                if (!empty($_POST['certificate']) && empty($error['certificate'])) 
                {
                  echo $_POST['certificate'];
                }else {
                  echo $Staff[0]['certificate'];
                }  ?>">
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['certificate'])) {
                                                echo $error['certificate'];
                                              } ?></b></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Nhập kinh nghiệm làm việc:</b></label><br>
              <textarea name="experience" id="experience" class="p-1" cols="60" rows="5" placeholder="Kinh nghiệm làm việc"><?php 
              if (!empty($_POST['experience']) && empty($error['experience'])) {echo $_POST['experience'];} 
              else{echo $Staff[0]['experience'];} 
              ?></textarea>
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['experience'])) {
                                                echo $error['experience'];
                                              } ?></b></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label"><b>Nhập mô tả:</b></label><br>
              <textarea name="description" class="p-1" id="description" cols="60" rows="5" placeholder="Mô tả"><?php 
              if (!empty($_POST['description']) && empty($error['description'])) { echo $_POST['description'];} 
              else{echo $Staff[0]['description'];} 
              ?></textarea>
              <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['description'])) {
                                                echo $error['description'];
                                              } ?></b></p>
            </div>


            <div class="col-md-12">
              <label for=""><b>Phân quyền cho người dùng:</b></label>
            </div>

            <?php foreach($role as $item) {
              if ($item['id_role'] != 5) {
            ?>
                <div class="col-md-2 m-3">
                  <input class="form-check-input custom-radio border-primary" type="radio" name="role" id="role<?php echo $item['id_role'] ?>" value="<?php echo $item['id_role'] ?>" onclick="toggleOptions()" 
                  <?php
                  if($Staff[0]['id_role']==$item['id_role']){echo 'checked';}
                  ?>>
                  <label for="role<?php echo $item['id_role'] ?>"><?php echo $item['name_role'] ?></label>
                </div>
            <?php
              }
            } ?>

            <p class="text-danger mt-2"><b><?php
                                              if (!empty($error['role'])) {
                                                echo $error['role'];
                                              } ?></b></p>
            
            <div id="department" <?php if($Staff[0]['id_role']!=4)
            echo 'style="display: none;';
            ?>">
              <select name="department" class="form-select" id="depmt">
              <option value="<?php echo $Staff[0]['id_department'] ?>"><?php echo $Staff[0]['department_name'] ?></option>
                <?php foreach ($department as $item) { 
                  if($item['department_name']!=$Staff[0]['department_name']){
                ?> 
                  <option value="<?php echo $item['id_department'] ?>"><?php echo $item['department_name'] ?></option>
                <?php }} ?>
              </select>
            </div>

            <div class="col-4 mb-3" style="display: none;">
                    <label for="" class="form-label">ID:</label>
                    <input type="number" class="form-control" name="id_staff" value="<?php echo $Staff[0]['id_staff'] ?>">
            </div>


            <div class="col-12 text-center">
              <input type="submit" value="Cập nhật" class="btn btn-primary" id="update" name="upDate">

            </div>
          </form>


        </div>
      </div>
      <?php
      require './app/Views/inc/FooterAdmin.php';
      ?>


