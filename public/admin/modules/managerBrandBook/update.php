<?php
$id_brand = $_GET['id_brand'];
//echo $id_SP;
$sql_up = "SELECT * from brands where id_brand = $id_brand";
$query_up = mysqli_query($conn, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);


//  echo $row_up['tensanpham'];

if (isset($_POST['sbm_add'])) {
    $name_brand = $_POST['name_brand'];
    //   $id_brand = $_POST['id_brand'];
    // echo $id_brand;

    $err = [];
    if (empty($name_brand)) {
        $err['name_brand'] = 'Bạn chưa nhập tên danh mục';
    }

    if (empty($err)) {
        $sql = "UPDATE `brands` SET `name_brand`='$name_brand' WHERE id_brand = $id_brand";
        $query = mysqli_query($conn, $sql);
        //  move_uploaded_file($hinh_tmp, 'image/'.$hinh);
        //   header('location: index.php?action=qldanhmucsp&query=danhsach');

        echo '<script language="javascript">alert("Bạn đã cập nhật danh mục thành công!"); window.location="index.php?action=quan-ly-danh-muc-sach&query=danh-sach";</script>';
    }
}


?>



<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DANH MỤC</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh mục</li>
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
                            <h3>Chỉnh sửa danh mục</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="">
                                <div class="form-group">
                                    <label for="">Tên danh mục</label>
                                    <input type="text" name="name_brand" class="form-control" require value="<?php echo $row_up['name_brand']; ?>">
                                    <span class="erro text-danger"><?php echo (isset($err['name_brand'])) ? $err['name_brand'] : '' ?></span>
                                </div>
                                <button class="btn btn-primary" type="submit" name="sbm_add">SỬA</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>