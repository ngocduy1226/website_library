<?php
include '../partials/header.php';
$username = $_SESSION['username'];
$sql_up = "SELECT * from accounts where username = '$username'";
$query_up = mysqli_query($conn, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);


?>
<div class="container ">

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
                            <li class="active">
                                <a href="#" class="text-decoration-none">
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

                            <li>
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
                <div class="profile-content" style="box-shadow: #ccc 10px 10px;">
                    <div class="card ">
                        <div class="row">
                            <div class="col-md-6">

                                <img src="image/user/info_user.jpg" class="img-thumbnail" />
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-center my-4">THÔNG TIN CÁ NHÂN</h3>
                                <div style="line-height: 3;">
                                    <div>
                                        <span><i style="font-size: 16px;"
                                                class="fa-solid fa-book-open-reader mr-2 top-header-connect-icon-connect"></i>
                                            Tên đăng nhập: </span>
                                        <span>
                                            <?php echo $row_up['username'] ?>
                                        </span>
                                    </div>

                                    <div>
                                        <span><i style="font-size: 16px;"
                                                class="fa-solid fa-envelope mr-2 top-header-connect-icon-connect"></i>
                                            Email: </span>
                                        <span>
                                            <?php echo $row_up['email'] ?>
                                        </span>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- <div class="card-body">
                          
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php' ?>