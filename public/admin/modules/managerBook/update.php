<?php
$id_book = $_GET['id_book'];
//echo $id_SP;
$sql_brands = "SELECT * from brands";
$query_brands = mysqli_query($conn, $sql_brands);

$sql_up = "SELECT * from books where id_book = $id_book";
$query_up = mysqli_query($conn, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);


if (isset($_POST['sbm_add'])) {
    $name_book = $_POST['name_book'];

    if ($_FILES['image']['name'] == '') {
        $image = $row_up['image'];
    } else {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($image_tmp, '../image/' . $image);
    }

    $author = $_POST['author'];

    $publisher = $_POST['publisher'];
    $publishing_company = $_POST['publishing_company'];
    $quantity = $_POST['quantity'];
    $id_brand = $_POST['id_brand'];


    $err = [];
    if (empty($name_book)) {

        $err['name_book'] = 'Bạn chưa nhập tên sách';
    }
    if (empty($image)) {
        $err['image'] = 'Bạn chưa chọn file hình';
    }
    if (empty($author)) {
        $err['author'] = 'Bạn chưa nhập tác giả';
    }
    if (empty($publishing_company)) {
        $err['publishing_company'] = 'Bạn chưa nhập nhà sản xuất';
    }
    if (empty($publisher)) {
        $err['publisher'] = 'Bạn chưa nhập nhà cung cấp';
    }
 
    if (empty($quantity)) {
        $err['quantity'] = 'Bạn chưa nhập số lượng';
    }
    if (empty($err)) {
        $sql = "UPDATE `books` SET `image`='$image',`name_book`='$name_book',`author`= '$author',`publisher`='$publisher',`publishing_company`='$publishing_company',`quantity`='$quantity',`id_brand`=$id_brand 
                             where id_book = $id_book";
        $query = mysqli_query($conn, $sql);

        echo '<script language="javascript">alert("Bạn đã cập nhật sách thành công!"); window.location="index.php?action=quan-ly-sach&query=danh-sach";</script>';
    }
}


?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">SÁCH</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Sách</li>
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
                            <h3>Chỉnh sửa sách</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="">Tên sách</label>
                                    <input type="text" name="name_book" class="form-control" require value="<?php echo $row_up['name_book']; ?>">
                                    <span class="erro text-danger"><?php echo (isset($err['name_book'])) ? $err['name_book'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="image">Hình </label>
                                    <input type="file" value="" name="image">
                                    <span class="erro text-danger"><?php echo (isset($err['image'])) ? $err['image'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Tác giả</label>
                                    <input type="text" name="author" class="form-control" require value="<?php echo $row_up['author']; ?>">
                                    <span class="erro text-danger"><?php echo (isset($err['author'])) ? $err['author'] : '' ?></span>
                                </div>


                                <div class="form-group">
                                    <label for="">Nhà cung cấp</label>
                                    <input type="text" name="publisher" class="form-control" require value="<?php echo $row_up['publisher']; ?>">
                                    <span class="erro text-danger"><?php echo (isset($err['publisher'])) ? $err['publisher'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nhà sản xuất</label>
                                    <input type="text" name="publishing_company" class="form-control" require value="<?php echo $row_up['publishing_company']; ?>">
                                    <span class="erro text-danger"><?php echo (isset($err['publishing_company'])) ? $err['publishing_company'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Số lượng</label>
                                    <input type="text" name="quantity" class="form-control" require value="<?php echo $row_up['quantity']; ?>">
                                    <span class="erro text-danger"><?php echo (isset($err['quantity'])) ? $err['quantity'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Danh mục</label>

                                    <select class="form-control" name="id_brand" id="">
                                        <?php while ($row_brands = mysqli_fetch_assoc($query_brands)) { ?>
                                            <option value="<?php echo $row_brands['id_brand'] ?>"><?php echo $row_brands['name_brand'] ?></option>
                                        <?php  } ?>
                                    </select>

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