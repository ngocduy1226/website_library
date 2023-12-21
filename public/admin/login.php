<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php
  include '../../partials/mysqli_connect.php';

  if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];

    //pass nhập vào
    $password = $_POST['password'];

    if (empty($email)) {

      $err['email'] = 'Bạn chưa nhập tên email';
    }
    if (empty($password)) {
      $err['password'] = 'Bạn chưa nhập password';
    } else {
      //kt email có nằm trong data
      $sql = "SELECT * FROM accounts WHERE email  = '$email'";
      $query = mysqli_query($conn, $sql);
      var_dump($query);
      $data = mysqli_fetch_assoc($query);
      $checkEmail = mysqli_num_rows($query);
      $err = [];
      // var_dump($checkEmail);
      if ($checkEmail == 1) {
        $pw = md5($password);
        if ($pw == $data['password']) {
          //luu vào sesion
          //  $_SESSION['user'] = $data;
          //Lưu tên đăng nhập
          $_SESSION['username'] = $data['username'];

          if ($email == "admin@gmail.com") {
            echo '<script language="javascript">window.location="index.php";</script>';
          } else {
            echo '<script language="javascript">window.location="book.php";</script>';
          }
        } else {

          echo '<script language="javascript">alert("Sai mật khẩu!"); window.location="login.php";</script>';
  ?>


  <?php
        }
      } else {
        echo '<script language="javascript">alert("Email không tồn tại!"); window.location="login.php";</script>';
      }
    }
  }
  ?>




  <style>
    html {
      height: 100%;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: linear-gradient(#141e30, #243b55);
    }

    .login-box {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 400px;
      padding: 40px;
      transform: translate(-50%, -50%);
      background: rgba(0, 0, 0, .5);
      box-sizing: border-box;
      box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
      border-radius: 10px;
    }

    .login-box h2 {
      margin: 0 0 30px;
      padding: 0;
      color: #fff;
      text-align: center;
    }

    .login-box .user-box {
      position: relative;
    }

    .login-box .user-box input {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      margin-bottom: 30px;
      border: none;
      border-bottom: 1px solid #fff;
      outline: none;
      background: transparent;
    }

    .login-box .user-box label {
      position: absolute;
      top: 0;
      left: 0;
      padding: 10px 0;
      font-size: 16px;
      color: #fff;
      pointer-events: none;
      transition: .5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
      top: -20px;
      left: 0;
      color: #03e9f4;
      font-size: 12px;
    }

    .login-box form .dn {
      position: relative;
      display: inline-block;
      padding: 10px 20px;
      color: #03e9f4;
      font-size: 16px;
      text-decoration: none;
      text-transform: uppercase;
      overflow: hidden;
      transition: .5s;
      margin-top: 40px;
      letter-spacing: 4px
    }

    .login-box .dn:hover {
      background: #03e9f4;
      color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 5px #03e9f4,
        0 0 25px #03e9f4,
        0 0 50px #03e9f4,
        0 0 100px #03e9f4;
    }

    .login-box .dn span {
      position: absolute;
      display: block;
    }

    .login-box .dn span:nth-child(1) {
      top: 0;
      left: -100%;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, transparent, #03e9f4);
      animation: btn-anim1 1s linear infinite;
    }

    @keyframes btn-anim1 {
      0% {
        left: -100%;
      }

      50%,
      100% {
        left: 100%;
      }
    }

    .login-box .dn span:nth-child(2) {
      top: -100%;
      right: 0;
      width: 2px;
      height: 100%;
      background: linear-gradient(180deg, transparent, #03e9f4);
      animation: btn-anim2 1s linear infinite;
      animation-delay: .25s
    }

    @keyframes btn-anim2 {
      0% {
        top: -100%;
      }

      50%,
      100% {
        top: 100%;
      }
    }

    .login-box .dn span:nth-child(3) {
      bottom: 0;
      right: -100%;
      width: 100%;
      height: 2px;
      background: linear-gradient(270deg, transparent, #03e9f4);
      animation: btn-anim3 1s linear infinite;
      animation-delay: .5s
    }

    @keyframes btn-anim3 {
      0% {
        right: -100%;
      }

      50%,
      100% {
        right: 100%;
      }
    }

    .login-box .dn span:nth-child(4) {
      bottom: -100%;
      left: 0;
      width: 2px;
      height: 100%;
      background: linear-gradient(360deg, transparent, #03e9f4);
      animation: btn-anim4 1s linear infinite;
      animation-delay: .75s
    }

    @keyframes btn-anim4 {
      0% {
        bottom: -100%;
      }

      50%,
      100% {
        bottom: 100%;
      }
    }
  </style>


  <div class="login-box">
    <h2>ĐĂNG NHẬP</h2>
    <form method="post" >
      <div class="user-box" style="margin-bottom: 30px;">
        <input type="text" name="email" id="email"  value="<?php if(isset($email)){echo $email; };?>">
           <span class="erro " style="color:red"><?php echo (isset($err['email']))?$err['email']:''?></span>

        <label>Email</label>
      </div>
      <div class="user-box" style="margin-bottom: 30px">
        <input type="password" id="password"  name="password" value="<?php if(isset($password)){echo $password; };?>">
        <span class="erro" style="color:red"><?php echo (isset($err['password']))?$err['password']:''?></span>
        <label>Password</label>
      </div>
      <!-- <a type="submit" name="dangnhap">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Đăng nhập
      </a> -->
      <div class="dn">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
         <button type="submit" class="" name="dangnhap">Đăng nhập</button>
      </div>
     
    </form>
  </div>
</body>

</html>