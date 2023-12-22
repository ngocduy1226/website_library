<?php
$sql_brands = "SELECT * from brands WHERE brands.status_brand = 0" ;
$query_brands = mysqli_query($conn, $sql_brands);

if (isset($_POST['sbm_add'])) {
    $nameBook = $_POST['name_book'];
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $quantity = $_POST['quantity'];
    $publishingCompany = $_POST['publishing_company'];
    $id_brand = $_POST['id_brand'];
    $err = [];
    if (empty($nameBook)) {

        $err['nameBook'] = 'Bạn chưa nhập tên sản phẩm';
    }
    if (empty($image)) {
        $err['image'] = 'Bạn chưa chọn file hình';
    }

    if (empty($author)) {
        $err['author'] = 'Bạn chưa nhập tác giả';
    }


    if (empty($publisher)) {
        $err['publisher'] = 'Bạn chưa nhập nhà cung cấp';
    }

    if (empty($publishingCompany)) {
        $err['publishing_company'] = 'Bạn chưa nhập nhà sản xuất';
    }
    if (empty($quantity)) {
        $err['quantity'] = 'Bạn chưa nhập số lượng';
    }

    if (empty($err)) {
        $sql = "INSERT INTO `books`(`image`, `name_book`, `author`, `publisher`, `publishing_company`,`quantity`, `id_brand`)
             VALUES ('$image', '$nameBook', '$author', '$publisher','$publishingCompany',$quantity, $id_brand)";

        $query = mysqli_query($conn, $sql);
        move_uploaded_file($image_tmp, '../image/' . $image);
        //  header('location: index.php?action=qlsanpham&query=danhsach');   
        echo '<script language="javascript">alert("Bạn đã thêm sản phẩm thành công!"); window.location="index.php?action=quan-ly-sach&query=danh-sach";</script>';
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
                            <h3>Thêm sách</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" action="">
                                <div class="form-group">
                                    <label for="">Tên sách</label>
                                    <input type="text" name="name_book" value="<?php if (isset($nameBook)) {
                                                                                    echo $nameBook;
                                                                                }; ?>" class="form-control" require>
                                    <span class="erro text-danger"><?php echo (isset($err['name_book'])) ? $err['name_book'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="image">Hình</label>
                                    <input type="file" value="<?php if (isset($image)) {
                                                                    echo $image;
                                                                }; ?>" name="image">
                                    <span class="erro text-danger"><?php echo (isset($err['image'])) ? $err['image'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Tác giả</label>
                                    <input type="text" value="<?php if (isset($author)) {
                                                                    echo $author;
                                                                }; ?>" name="author" class="form-control" require>
                                    <span class="erro text-danger"><?php echo (isset($err['author'])) ? $err['author'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nhà cung cấp</label>
                                    <input type="text" value="<?php if (isset($publisher)) {
                                                                    echo $publisher;
                                                                }; ?>" name="publisher" class="form-control" require>
                                    <span class="erro text-danger"><?php echo (isset($err['publisher'])) ? $err['publisher'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Nhà xuất bản</label>
                                    <input type="text" value="<?php if (isset($publishingCompany)) {
                                                                    echo $publishingCompany;
                                                                }; ?>" name="publishing_company" class="form-control" require>
                                    <span class="erro text-danger"><?php echo (isset($err['publishing_company'])) ? $err['publishing_company'] : '' ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="">Số lượng</label>
                                    <input type="text" value="<?php if (isset($quantity)) {
                                                                    echo $quantity;
                                                                }; ?>" name="quantity" class="form-control" require>
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

                                <button class="btn btn-primary" type="submit" name="sbm_add">THÊM</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>