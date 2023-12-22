<?php

// Kết nối cơ sở dữ liệu
include '../partials/header.php';

?>


<?php
// Nếu người dùng submit form thì thực hiện
if (isset($_REQUEST['timkiem'])) {
    // Gán hàm addslashes để chống sql injection
    $key_search = addslashes($_GET['key_search']);

    // Nếu $search rỗng thì báo lỗi, tức là người dùng chưa nhập liệu mà đã nhấn submit.
    if (empty($key_search)) {
?>
        <div class="alert alert-danger mt-5" role="alert">
            Bạn chưa nhập từ khóa tìm kiếm !!!
        </div>

        <?php
    } else {
        // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
        $query = "select * from books where name_book like '%$key_search%'";


        // Thực thi câu truy vấn
        $sql = mysqli_query($conn, $query);

        // Đếm số đong trả về trong sql.
        $num = mysqli_num_rows($sql);


        // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
        if ($num > 0 && $key_search != "") {

        ?>

            <div class="container px-0 pb-0 pl-4">
                <div class="row pt-5" style="display:flex">
                    <?php echo "<b> $num sách được tìm thấy </b>";   ?>

                </div>
            </div>

            <div class="container px-0 pb-0 pt-5">


                <div class="col-12">
                    <div class="item-menu">
                        <div class="row justify-content-center d-flex menu-p">

                            <?php while ($row = mysqli_fetch_assoc($sql)) {  ?>

                                <div class="col-sm-12 col-lg-4 mb-5">
                                    <div class="product">
                                        <div href="" class="thumbnail d-flex justify-content-center">
                                            <img src="image/<?php echo $row['image'] ?>" alt="" class="img-fluid" style="height:276px;">
                                        </div>
                                        <div class="item-menu-content">
                                            <div class="item-menu-content__heading">
                                                <span>
                                                    <h5 style="max-height: 53px;
                                                            overflow: hidden;
                                                            min-height: 45px; text-align: center;"><?php echo $row['name_book'] ?></h5>
                                                </span>

                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="item-menu-buy mr-1">
                                                    <a href="cart.php?id_book=<?php echo $row['id_book']  ?>">
                                                        <button class="btn-all btn-buy">Thêm giỏ hàng</button>
                                                    </a>

                                                </div>
                                                <div class="item-menu-buy">
                                                    <a href="menu-detail.php?id_book=<?php echo $row['id_book']  ?>">
                                                        <button class="btn-all btn-buy">Xem</button>
                                                    </a>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>

                </div>




            </div>
        <?php
        } else {
        ?>
            <div class="container">
                <div class="row py-5" style="display:flex">
                    <b>Không tìm thấy sản phẩm nào !</b>

                </div>
            </div>
<?php
        }
    }
}

include '../partials/footer.php';
?>