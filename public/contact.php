<?php

// Kết nối cơ sở dữ liệu
include '../partials/header.php';
$username = $_SESSION['username'];

$err = []; 
if (isset($username)){
    #echo $username;
    $sql = "SELECT accounts.* FROM accounts WHERE username = '$username'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);


    if(isset($_POST['contact'])){
          $id_account = $data['id_account'];
          $email = $data['email'];
          $username = $data['username'];
          $content = $_POST['content'];
      
          if(empty($content)){
              $err['content'] = 'Bạn chưa nhập nội dung';
          }

          if(empty($err)) {
              $sql =  "INSERT INTO contacts (id_account, username, email, content, date_send ) VALUES ('$id_account','$username', '$email', '$content', '".time()."')";
              $query = mysqli_query($conn, $sql);  
              if($query) {
                  echo '<script language="javascript">alert("Gửi liên hệ thành công!"); window.location="index.php";</script>';
              }
          }
    }  
}else {
   echo '<script language="javascript">alert("Bạn cần đăng nhập!"); window.location="login.php";</script>';
}

?>

   <section class="connect">
       <div class="container">
             <h3 class="text-center tt-text1">KẾT NỐI VỚI CHÚNG TÔI</h3>
             <form class="wrap-form" method="post" action="contact.php">
                  <div class="row">
                      <div class="col-md-6">
                           <div class="form-group">
                                <label for="username" class="tt-text2">Tên đăng nhập:</label>
                                <input type="text" name="username" id="username" class="form-control form-input-log"aria-describedby="emailHelp" value="<?php echo $data['username'];?>" title="Tên tài khoản không được rỗng!">
                                
                          </div>
                      </div>
                      <div class="col-md-6">
                          
                           <div class="form-group">
                                <label for="email" class="tt-text2">Email:</label>
                                <input type="email" name="email" id="email" class="form-control form-input-log"aria-describedby="emailHelp" value="<?php echo $data['email'];?>" value="<?php if(isset($email)){echo $password; };?>" title="Email không được rỗng!">
                               
                          </div>
                      </div>

                      <div class="col-12">
                           <div class="form-group">
                                <label for="content" class="tt-text2">Nội dung:</label>
                                <textarea type="text" id="validate" id="content" name="content"cols="30" rows="7" value="<?php echo $noidung;?>" class="form-control fs-3 mt-2 input-content"  placeholder="Nhập nội dung"  title="Nội dung không được rỗng!"></textarea>
                                <span class="erro"><?php echo (isset($err['content']))?$err['content']:''?></span>
                            </div>
                      </div>

                      <div class="col-12 all-form">
                             <button type="submit" class="btn-dn my-3 r btn-all mx-2" name="contact">GỬI</button>
                             <button type="reset" class="btn-dn my-3 r btn-all">HỦY</button>
                      </div>
                  </div>
             </form>

             <div class="row ll_connect">
                <div class="col-sm-8 col-md-4 col-lg-4 m-r-l-auto add_connect ">
                     <div class="d-flex add_connect-item">
                          <div>
                             <i class="fa-solid fa-location-dot icon-local "></i>
                          </div>
                          <div class="flex-row-l">
                            <span class="tt-text4 mb-2">ĐỊA CHỈ</span>
                            <span class="tt-text3 tt-size2">123, đường 3/2, phường Xuân Khánh, Cần Thơ</span>
                          </div>     
                          
                     </div>
                     
                </div>

                 <div class="col-sm-8 col-md-4 col-lg-4 m-r-l-auto add_connect ">
                     <div class="d-flex add_connect-item">
                          <div>
                             <i class=" icon-local fa-solid fa-phone"></i>
                          </div>
                          <div class="flex-row-l">
                            <span class="tt-text4 mb-2">LIÊN HỆ</span>
                            <span class="tt-text3 tt-size2">0918300345</span>
                          </div>     
                          
                     </div>
                     
                </div>
                
                <div class="col-sm-8 col-md-4 col-lg-4 m-r-l-auto add_connect ">
                     <div class="d-flex add_connect-item">
                          <div>
                             <i class="fa-solid fa-clock icon-local "></i>
                          </div>
                          <div class="flex-row-l">
                            <span class="tt-text4 mb-2">MỞ CỬA</span>
                            <span class="tt-text3 tt-size2">8:00 AM - 9:00 PM</span>
                          </div>     
                          
                     </div>
                     
                </div>


             </div>
       </div>
    
   </section>

<?php  include '../partials/footer.php' ?>
