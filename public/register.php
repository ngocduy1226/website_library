<?php

// Kết nối cơ sở dữ liệu
include '../partials/header.php';

$err = [];
// Dùng isset để kiểm tra Form
if(isset($_POST['dangky'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if(empty($username)){
        $err['username'] = 'Bạn chưa nhập tên đăng nhập';
    }
    else{
        $checkName = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$username'" );
        if (mysqli_num_rows($checkName) > 0){
            $err['username'] = 'Tên đăng nhập bị trùng';
        }
    }

    if(empty($email)){
        $err['email'] = 'Bạn chưa nhập email';
    }
    else{
        $checkEmail = mysqli_query($conn,"SELECT * FROM accounts WHERE email = '$email'" );
        if (mysqli_num_rows($checkEmail) > 0){
            $err['email'] = 'Tên email bị trùng';
        }
    }

    if(empty($password)){
        $err['password'] = 'Bạn chưa nhập mật khẩu';
    }
 
    if(empty($repassword)){
        $err['repassword'] = 'Bạn chưa nhập lại mật khẩu';
    }
    else if($password != $repassword) {
        $err['repassword'] = 'Mật khẩu không trùng khớp';
    }

    if(empty($err)){
        $pass = md5($password);
            // var_dump($pass);
            // die();
        $sql = "INSERT INTO accounts ( username, email, password ) VALUES ('$username','$email','$pass')";
        $query = mysqli_query($conn, $sql);

        if($query) {
            echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="login.php";</script>';
        }
    }
 }
?>

    <main>
        <article class="my-5">
            <h4 class="text-center text-dn">Đăng ký</h4>
            <div class="container">
                <div class="row justify-content-center">
                    
                  <form class="col-lg-5 form-tt"  method="post" action="register.php">
                    <div class="form-group">
                       <label for="username">Tên đăng nhập:</label>
                        <input type="text" class="form-control form-input-log"  id="username" placeholder="Vui lòng nhập tên đăng nhập" name="username" value="<?php if(isset($username)){echo $username; };?>">
                        <span class="erro"><?php echo (isset($err['username']))?$err['username']:''?></span>
                      </div>

                      <div class="form-group">
                          <label for="email">Email:</label>
                          <input type="email" id="email" class="form-control form-input-log" aria-describedby="emailHelp" placeholder="Vui lòng nhập email" name="email" value="<?php if(isset($email)){echo $email; };?>" >
                           <span class="erro"><?php echo (isset($err['email']))?$err['email']:''?></span>
                      </div>
                     
                      <div class="form-group">
                          <label for="password">Mật khẩu:</label>
                          <input type="password" id="password" class="form-control form-input-log"  placeholder="Vui lòng nhập mật khẩu" name="password" value="<?php if(isset($password)){echo $password; };?>">
                          <span class="erro"><?php echo (isset($err['password']))?$err['password']:''?></span>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Nhập lại mật khẩu:</label>
                          <input type="password" class="form-control form-input-log"  placeholder="Vui lòng nhập mật khẩu" name="repassword" value="<?php if(isset($repassword)){echo $repassword; };?>">
                           <span class="erro"><?php echo (isset($err['repassword']))?$err['repassword']:''?></span>
                      </div>
   
                      <div class="text-center">
                        
                          <button type="submit" class="btn-dn btn-all my-3 r" name="dangky">Đăng ký</button>
                          <button type="reset" class="btn-dn btn-all my-3 r">Hủy</button>
                      </div>

                      <div class="form-group">
                          <div class="alert alert-danger mt-5" role="alert">
                            Bạn đã có tài khoản? Hãy <a href="login.php" class="text-decoration-none">ĐĂNG NHẬP.</a>
                        </div>
                      </div>
                     
                </form>
                </div>
              
            </div>
        </article>
    </main>


<?php include '../partials/footer.php'; ?>