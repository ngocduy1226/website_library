<?php

//  $row_page = 10;
//  include "../pagination_first.php";
//  $sql = "SELECT * FROM contacts order by status_cnt ASC  LIMIT $begin, $row_page";
$sql = "SELECT * FROM contacts WHERE status_cnt = 2 order by status_cnt ASC ";
$query = mysqli_query($conn, $sql);
//$sql_trang = mysqli_query($conn,"SELECT * FROM ketnoi") ;

if (isset($_POST['id_contact'])) {
  $id_contact = $_POST['id_contact'];
  echo '<script language="javascript">alert("Bạn nên xác nhận đã đọc nha!"); window.location="index.php?action=quan-ly-ket-noi&query=xem&id_contact=' . $id_contact . '";</script>';
}

$sql_count_cont = mysqli_query($conn, "SELECT COUNT(id_contact) AS NumberCon FROM contacts WHERE status_cnt = 0 OR status_cnt = 1;");
$count_cont = mysqli_fetch_assoc($sql_count_cont);
$count_connect = (int)$count_cont['NumberCon'];

$sql_count_cont_bin = mysqli_query($conn, "SELECT COUNT(id_contact) AS NumberCon FROM contacts WHERE status_cnt = 2;");
$count_cont_bin = mysqli_fetch_assoc($sql_count_cont_bin);
$count_connect_bin = (int)$count_cont_bin['NumberCon'];
?>

<style>
  .modal-header {
    display: inline;
  }

  .modal-header,
  h4,
  .close {
    background-color: #333;
    color: #fff !important;
    text-align: center;
    font-size: 30px;
  }

  h3,
  h4 {
    margin: 10px 0 30px 0;
    letter-spacing: 10px;
    font-size: 20px;
    color: #111;
    font-family: inherit;
    font-weight: 500;
    line-height: 1.1
  }

  .modal-header,
  .modal-body {
    padding: 40px 50px;
  }

  .modal-header .close {
    margin-top: -38px;
    margin-right: -38px;
    padding: 10px;
  }


  .user-icon {
    font-size: 14px;
    margin-right: 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 1px solid #000;
    line-height: 30px !important;
    text-align: center;
    color: #000;

  }

  .model-footer {
    justify-content: space-between;

  }
</style>


<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">DANH SÁCH KẾT NỐI</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Kết nối</li>
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
              <h3 class="card-title"> Thùng rác(<?php echo $count_connect_bin ?>)</h3>

              <h3 class="card-title ml-5"><a href="index.php?action=quan-ly-ket-noi&query=danh-sach">Danh sách kết nối( <?php echo  $count_connect ?>)</a></h3>

            </div>
            <div class="card-body">


              <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                <thead class="thead-dark">
                  <tr>
                  <tr>
                    <th>#</th>
                    <th>ID kết nối</th>
                    <th>Tên đăng nhập</th>
                    <th>Email</th>
                    <th>Ngày gửi</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                  </tr>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($query)) {
                  ?>
                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $row['id_contact']; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo date('d/m/y H:i', $row['date_send']) ?> </td>
                      <td>
                        <?php if ($row['status_cnt'] == 0) { ?>
                          <span class="badge bg-danger"> Chưa đọc </span>
                        <?php } else { ?>
                          <span class="badge bg-success"> Đã đọc </span>
                        <?php } ?>
                      </td>

                      <td class="d-flex">
                        <!-- <a href="?action=qlketnoi&query=danhsach&id_KN=<?php echo $row['id_KN'] ?>" data-toggle="modal" data-target="#myModal"><button class="btn btn-primary">Xem</button></a> -->
                        <form action="" method="post" class="mr-1">
                          <input name="id_contact" value="<?php echo $row['id_contact'] ?>" style="display:none;">
                          <button type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i></button>
                        </form>
                        <a onclick="return Restore('<?php echo $row['id_contact'] ?>')" class="btn btn-danger" aria-disabled="true" href="?action=quan-ly-ket-noi&query=khoi-phuc&id_contact=<?php echo $row['id_contact'] ?>"><i class="fa-sharp fa-solid fa-trash-can-arrow-up"></i></a>

                      </td>

                    </tr>

                  <?php } ?>
                </tbody>
              </table>

              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="text-center">
                        <span><i class="fa-solid fa-message"></i></span>
                        <span>Tin nhắn</span>
                      </h4>
                    </div>
                    <div class="modal-body">
                      <div>
                        <span class=""><i class="user-icon fa-solid fa-user"></i></span>
                        <span>Ten nguoi gui</span>
                      </div>
                      <div class="mb-5 mt-2" style=" border: 3px solid #ccc; border-radius:10px;">
                        Rất vui được thưởng thức các món ăn của nhà hàng. Mong nha hang them nhieu mon an moi a
                      </div>
                      <form role="form" method="POST">
                        <button name="check-seen" type="submit" class="btn btn-block">Đã xem
                          <span><i class="fa-solid fa-check"></i></span>
                        </button>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                      </button>
                      <p>Need <a href="#">help?</a></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>

    </div>

  </section>
</div>






<script>
  function Restore(name) {
    return confirm("Bạn có chắc chắn muốn khôi phục kết nối không ?");
  }
</script>