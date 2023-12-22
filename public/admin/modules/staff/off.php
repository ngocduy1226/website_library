<?php

//     $row_page = 6;
//     include "../pagination_first.php";
//    $sql = "SELECT * FROM brands ORDER BY id_brand DESC LIMIT $begin, $row_page";
//    $query = mysqli_query($conn, $sql);
//     $sql_trang = mysqli_query($conn,"SELECT * FROM brands  ") ;


//     $sql_count_br = mysqli_query($conn,"SELECT COUNT(id_brand) AS NumberCon FROM brands;");
//     $count_br = mysqli_fetch_assoc($sql_count_br);
//     $count_brand = (int)$count_br['NumberCon'];
$sql = "SELECT * FROM staffs  WHERE status_staff= 1  ORDER BY id_staff ASC ";
$query = mysqli_query($conn, $sql);
$sql_count_stf = mysqli_query($conn, "SELECT COUNT(id_staff) AS NumberCon FROM staffs WHERE status_staff = 0");
$count_staff = mysqli_fetch_assoc($sql_count_stf);
$count = (int)$count_staff['NumberCon'];

$sql_count_stf_bin = mysqli_query($conn, "SELECT COUNT(id_staff) AS NumberCon FROM staffs WHERE status_staff = 1");
$count_staff_bin = mysqli_fetch_assoc($sql_count_stf_bin);
$count_bin = (int)$count_staff_bin['NumberCon'];

?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DANH SÁCH NHÂN VIÊN</h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex" style="justify-content: space-between;">
                            <h3 class="card-title"> <a href="index.php?action=quan-ly-nhan-vien&query=danh-sach">Làm việc(<?php echo $count ?> )</a> </h3>

                            <h3 class="card-title ml-5">  Đã nghỉ( <?php echo  $count_bin ?>)</h3>
            
                        </div>
                        <div class="card-body">


                            <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>ID nhân viên</th>
                                        <th>Tên nhân viên</th>
                                        <th>SDT</th>
                                        <th>Vị trí</th>
                                        <th>Trạng thái</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['id_staff']; ?></td>
                                            <td><?php echo $row['name_staff']; ?></td>
                                            <td><?php echo $row['phone_staff']; ?></td>
                                            <td><?php echo $row['position']; ?></td>
                                            <td>
                                                <?php if ($row['status_staff'] == 0) { ?>
                                                    <span class="badge bg-success "> Đang làm việc </span>
                                                <?php } else { ?>
                                                    <span class="badge bg-danger"> Đã nghỉ </span>
                                                <?php } ?>
                                            </td>

                                            <td>
                                        
                                                <a onclick="return Restore('<?php echo $row['name_staff'] ?>')" class="btn btn-danger" aria-disabled="true" href="?action=quan-ly-nhan-vien&query=on&id_staff=<?php echo $row['id_staff'] ?>"><i class="fa-solid fa-trash-can-arrow-up"></i></a>
                                            </td>

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
    function Restore(name) {
        return confirm("Bạn có chắc chắn cho nhân viên " + name + " tiếp tục công việc ?");
    }
</script>