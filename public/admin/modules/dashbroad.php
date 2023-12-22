<?php

// $sql = "SELECT borrows.* , accounts.username as 'name', item_borrow.borrowed as 'borrowed'  FROM borrows 
//                                             join accounts on borrows.id_account = accounts.id_account
//                                             join item_borrow on item_borrow.id_borrow = borrows.id_borrow
//                                             ";

$sql = "SELECT borrows.* , accounts.username as name 
            FROM borrows join accounts on borrows.id_account = accounts.id_account 
            WHERE borrows.deleteOn = 0
            ORDER BY borrows.borrowed = 0 DESC";


$orders = mysqli_query($conn, $sql);

$sql_mem = "SELECT * FROM accounts ORDER BY id_account ASC LIMIT 1, 5";
$query = mysqli_query($conn, $sql_mem);


$sql_count_pro = mysqli_query($conn, "SELECT COUNT(id_book) AS NumberCon FROM books;");
$count_pro = mysqli_fetch_assoc($sql_count_pro);
$count_product = (int)$count_pro['NumberCon'];

$sql_book = mysqli_query($conn, "SELECT books.quantity FROM books;");
$a = 0;
$total = 0;
while ($row = mysqli_fetch_assoc($sql_book)) {
    $a++;
    $total = $total + $row['quantity'];
}
echo $total;




$sql_count_mem = mysqli_query($conn, "SELECT COUNT(id_account) AS NumberCon FROM accounts;");
$count_mem = mysqli_fetch_assoc($sql_count_mem);
$count_member = (int)$count_mem['NumberCon'];

$sql_count_br = mysqli_query($conn, "SELECT COUNT(id_brand) AS NumberCon FROM brands;");
$count_br = mysqli_fetch_assoc($sql_count_br);
$count_brand = (int)$count_br['NumberCon'];

$sql_count_or = mysqli_query($conn, "SELECT COUNT(id_borrow) AS NumberCon FROM borrows;");
$count_or = mysqli_fetch_assoc($sql_count_or);
$count_order = (int)$count_or['NumberCon'];

$count_query = mysqli_query($conn, "SELECT COUNT(id_contact) AS NumberCon FROM contacts WHERE contacts.status_cnt = 0;");
$count = mysqli_fetch_assoc($count_query);
//var_dump((int)$count['NumberCon']);
$count_contact = (int)$count['NumberCon'];

$count_query_cmt = mysqli_query($conn, "SELECT COUNT(id_CMT) AS NumberCon FROM comments WHERE comments.status_cmt = 0;");
$count_cmt = mysqli_fetch_assoc($count_query_cmt);
//var_dump((int)$count['NumberCon']);
$count_comment = (int)$count_cmt['NumberCon'];

$count_query_stf = mysqli_query($conn, "SELECT COUNT(id_staff) AS NumberCon FROM staffs WHERE staffs.status_staff = 0;");
$count_stf = mysqli_fetch_assoc($count_query_stf);
//var_dump((int)$count['NumberCon']);
$count_staff = (int)$count_stf['NumberCon'];




?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thống kê</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Thống kê</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3><?php echo $count_product ?>/ <?php echo $total; ?></h3>

                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="index.php?action=quan-ly-sach&query=danh-sach" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $count_member ?></h3>

                            <p>Thành viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="index.php?action=quan-ly-thanh-vien&query=danh-sach" class="small-box-footer">Xem thêm<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $count_brand ?></h3>

                            <p>Danh mục</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="index.php?action=quan-ly-danh-muc-sach&query=danh-sach" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $count_order  ?></h3>

                            <p>Đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="index.php?action=quan-ly-muon-sach&query=danh-sach" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tin nhắn</span>
                            <span class="info-box-number"><?php echo $count_contact ?> </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Bình luận</span>
                            <span class="info-box-number"><?php echo $count_comment ?> </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Nhân viên</span>
                            <span class="info-box-number"><?php echo $count_staff ?> </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow-sm">
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">93,139</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- don muon sach -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Các đơn hàng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên KH</th>
                                        <th>Ngày mượn</th>
                                        <th>Trạng thái</th>
                                        <th>Chức năng </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($orders)) {
                                        //  $id_order = $row['id_borrow']; 
                                        //  $sql_query =  mysqli_query($conn,"SELECT COUNT(id_borrow) AS count FROM item_borrow WHERE id_borrow = $id_order and borrowed = 0 " ); 
                                        //  $count_item = mysqli_fetch_assoc($sql_query);
                                        //   echo (int)$d['count'];
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['name']; ?></td>

                                            <td> <?php echo date('d/m/y', $row['date_borrow']) ?></td>
                                            <td>
                                                <?php if ($row['borrowed'] == 0) { ?>
                                                    <span class="badge bg-warning"> Chưa xử lý </span>
                                                <?php } elseif ($row['borrowed'] == 1) {
                                                ?>
                                                    <span class="badge bg-secondary"> Đã xử lý </span>
                                                <?php } elseif ($row['borrowed'] == 2) { ?>
                                                    <span class="badge bg-primary bg-gradient"> Đã mượn </span>
                                                <?php } elseif ($row['borrowed'] == 3) {

                                                ?>
                                                    <span class="badge bg-success"> Đã trả </span>
                                                <?php } elseif ($row['borrowed'] == 4) {

                                                ?>
                                                    <span class="badge bg-danger"> Xin gia hạn </span>
                                                <?php } elseif ($row['borrowed'] == 5) {

                                                ?>
                                                    <span class="badge bg-success"> Gia hạn </span>
                                                <?php } else { ?>
                                                    <span class="badge bg-danger"> Hủy </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="index.php?action=quan-ly-muon-sach&query=xem&id_borrow=<?php echo $row['id_borrow'] ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <a class="btn btn-danger" onclick="return Delete('<?php echo $row['id_borrow'] ?>')" href="index.php?action=quan-ly-muon-sach&query=xoa&id_borrow=<?php echo $row['id_borrow'] ?>"><i class="fa-regular fa-trash-can"></i></a>
                                            </td>
                                        </tr>

                                    <?php } ?>

                                    </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>



        </div>
    </section>



</div>

<script>
    function Delete(name) {
        return confirm("Bạn có chắc chắn muốn xóa đơn mượn không, xóa đơn mượn sách sẽ xóa hết dữ liệu về đơn mượn này: " + name + "?");
    }
</script>