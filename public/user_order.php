<?php
include '../partials/header.php';

// echo $id_order;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    //echo $username;
    $sql_user = "SELECT * from accounts where username = '$username'";
    $query_user = mysqli_query($conn, $sql_user);
    $row_user = mysqli_fetch_assoc($query_user);
    $id_account = $row_user['id_account'];

    $user_borrow = mysqli_query($conn, "SELECT borrows.* , accounts.username as 'name' FROM borrows join accounts on borrows.id_account = accounts.id_account WHERE accounts.id_account = $id_account AND borrows.borrowed = 0 AND borrows.deleteOn = 0 ORDER BY borrowed ASC");
    $count_user_borrow = mysqli_query($conn, "SELECT COUNT(*) FROM borrows join accounts on borrows.id_account = accounts.id_account  WHERE accounts.id_account = $id_account AND borrows.borrowed = 0 AND borrows.deleteOn = 0");
    $query1 = mysqli_fetch_assoc($count_user_borrow);
    $unPro_borrow = (int) $query1['COUNT(*)'];

    $user_borrowed = mysqli_query($conn, "SELECT borrows.* , accounts.username as 'name' FROM borrows join accounts on borrows.id_account = accounts.id_account WHERE accounts.id_account = $id_account AND borrows.borrowed = 1 AND borrows.deleteOn = 0 ORDER BY borrowed ASC");
    $count_user_borrowed = mysqli_query($conn, "SELECT COUNT(*) FROM borrows join accounts on borrows.id_account = accounts.id_account  WHERE accounts.id_account = $id_account AND borrows.borrowed = 1 AND borrows.deleteOn = 0");
    $query2 = mysqli_fetch_assoc($count_user_borrowed);
    $un_borrow = (int) $query2['COUNT(*)'];

    $user_orders_borrow = mysqli_query($conn, "SELECT borrows.* , accounts.username as 'name' FROM borrows join accounts on borrows.id_account = accounts.id_account WHERE accounts.id_account = $id_account AND (borrows.borrowed = 2 OR borrows.borrowed=4 OR borrows.borrowed = 5) AND borrows.deleteOn = 0 ORDER BY borrowed ASC");
    $count_user_orders_borrow = mysqli_query($conn, "SELECT COUNT(*) FROM borrows join accounts on borrows.id_account = accounts.id_account  WHERE accounts.id_account = $id_account AND (borrows.borrowed = 2 OR borrows.borrowed=4 OR borrows.borrowed = 5) AND borrows.deleteOn = 0");
    $query3 = mysqli_fetch_assoc($count_user_orders_borrow);
    $borrow = (int) $query3['COUNT(*)'];

    $user_orders_received = mysqli_query($conn, "SELECT borrows.* , accounts.username as 'name' FROM borrows join accounts on borrows.id_account = accounts.id_account WHERE accounts.id_account = $id_account AND borrows.borrowed =3 AND borrows.deleteOn = 0 ORDER BY borrowed ASC");
    $count_user_orders_receive = mysqli_query($conn, "SELECT COUNT(*) FROM borrows join accounts on borrows.id_account = accounts.id_account  WHERE accounts.id_account = $id_account AND borrows.borrowed = 3 AND borrows.deleteOn = 0");
    $query4 = mysqli_fetch_assoc($count_user_orders_receive);
    $receive = (int) $query4['COUNT(*)'];


    $user_orders_cancel = mysqli_query($conn, "SELECT borrows.* , accounts.username as 'name' FROM borrows join accounts on borrows.id_account = accounts.id_account WHERE accounts.id_account = $id_account AND borrows.borrowed = 6   AND borrows.deleteOn = 0 ORDER BY borrowed ASC");
    $count_user_orders_cancel = mysqli_query($conn, "SELECT COUNT(*) FROM borrows join accounts on borrows.id_account = accounts.id_account  WHERE accounts.id_account = $id_account AND borrows.borrowed = 6 AND borrows.deleteOn = 0");
    $query5 = mysqli_fetch_assoc($count_user_orders_cancel);
    $cancel = (int) $query4['COUNT(*)'];


    $count = mysqli_query($conn, "SELECT COUNT(*) FROM borrows join accounts on borrows.id_account = accounts.id_account  WHERE accounts.id_account = $id_account AND borrows.deleteOn = 0");
    $query = mysqli_fetch_assoc($count);
    $count_all = (int) $query['COUNT(*)'];
} else {
    echo '<script language="javascript">alert("Bạn chưa đăng nhập!"); window.location="login.php";</script>';
}



?>
<div class="container">

    <div class="container">
        <div class="row profile">
            <div class="col-md-3" style="    border: #d3d3c9 solid 1px;
    box-shadow: #ccc 5px 5px;
    border-radius: 5px;">
                <div class="profile-sidebar">
                    <div class="profile-userpic">
                        <img src="image/user/profile_user.jpg" class="img-responsive" alt="Thông tin cá nhân">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <?php echo $username; ?>
                        </div>

                    </div>
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm"><a href="index.php"
                                class="text-decoration-none text-white"> Trang chủ </a></button>
                        <button type="button" class="btn btn-danger btn-sm"><a href="info_profile.php"
                                class="text-decoration-none text-white"> Thoát </a></button>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li>
                                <a href="info_profile.php" class="text-decoration-none">
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
                                <a href="#" target="_blank" class="text-decoration-none">
                                    <i class=" fa-solid fa-cart-shopping"></i>
                                    Quản lý mượn sách
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="col-md-9" style="">
                <div class="profile-content">
                    <div class="card-header">
                        <h3>Lịch sử mượn sách</h3>
                    </div>
                    <div class="card-body card">

                        <?php if ($count_all == 0) { ?>
                            <div class="panel panel-danger">
                                <div class="panel-heading">Bạn chưa mượn sách nào hết</div>
                            </div>
                        <?php } else { ?>

                            <div class="card-body">
                                <?php if ($unPro_borrow != 0) { ?>
                                    <div class="card mb-5" style="box-shadow: #ccc 5px 5px">
                                        <div class="card-header">
                                            <h5>
                                                Đợi xử lý
                                            </h5>
                                        </div>
                                        <div class="card-body">

                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($user_borrow)) {
                                                ?>
                                                <p>
                                                    Tên khách hàng:
                                                    <?php echo $row['name'] ?>
                                                </p>

                                                <p>
                                                    Ngày mượn:
                                                    <?php echo date('d/m/y H:i', $row['date_borrow']) ?>
                                                </p>

                                                <p>
                                                    Tổng sách mượn:
                                                    <?php echo $row['total_book'] ?>
                                                </p>

                                                <a href="detail_userorder.php?id_borrow=<?php echo $row['id_borrow'] ?>">Xem chi
                                                    tiết <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                if ($un_borrow != 0) { ?>

                                    <div class="card mb-5" style="box-shadow: #ccc 5px 5px">
                                        <div class="card-header">
                                            <h5>
                                                Đã xử lý
                                            </h5>
                                        </div>
                                        <div class="card-body">

                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($user_borrowed)) {
                                                ?>
                                                <p>
                                                    Tên khách hàng:
                                                    <?php echo $row['name'] ?>
                                                </p>

                                                <p>
                                                    Ngày mượn:
                                                    <?php echo date('d/m/y H:i', $row['date_borrow']) ?>
                                                </p>

                                                <p>
                                                    Tổng sách mượn:
                                                    <?php echo $row['total_book'] ?>
                                                </p>

                                                <a href="detail_userorder.php?id_borrow=<?php echo $row['id_borrow'] ?>">Xem chi
                                                    tiết <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                if ($borrow != 0) { ?>
                                    <div class="card mb-5" style="box-shadow: #ccc 5px 5px">
                                        <div class="card-header">
                                            <h5>
                                                Đã mượn
                                            </h5>
                                        </div>
                                        <div class="card-body mb-3">

                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($user_orders_borrow)) {
                                                ?>
                                                <p>
                                                    Tên khách hàng:
                                                    <?php echo $row['name'] ?>
                                                </p>

                                                <p>
                                                    Ngày mượn:
                                                    <?php echo date('d/m/y H:i', $row['date_borrow']) ?>
                                                </p>

                                                <p>
                                                    Tổng sách mượn:
                                                    <?php echo $row['total_book'] ?>
                                                </p>

                                                <a href="detail_userorder.php?id_borrow=<?php echo $row['id_borrow'] ?>">Xem chi
                                                    tiết <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                if ($receive != 0) { ?>
                                    <div class="card mb-5" style="box-shadow: #ccc 5px 5px">
                                        <div class="card-header">
                                            <h5>
                                                Đã trả
                                            </h5>
                                        </div>
                                        <div class="card-body mb-3">

                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($user_orders_received)) {
                                                ?>
                                                <p>
                                                    Tên khách hàng:
                                                    <?php echo $row['name'] ?>
                                                </p>

                                                <p>
                                                    Ngày mượn:
                                                    <?php echo date('d/m/y H:i', $row['date_borrow']) ?>
                                                </p>

                                                <p>
                                                    Tổng sách mượn:
                                                    <?php echo $row['total_book'] ?>
                                                </p>

                                                <a href="detail_userorder.php?id_borrow=<?php echo $row['id_borrow'] ?>">Xem chi
                                                    tiết <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                if ($cancel != 0) { ?>
                                    <div class="card mb-5" style="box-shadow: #ccc 5px 5px">
                                        <div class="card-header">
                                            <h5>
                                                Đã hủy
                                            </h5>
                                        </div>
                                        <div class="card-body mb-3">

                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($user_orders_cancel)) {
                                                ?>
                                                <p>
                                                    Tên khách hàng:
                                                    <?php echo $row['name'] ?>
                                                </p>

                                                <p>
                                                    Ngày mượn:
                                                    <?php echo date('d/m/y H:i', $row['date_borrow']) ?>
                                                </p>

                                                <p>
                                                    Tổng sách mượn:
                                                    <?php echo $row['total_book'] ?>
                                                </p>

                                                <a href="detail_userorder.php?id_borrow=<?php echo $row['id_borrow'] ?>">Xem chi
                                                    tiết <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                                                <hr>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }
                                ?>

                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php' ?>