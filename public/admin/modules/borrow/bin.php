<?php


$sql = "SELECT borrows.* , accounts.username as name 
            FROM borrows join accounts on borrows.id_account = accounts.id_account 
            WHERE borrows.deleteOn = 1
            ORDER BY borrows.borrowed = 0 DESC";


$orders = mysqli_query($conn, $sql);



$sql_count_or = mysqli_query($conn, "SELECT COUNT(id_borrow) AS NumberCon FROM borrows WHERE deleteOn = 1; ");
$count_or = mysqli_fetch_assoc($sql_count_or);
$count_order = (int)$count_or['NumberCon'];

$sql_count = mysqli_query($conn, "SELECT COUNT(id_borrow) AS NumberCon FROM borrows WHERE deleteOn = 0; ");
$count_or = mysqli_fetch_assoc($sql_count);
$count = (int)$count_or['NumberCon'];

?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DANH SÁCH MƯỢN SÁCH</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Mượn sách</li>
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
                        <div class="card-header d-flex"  >
                            <h3 class="card-title"> Thùng rác(<?php echo $count_order?>)</h3>
                           
                            <h3 class="card-title ml-5" ><a href="index.php?action=quan-ly-muon-sach&query=danh-sach">Đơn mượn (<?php echo $count?>)</a></h3>
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
                                    
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['name']; ?></td>

                                            <td> <?php echo date('d/m/y H:i', $row['date_borrow']) ?></td>
                                            <td>
                                                <?php if ($row['borrowed'] == 0) { ?>
                                                    <span class="badge bg-warning"> Chưa xử lý </span>
                                                <?php } elseif ($row['borrowed'] == 1) { ?>
                                                    <span class="badge bg-secondary"> Đã xử lý </span>
                                                <?php } elseif ($row['borrowed'] == 2) { ?>
                                                    <span class="badge bg-primary bg-gradient"> Đã mượn </span>
                                                <?php } elseif ($row['borrowed'] == 3) { ?>
                                                    <span class="badge bg-success"> Đã trả </span>
                                                <?php } elseif($row['borrowed'] == 4) { ?>
                                                    <span class="badge bg-danger"> Xin gia hạn </span>
                                                <?php } elseif($row['borrowed'] == 5) { ?>
                                                    
                                                    <span class="badge bg-success"> Gia hạn </span>
                                                <?php } else { ?>
                                                    <span class="badge bg-danger"> Hủy </span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-success" href="index.php?action=quan-ly-muon-sach&query=xem&id_borrow=<?php echo $row['id_borrow'] ?>"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <a class="btn btn-danger" onclick="return Restore('<?php echo $row['id_borrow'] ?>')" href="index.php?action=quan-ly-muon-sach&query=khoi-phuc&id_borrow=<?php echo $row['id_borrow'] ?>"><i class="fa-sharp fa-solid fa-trash-can-arrow-up"></i></a>
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
        return confirm("Bạn có chắc chắn muốn xóa đơn mượn  " + name + "?");
    }

    function Restore(name) {
        return confirm("Bạn có chắc chắn muốn khôi phục đơn mượn " + name + "?");
    }
</script>