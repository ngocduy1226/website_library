<?php

$err = [];
$id_account = $_GET['id_account'];
$sql_up = "SELECT * from accounts where id_account = $id_account";
$query_up = mysqli_query($conn, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);


// Dùng isset để kiểm tra Form
if (isset($_POST['sbm_add'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if (empty($username)) {
        $err['username'] = 'Bạn chưa nhập tên đăng nhập';
    } else {
        // Kiểm tra username hoặc email có bị trùng hay không
        $sql1 = "SELECT * FROM accounts WHERE username = '$username'";
        // Thực thi câu truy vấn
        $result1 = mysqli_query($conn, $sql1);

        // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
        if (mysqli_num_rows($result1) > 0) {
            $err['username'] = 'Tên đăng nhập bị trùng';
        }
    }

    if (empty($email)) {
        $err['email'] = 'Bạn chưa nhập email';
    } else {
        // Kiểm tra username hoặc email có bị trùng hay không
        $sql1 = "SELECT * FROM accounts WHERE email = '$email'";
        // Thực thi câu truy vấn
        $result1 = mysqli_query($conn, $sql1);

        // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
        if (mysqli_num_rows($result1) > 0) {
            $err['username'] = 'Tên email bị trùng';
        }
    }

    if (empty($password)) {
        $err['password'] = 'Bạn chưa nhập mật khẩu';
    }

    if (empty($repassword)) {
        $err['repassword'] = 'Bạn chưa nhập lại mật khẩu';
    } else if ($password != $repassword) {
        $err['repassword'] = 'Mật khẩu không trùng khớp';
    }

    if (empty($err)) {
        $pass = md5($password);
        $sql = "UPDATE account SET `username`= '$username', `email` = '$email' WHERE id_account = $id_account ";
        // $sql = "INSERT INTO accounts ( username, email, password ) VALUES ('$username','$email','$pass')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo '<script language="javascript">alert("Bạn đã cập nhật thành viên thành công!"); window.location="index.php?action=quan-ly-thanh-vien&query=danh-sach";</script>';
        }
    }
}


?>
<style>
    .erro {
        color: red;
    }
</style>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">THÀNH VIÊN</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thành viên</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- don muon sach -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Thêm thành viên</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="">
                                <div class="form-group">
                                    <label for="">Tên đăng nhập</label>
                                    <input type="text" value="<?php 
                                                                    echo $row_up['username'];
                                                                 ?>" name="username" class="form-control" require>
                                    <span class="erro"><?php echo (isset($err['username'])) ? $err['username'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" value="<?php  echo $row_up['email']; ?>" name="email" class="form-control" require>
                                    <span class="erro"><?php echo (isset($err['email'])) ? $err['email'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <?php echo md5(md5($row_up['password'])) ?>
                                    <label for="">Mật khẩu</label>
                                    <input type="password" value="<?php  echo md5($row_up['password']); ?>" name="password" class="form-control" require>
                                    <span class="erro"><?php echo (isset($err['password'])) ? $err['password'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nhập lại mật khẩu</label>
                                    <input type="password" value="<?php echo md5($row_up['password']);?>" name="repassword" class="form-control" require>
                                    <span class="erro"><?php echo (isset($err['repassword'])) ? $err['repassword'] : '' ?></span>
                                </div>
                                <button class="btn btn-primary" type="submit" name="sbm_add">THÊM</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>