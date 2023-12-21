<?php
    include '../partials/header.php';

  if(isset($_POST['dangnhap'])){
      $email = $_POST['email'];
      //pass nhập vào
      $password = $_POST['password'];
      
      if(empty($email)){
   
          $err['email'] = 'Bạn chưa nhập tên email';

      }
      if(empty($password)){
          $err['password'] = 'Bạn chưa nhập password';
      }
      else{
         //kt email có nằm trong data
          $sql = "SELECT * FROM accounts WHERE email  = '$email'";
          $query = mysqli_query($conn, $sql);
          var_dump($query);
          $data = mysqli_fetch_assoc($query);
          $checkEmail = mysqli_num_rows($query);
          $err = [];
          // var_dump($checkEmail);
          if($checkEmail == 1){
                $pw = md5($password);
                if($pw == $data['password']){
                    //luu vào sesion
                    //  $_SESSION['user'] = $data;
                      //Lưu tên đăng nhập
                    $_SESSION['username'] = $data['username'];
                    
                    if($email == "admin@gmail.com"){
                       echo '<script language="javascript">window.location="admin/index.php";</script>';  
                    }
                    else {
                      echo '<script language="javascript">window.location="index.php";</script>';  
                    }
                    
                }
                else {
               
                   echo '<script language="javascript">alert("Sai mật khẩu!"); window.location="login.php";</script>';
              ?>
               

              <?php 
                }
          
          }
          else {
             echo '<script language="javascript">alert("Email không tồn tại!"); window.location="login.php";</script>';
          }

      }    

  }
?>

    <div class="row  justify-content-center login-dn">
       <div class="col-md-12 col-lg-10">
            <div class="row">
                  <div class="wrap-pic col-md-6 col-sm-12">
                    <img src="image/user/login.png" alt="">
                  </div>
                  <div class="wrap-login justify-content-center col-md-6 col-sm-12">
                       <h3 class="text-dn text-center">Đăng nhập</h3>
                       <form class="form-tt" method="post" action="login.php">
                      <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" name="email" id="email" class="form-control form-input-log"aria-describedby="emailHelp" placeholder="Vui lòng nhập email" value="<?php if(isset($email)){echo $email; };?>">
                          <span class="erro"><?php echo (isset($err['email']))?$err['email']:''?></span>
              
                      </div>
                      <div class="form-group">
                          <label for="password">Mật khẩu:</label>
                          <input type="password" id="password" class="form-control form-input-log"placeholder="Vui lòng nhập mật khẩu" name="password" value="<?php if(isset($password)){echo $password; };?>">
                          <span class="erro"><?php echo (isset($err['password']))?$err['password']:''?></span>
                      </div>
                      <div class="d-flex" style="justify-content: space-between;">
                          <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Ghi nhớ đăng nhập</label>
                          </div> 
                          <span><a href="#" class="text-dark text-decoration-none">Quên mật khẩu</a> </span>
                      </div>
                      
                      <div class="text-center ">

                          <button type="submit" class="btn-dn my-3 r btn-all" name="dangnhap">Đăng nhập</button>
                          <button type="reset" class="btn-dn my-3 r btn-all">Hủy</button>
                      </div>
                      
                       <div class="form-group">
                          <div class="alert alert-danger mt-5" role="alert">
                            Bạn chưa có tài khoản? Hãy <a href="reg.php" class="text-decoration-none">ĐĂNG KÝ.</a>
                        </div>
                      </div>
                </form>
                  </div>
            </div>
       </div>
    </div>
     

 <?php include '../partials/footer.php'; ?>