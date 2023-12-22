<?php
include '../cart_function.php';



if (isset($_GET['id_borrow'])) {
  $id_borrow = $_GET['id_borrow'];
  //echo $id_order;
  $borrow_query = mysqli_query($conn, "SELECT * FROM borrows where id_borrow  = $id_borrow");
  // $sql_trang = $order_query;
  $borrow = mysqli_fetch_assoc($borrow_query);
  $id_account = $borrow['id_account'];
  $account_query = mysqli_query($conn, "SELECT * FROM accounts where id_account = $id_account");
  $account = mysqli_fetch_assoc($account_query);


  //lấy ds sp trong đơn hàng
  $books = mysqli_query($conn, "SELECT borrows.*, item_borrow.*, books.* FROM item_borrow JOIN books on item_borrow.id_book = books.id_book JOIN borrows on item_borrow.id_borrow = borrows.id_borrow WHERE item_borrow.id_borrow = '$id_borrow'");
  //  $products = mysqli_fetch_assoc($products_query);


  $date = date('y-m-d', $borrow['date_borrow']);
  $newdate = strtotime('+1 week', strtotime($date));



  if (isset($_POST['borrowed'])) {
    $borrowed = $_POST['borrowed'];
    mysqli_query($conn, "UPDATE borrows SET borrowed = '$borrowed' WHERE id_borrow = $id_borrow");
    $books_quantity = mysqli_query($conn, "SELECT borrows.*, item_borrow.*, books.* 
                    FROM item_borrow JOIN books on item_borrow.id_book = books.id_book 
                                      JOIN borrows on item_borrow.id_borrow = borrows.id_borrow WHERE item_borrow.id_borrow = '$id_borrow'");
    if ($borrowed == 1) {

      $i = 1;
      while ($row = mysqli_fetch_assoc($books_quantity)) {
        $i++;
        $id_book = $row['id_book'];
        $query_book = mysqli_query($conn, "SELECT quantity AS NumberCon  FROM books where id_book  = $id_book ");
        $count_b = mysqli_fetch_assoc($query_book);
        $quantity_old = (int)$count_b['NumberCon'];
        $up_quantity = mysqli_query($conn, "UPDATE `books` SET `quantity`= $quantity_old - 1  WHERE id_book = $id_book;");
      }
    } else if ($borrowed == 3) {
      $i = 1;
      while ($row = mysqli_fetch_assoc($books_quantity)) {
        $i++;
        $id_book = $row['id_book'];
        $query_book = mysqli_query($conn, "SELECT quantity AS NumberCon  FROM books where id_book  = $id_book ");
        $count_b = mysqli_fetch_assoc($query_book);
        $quantity_old = (int)$count_b['NumberCon'];
        $up_quantity = mysqli_query($conn, "UPDATE `books` SET `quantity`= $quantity_old + 1  WHERE id_book = $id_book;");
      }
    }

    echo '<script language="javascript">alert("Bạn đã cập nhật trạng thái thành công!");
   window.location="index.php?action=quan-ly-muon-sach&query=xem&id_borrow=' . $id_borrow . '";</script>';
  }
  $new = date('d/m/y', $newdate);
}

?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-build">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">MƯỢN SÁCH</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active">Xem chi tiết</li>
          </ol>
        </div><!-- /.col -->
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">THÔNG TIN KHÁCH HÀNG</h3>
            </div>
            <div class="card-body">
              <p> Tên tài khoản:
                <?php echo $account['username'] ?>
              </p>
              <p> Số điện thoại:
                <?php echo $borrow['phone'] ?>
              </p>
              <p> Ghi chú:
                <?php echo $borrow['note'] ?>
              </p>
              <p>Ngày đăng ký mượn:
                <?php echo date('d/m/y', $borrow['date_borrow']) ?>
              </p>
              <p> <strong> Hạn trả: <?php
                          if ($borrow['borrowed'] == 5) {
                            $date = date('y-m-d', $borrow['date_borrow']);
                            $newdate = strtotime('+2 week', strtotime($date));
                            $new = date('d/m/y', $newdate);
                          }
                          echo $new;
                          ?></strong> </p>
              <?php if ($borrow['borrowed'] > 2 ) { ?>
                <p>Ngày trả: <?php echo date('d/m/y', $borrow['date_receive']) ?> </p>
              <?php } ?>

            </div>

          </div>

          <?php
          if ($borrow['borrowed'] >= 1) {
          ?>
            <div class="my-4"><a href="index.php?action=quan-ly-muon-sach&query=in&id_borrow=<?php echo $id_borrow; ?>" class="btn btn-primary"><i class="fa-solid fa-print"></i></a></div>

          <?php

          }
          ?>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">THÔNG TIN ĐƠN MƯỢN SÁCH</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sách</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                    <th>Số sách trong kho</th>

                  </tr>
                </thead>
                <tbody>

                  <?php
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($books)) {
                  ?>
                    <tr>
                      <td>
                        <?php echo $i++;

                        ?>
                      </td>
                      <td>
                        <?php echo $row['name_book']; ?>
                      </td>

                      <td>
                        <img style="width:100px;" src="../image/<?php echo $row['image']; ?>" alt="">
                      </td>
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
                        <?php
                        $id_book =  $row['id_book'];
                        $query_book = mysqli_query($conn, "SELECT quantity AS NumberCon  FROM books where id_book  = $id_book ");
                        $count_b = mysqli_fetch_assoc($query_book);
                        $quantity_old = (int)$count_b['NumberCon'];
                        echo $quantity_old;
                        ?>
                      </td>

                    </tr>

                  <?php }

                  ?>

                </tbody>
              </table>

              <form action="" method="post" class="form-inline justify-content-center" role="form">
                <div class="form-group">
                  <label> Trạng thái: </label>
                  <select name="borrowed" id="input" class="form-control" require="required">
                    <option value="0">Chưa xử lý</option>
                    <option value="1">Đã xử lý</option>
                    <option value="2">Đã mượn</option>
                    <option value="3">Đã trả</option>
                    <option value="5">Gia hạn</option>
                    <option value="6">Hủy</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary my-3 ml-1">Cập nhật</button>
              </form>
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
    return confirm("Bạn có chắc chắn muốn xóa sách: `" + name + "` trong đơn mượn sách này ?");
  }
</script>