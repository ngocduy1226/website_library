<?php
include '../partials/header.php';
include 'cart_function.php';
if (isset($_GET['id_borrow'])) {
    $id_borrow = $_GET['id_borrow'];
    //echo $id_order;
    $borrow_query = mysqli_query($conn, "SELECT * FROM borrows where id_borrow  = $id_borrow");
    //  $sql_trang = $order_query;
    $borrow = mysqli_fetch_assoc($borrow_query);
    $id_account = $borrow['id_account'];
    $account_query = mysqli_query($conn, "SELECT * FROM accounts where id_account = $id_account");
    $account = mysqli_fetch_assoc($account_query);

    //lấy ds sp trong đơn hàng
    $books = mysqli_query($conn, "SELECT borrows.*, item_borrow.*, books.* FROM item_borrow JOIN books on item_borrow.id_book = books.id_book JOIN borrows on item_borrow.id_borrow = borrows.id_borrow WHERE item_borrow.id_borrow = '$id_borrow'");
    $date = date('y-m-d', $borrow['date_borrow']);
  $newdate = strtotime('+1 week', strtotime($date));
  $new = date('d/m/y', $newdate);

}

if (isset($_POST['borrow'])) {
    $borrow = $_POST['borrow'];
    mysqli_query($conn, "UPDATE borrows SET borrowed = '$borrow' WHERE id_borrow = $id_borrow");
    if ($borrow == 6) {
        mysqli_query($conn, "DELETE FROM `borrows` WHERE id_borrow = $id_borrow");
        echo '<script language="javascript">alert("Bạn đã hủy đơn đăng ký thành công!"); window.location="user_order.php";</script>';
    }
    echo '<script language="javascript">alert("Bạn đã cập nhật thành công!"); window.location="user_order.php";</script>';
}


?>
<div class="container">
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        <img src="image/user/profile_user.jpg" class="img-responsive" alt="Thông tin cá nhân">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> <?php echo $_SESSION['username']; ?> </div>

                    </div>
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm"><a href="index.php" class="text-decoration-none text-white"> Trang chủ </a></button>
                        <button type="button" class="btn btn-danger btn-sm"><a href="user_order.php" class="text-decoration-none text-white"> Thoát </a></button>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <a href="info-profile.php" class="text-decoration-none">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Thông tin cá nhân
                                </a>
                            </li>
                            <!-- <li>
                                <a href="up_profile.php" class="text-decoration-none">
                                    <i class="fa-solid fa-pen"></i>
                                    Cập nhật thông tin cá nhân
                                </a>
                            </li> -->

                            <li class="active">
                                <a href="user_order.php" target="_blank" class="text-decoration-none">
                                    <i class=" fa-solid fa-cart-shopping"></i>
                                    Quản lý mượn sách
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-md-9">
                <div class="profile-content">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <h4>Khách hàng</h4>
                            </div>
                            <div class="card-body">
                                <p> Tên khách hàng: <?php echo $account['username'] ?></p>
                                <p> Số điện thoại: <?php echo $borrow['phone'] ?></p>
                                <p>Ngày đăng ký mượn: <?php echo date('d/m/y', $borrow['date_borrow']) ?> </p>
                                <p> Ghi chú: <?php echo $borrow['note'] ?> </p>
                                <p><strong>Hạn trả: <?php
                                      if ($borrow['borrowed'] == 5) {
                                        $date = date('y-m-d', $borrow['date_borrow']);
                                        $newdate = strtotime('+2 week', strtotime($date));
                                        $new = date('d/m/y', $newdate);
                                      }
                                                    // $date = date('y-m-d', $borrow['date_borrow']);
                                                    // $newdate = strtotime('+1 week', strtotime($date));
                                                    // $new = date('d/m/y', $newdate);
                                                    echo $new;
                                                    ?></strong></p>
                                <p>Trạng thái đơn mượn:
                                    <?php if ($borrow['borrowed'] == 5) { ?>
                                        Gia hạn
                                    <?php } elseif ($borrow['borrowed'] == 4) { ?>
                                        Xin gia hạn
                                    <?php  } elseif ($borrow['borrowed'] == 3) { ?>
                                        Đã trả
                                    <?php } elseif ($borrow['borrowed'] == 1) { ?>
                                        Đã xử lý
                                    <?php } elseif ($borrow['borrowed'] == 2) { ?>
                                        Đã mượn
                                    <?php } elseif ($borrow['borrowed'] == 0) { ?>
                                        Chưa xử lý
                                    <?php } else { ?>
                                        Hủy
                                    <?php } ?>
                                </p>

                                <?php if ($borrow['borrowed'] == 3) { ?>
                                    <p>Ngày trả:<?php echo date('d/m/y', $borrow['date_receive']) ?> </p>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Chi tiết đơn mượn</h4>
                            </div>
                            <div class="card-body " style="text-align:center;">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sách</th>
                                            <th>Ảnh</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($books)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $row['name_book']; ?></td>

                                                <td>
                                                    <img style="width:100px;" src="./image/<?php echo $row['image']; ?>" alt="">
                                                </td>

                                            </tr>

                                        <?php } ?>
                                        <tr>
                                            <td>Tổng sách:</td>
                                            <td colspan="3"> <?php echo $borrow['total_book']; ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php if ($borrow['borrowed'] == 0) { ?>
                                <form action="" method="post" class="form-inline justify-content-center" role="form">
                                    <div class="form-group">
                                        <label class="pr-3"> Trạng thái: </label>
                                        <select name="borrow" id="input" class="form-control" require="required">
                                            <option value="6">Hủy</option>

                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary my-3 ml-2">Xác nhận</button>
                                </form>
                            <?php } ?>
                            <?php if ($borrow['borrowed'] == 2) { ?>
                                <form action="" method="post" class="form-inline justify-content-center" role="form">
                                    <div class="form-group">
                                        <label class="pr-3"> Trạng thái: </label>
                                        <select name="borrow" id="input" class="form-control" require="required">
                                            <option value="4">Xin gia hạn</option>

                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary my-3 ml-2">Xác nhận</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php' ?>