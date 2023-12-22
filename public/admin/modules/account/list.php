<?php


$sql = "SELECT * FROM accounts ORDER BY id_account DESC ";
$query = mysqli_query($conn, $sql);

$sql_count_acc = mysqli_query($conn, "SELECT COUNT(id_account) AS NumberCon FROM accounts WHERE status_acc = 0;");
$count_acc = mysqli_fetch_assoc($sql_count_acc);
$count_account = (int)$count_acc['NumberCon'];

$sql_count_acc_bin = mysqli_query($conn, "SELECT COUNT(id_account) AS NumberCon FROM accounts WHERE status_acc = 1;");
$count_acc_bin = mysqli_fetch_assoc($sql_count_acc_bin);
$count_account_bin = (int)$count_acc_bin['NumberCon'];


?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DANH SÁCH THÀNH VIÊN</h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex" style="justify-content: space-between;">
                            <h3 class="card-title"> Tổng thành viên(<?php echo $count_account ?>)</h3>

                            <!-- <h3 class="card-title ml-5"><a href="index.php?action=quan-ly-thanh-vien&query=thung-rac">Thùng rác( <?php echo  $count_account_bin ?>)</a></h3> -->
                            <h3 class=""><a href="index.php?action=quan-ly-thanh-vien&query=them" class="btn btn-primary">Thêm mới</a></h3>
                        </div>
                        <div class="card-body">


                            <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>ID tài khoản</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Gmail</th>
                                        <!-- <th>Chức năng</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['id_account']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <!-- <td>
                                                <a class="btn btn-primary" href="?action=quan-ly-thanh-vien&query=sua&id_account=<?php echo $row['id_account'] ?>"><i class="fa-solid fa-pen"></i></a>
                                                <a onclick="return Delete('<?php echo $row['username'] ?>')" class="btn btn-danger" aria-disabled="true" href="?action=quan-ly-thanh-vien&query=xoa&id_account=<?php echo $row['id_account'] ?>"><i class="fa-solid fa-trash-can"></i></a>
                                            </td> -->
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>


                    </div>
                </div>
            </div>

        </div>

    </section>
</div>



<script>
    function Delete(name) {
        return confirm("Bạn có chắc chắn muốn xóa danh mục " + name + "?");
    }
</script>