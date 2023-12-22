<?php 
   
   if(isset($_POST['sbm_add_staff'])){
      $name_staff = $_POST['name_staff'];
      $phone_staff = $_POST['phone_staff'];
      $position = $_POST['position'];
      $err = [];
       if (empty($name_staff)) {
            $err['name_staff'] = 'Bạn chưa nhập tên danh mục';

        }
        if (empty($phone_staff)) {
            $err['phone_staff'] = 'Bạn chưa nhập số điện thoại';

        }
        if (empty($position)) {
            $err['position'] = 'Bạn chưa nhập chức vụ';

        }   

    if(empty($err)){
  
            $query = mysqli_query($conn, "INSERT INTO `staffs`( `name_staff`, `phone_staff`, `position`) VALUES ('$name_staff','$phone_staff','$position');");

            // header('location: index.php?action=qldanhmucsp&query=danhsach'); 
            echo '<script language="javascript">alert("Bạn đã thêm nhân viên thành công!"); window.location="index.php?action=quan-ly-nhan-vien&query=danh-sach";</script>';
  
    }


   }


?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">NHÂN VIÊN</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Nhân viên</li>
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
                            <h3>Thêm nhân viên</h3>
                        </div>
                        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label for="">Tên nhân viên</label>
                    <input type="text" value="" name="name_staff" class="form-control" require >
                    <span class="erro" style="color:red;"><?php echo (isset($err['name_staff']))?$err['name_staff']:''?></span>
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="text" value="" name="phone_staff" class="form-control" require >
                    <span class="erro" style="color:red;"><?php echo (isset($err['phone_staff']))?$err['phone_staff']:''?></span>
                </div>
                <div class="form-group">
                    <label for="">Chức vụ</label>
                    <input type="text" value="" name="position" class="form-control" require >
                    <span class="erro" style="color:red;"><?php echo (isset($err['position']))?$err['position']:''?></span>
                </div>
                <button class="btn btn-primary" type="submit" name="sbm_add_staff">THÊM</button>
            </form>
        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
