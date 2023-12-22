<?php


$sql = "SELECT * FROM books inner join brands on books.id_brand = brands.id_brand  WHERE status_book = 1";
$query = mysqli_query($conn, $sql);

$sql_count_pro = mysqli_query($conn, "SELECT COUNT(id_book) AS NumberCon FROM books WHERE status_book = 0;");
$count_pro = mysqli_fetch_assoc($sql_count_pro);
$count_product = (int)$count_pro['NumberCon'];

$sql_count_bin = mysqli_query($conn, "SELECT COUNT(id_book) AS NumberCon FROM books WHERE status_book = 1 ;");
$count_bin = mysqli_fetch_assoc($sql_count_bin);
$count_product_bin = (int)$count_bin['NumberCon'];
?>



<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DANH SÁCH SÁCH</h1>
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

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex" style="justify-content: space-between;">
                        <h3 class="card-title"> Thùng rác(<?php echo $count_product_bin; ?>)</h3>

                        <h3 class="card-title ml-5"><a href="index.php?action=quan-ly-sach&query=danh-sach">Danh sách( <?php echo $count_product_bin ?>)</a></h3>

                    </div>
                </div>

                <div class="card-body">


                    <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Tác giả</th>
                                <th>Nhà cung cấp</th>
                                <th>Nhà xuất bản</th>
                                <th>Danh muc</th>
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
                                    <td><?php echo $row['name_book']; ?></td>

                                    <td>

                                        <img style="width:100px;" src="../image/<?php echo $row['image']; ?>" alt="">
                                    </td>

                                    <td><?php echo $row['author']; ?></td>
                                    <td><?php echo $row['publisher']; ?></td>
                                    <td><?php echo $row['publishing_company']; ?></td>
                                    <td><?php echo $row['name_brand']; ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="?action=quan-ly-sach&query=sua&id_book=<?php echo $row['id_book'] ?>"><i class="fa-solid fa-pen"></i></a>
                                        <a onclick="return Restore('<?php echo $row['name_book'] ?>')" class="btn btn-danger mt-1" aria-disabled="true" href="?action=quan-ly-sach&query=khoi-phuc&id_book=<?php echo $row['id_book'] ?>"><i class="fa-sharp fa-solid fa-trash-can-arrow-up"></i></a>

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


<script>
    function Restore(name) {
        return confirm("Bạn có chắc chắn muốn khôi phục sách: " + name + "?");
    }
</script>