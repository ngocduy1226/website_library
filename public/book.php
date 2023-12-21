<?php

// Kết nối cơ sở dữ liệu
include '../partials/header.php';

$row_page = 6;
include 'pagination_first.php';


if (isset($_GET['brand'])) {


    $brand = addslashes($_GET['brand']);
    $query = mysqli_query($conn, "SELECT id_brand FROM `brands` WHERE `name_brand` LIKE '%$brand%' AND status_brand= 0");
    $id_brand = mysqli_fetch_assoc($query);
    // var_dump($id_brand);

    $id = (int) $id_brand['id_brand'];
    $query_brands = mysqli_query($conn, "SELECT * FROM brands WHERE  id_brand = $id ");
    $brand = mysqli_fetch_assoc($query_brands);
}


$books = mysqli_query($conn, "SELECT * FROM books WHERE  id_brand = $id  AND status_book = 0 ORDER BY id_book DESC LIMIT $begin, $row_page");
$sql_trang = mysqli_query($conn, "SELECT * FROM books WHERE id_brand = $id AND status_book = 0");

$brands_list = mysqli_query($conn, "SELECT * FROM brands WHERE  status_brand = 0 ");


?>


<style>
    .list-brand {
        margin-bottom: 30px;
        position: relative;
        background: white;
        border: 1px solid #e6e6e6;
        -webkit-box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
        margin-top: 12px;
        line-height: 2.4;
        border-radius: 5px;
    }

    .title-brand {
        margin-top: 20px;
        font-weight: 400;
        font-size: 2rem;
    }

    .list-menu li a span {
        color: #4a4646;
        font-weight: 500;
    }

    .item-menu {
        position: relative;
        background: white;
        border: 1px solid #e6e6e6;
        margin-top: 12px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    .item-menu-content__heading {
        color: #000;
        font-size: 1rem;
        font-weight: 500;
    }
</style>


<div style=" background-color: #d3d6d926;">
    <div class="container section-menu menu-p">
        <div class="row">
            <div class="col-lg-3 col-12 list-brand">
                <div class="heading mb-4">
                    <h3 class="title-brand" style="line-height:2.4rem;">Sách <strong>Hay</strong></h3>
                </div>

                <ul class="list-unstyled list-menu">
                 
                    <?php foreach ($brands_list as $key => $value):
                        ?>
                        <li class="active">
                            <a href="book.php?brand=<?php echo $value['name_brand'] ?>" class="align-items-center d-flex text-decoration-none ">
                                <img src="image/menu-1.webp" alt="" class="img-fluid">
                                <span style="">
                                    <?php echo $value['name_brand'] ?>
                                </span>
                            </a>
                        </li>
                    <?php
                    endforeach ?>
                 
                </ul>
            </div>

            <div class="col-lg-9 col-12 section-menu-pl">
                <div class="item-menu">
                    <div class="row align-items-center mb-4">
                        <div class="col-12 mt-4 pl-5">
                            <h3>
                                <?php echo $brand['name_brand']; ?>
                            </h3>
                        </div>
                    </div>
                    <div class="row">

                        <?php foreach ($books as $key => $value): ?>
                            <div class="col-sm-12 col-lg-4 mb-5">
                                <div class="product">
                                    <div href="" class="thumbnail d-flex justify-content-center">
                                        <img src="image/<?php echo $value['image'] ?>" alt="" class="img-fluid"
                                            style="height:276px;">
                                    </div>
                                    <div class="item-menu-content">
                                        <div class="item-menu-content__heading">
                                            <span>
                                                <h5 style="max-height: 53px;
                                                            overflow: hidden;
                                                            min-height: 45px; text-align: center;">
                                                    <?php echo $value['name_book'] ?></h5>
                                            </span>

                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="item-menu-buy mr-1">
                                                <a href="cart.php?id_book=<?php echo $value['id_book'] ?>">
                                                    <button class="btn-all btn-buy">Thêm giỏ hàng</button>
                                                </a>

                                            </div>
                                            <div class="item-menu-buy">
                                                <a
                                                    href="menu-detail.php?id_brand=<?php echo $id ?>&id_book=<?php echo $value['id_book'] ?>">
                                                    <button class="btn-all btn-buy">Xem</button>
                                                </a>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        <?php endforeach ?>



                    </div>
                </div>
            </div>
            <div>
                <?php include 'pagination_end.php'; ?>
            </div>

        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>