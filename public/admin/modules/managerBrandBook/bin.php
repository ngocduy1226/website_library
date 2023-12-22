<?php

$sql = "SELECT * FROM brands WHERE status_brand = 1 ORDER BY id_brand DESC ";
$query = mysqli_query($conn, $sql);
$sql_count_br = mysqli_query($conn, "SELECT COUNT(id_brand) AS NumberCon FROM brands WHERE status_brand = 1  ;");
$count_br = mysqli_fetch_assoc($sql_count_br);
$count_brand = (int)$count_br['NumberCon'];

$sql_count = mysqli_query($conn, "SELECT COUNT(id_brand) AS NumberCon FROM brands WHERE status_brand = 0  ;");
$count_bin = mysqli_fetch_assoc($sql_count);
$count_brand_bin = (int)$count_bin['NumberCon'];
?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DANH SÁCH DANH MỤC</h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex" style="justify-content: space-between;">
                            <h3 class="card-title"> Thùng rác(<?php echo $count_brand ?>)</h3>

                            <h3 class="card-title ml-5"><a href="index.php?action=quan-ly-danh-muc-sach&query=danh-sach">Danh mục( <?php echo  $count_brand_bin ?>)</a></h3>

                        </div>
                        <div class="card-body">


                            <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>STT</th>

                                        <th>Tên danh mục</th>
                                        <th>Chức năng</th>
                                        <!-- <th>Xóa</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>

                                            <td><?php echo $row['name_brand']; ?></td>
                                            <td>
                                                <a class="btn btn-primary" href="?action=quan-ly-danh-muc-sach&query=sua&id_brand=<?php echo $row['id_brand'] ?>"><i class="fa-solid fa-pen"></i></a>
                                                <a onclick="return Restore('<?php echo $row['name_brand'] ?>')" class="btn btn-danger" aria-disabled="true" href="?action=quan-ly-danh-muc-sach&query=khoi-phuc&id_brand=<?php echo $row['id_brand'] ?>"><i class="fa-sharp fa-solid fa-trash-can-arrow-up"></i></a>
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
        return confirm("Bạn có chắc chắn muốn khôi phục danh mục " + name + "?");
    }
</script>