<?php
//  $row_page = 10;
//    include "../pagination_first.php";


//echo $page;

//$sql = "SELECT comments.* , accounts.username as 'name', books.name_book as 'name_book' FROM comments join accounts on comments.id_account = accounts.id_account join books on comments.id_book = books.id_book ORDER BY status ASC LIMIT $begin, $row_page";

$sql = "SELECT comments.* , accounts.username as 'name', books.name_book as 'name_book' 
                FROM comments join accounts on comments.id_account = accounts.id_account join books on comments.id_book = books.id_book 
                WHERE status_cmt = 0 OR status_cmt = 1
                ORDER BY status_cmt ASC ";
$cmt = mysqli_query($conn, $sql);
// $sql_trang = mysqli_query($conn,"SELECT * FROM comment") ;


if (isset($_POST['check-seen'])) {
    $id_CMT = $_POST['id_CMT'];
    $up_query = mysqli_query($conn, "UPDATE `comments` SET `status_cmt`='1' WHERE id_CMT= $id_CMT ;");
    echo '<script language="javascript">alert("Bạn đã xác nhận !"); window.location="index.php?action=quan-ly-binh-luan&query=danh-sach";</script>';
}

$sql_count_cmt = mysqli_query($conn, "SELECT COUNT(id_CMT) AS NumberCon FROM comments WHERE status_cmt = 0 OR status_cmt = 1;");
$count_cmt = mysqli_fetch_assoc($sql_count_cmt);
$count_comment = (int)$count_cmt['NumberCon'];

$sql_count_cmt_bin = mysqli_query($conn, "SELECT COUNT(id_CMT) AS NumberCon FROM comments WHERE status_cmt = 2;");
$count_cmt_bin = mysqli_fetch_assoc($sql_count_cmt_bin);
$count_comment_bin = (int)$count_cmt_bin['NumberCon'];

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">DANH SÁCH BÌNH LUẬN</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Bình luận</li>
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
                            <h3 class="card-title"> Danh sách bình luận(<?php echo $count_comment ?>)</h3>

                            <h3 class="card-title ml-5"><a href="index.php?action=quan-ly-binh-luan&query=thung-rac">Thùng rác( <?php echo   $count_comment_bin ?>)</a></h3>
                        </div>
                        <div class="card-body">


                            <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã bình luận</th>
                                        <th>Tên sách</th>
                                        <th>Tên TK</th>
                                        <th>Nội dung</th>
                                        <th>Trạng thái</th>
                                        <th>Chức năng </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($cmt)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $row['id_CMT']; ?></td>
                                            <td><?php echo $row['name_book']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['cmt']; ?></td>
                                            <td>
                                                <?php if ($row['status_cmt'] == 0) { ?>
                                                    <span class="badge bg-danger"> Ẩn </span>
                                                <?php } else { ?>
                                                    <span class="badge bg-success"> Hiện </span>
                                                <?php } ?>
                                            </td>
                                            <td class="d-flex">
                                                <form role="form" method="POST">
                                                    <input type="hidden" name="id_CMT" value="<?php echo $row['id_CMT'];  ?>">
                                                    <button name="check-seen" type="submit" class="btn btn-primary">
                                                        <span><i class="fa-solid fa-pen-to-square"></i></span>
                                                    </button>
                                                </form>

                                                <a class="btn btn-danger ml-1" onclick="return Delete('<?php echo $row['id_CMT'] ?>')" href="index.php?action=quan-ly-binh-luan&query=xoa&id_CMT=<?php echo $row['id_CMT'] ?>"><i class="fa-regular fa-trash-can"></i></a>
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
    function Delete(name) {
        return confirm("Bạn có chắc chắn muốn xóa bình luận: " + name + "?");
    }
</script>