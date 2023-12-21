<?php
include "../partials/mysqli_connect.php";
if (isset($_GET['id_book']) && isset($_GET['id_brand'])) {
  $id_book = $_GET['id_book'];
  $id_brand = $_GET['id_brand'];
} else {
  $id_book = '';
}
$sql_detail = mysqli_query($conn, "SELECT * FROM `books` WHERE id_book = '$id_book'");

$sql_count = mysqli_query($conn, "SELECT COUNT(id_CMT) AS NumberCon FROM comments WHERE comments.status_cmt = 1 AND id_book = '$id_book';");
$count = mysqli_fetch_assoc($sql_count);
$count_con = (int) $count['NumberCon'];
if ($count_con != 0) {
  $listCmt = mysqli_query($conn, "SELECT * FROM comments WHERE comments.status_cmt = 1 AND id_book = '$id_book';");
}

$books = mysqli_query($conn, "SELECT * FROM `books`  WHERE id_brand = '$id_brand' LIMIT 1, 6 ");


?>
<!doctype html>
<html lang="en">

<head>
  <title>Tastyc</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/introduce.css">
  <link rel="stylesheet" href="css/connect.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/news.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/responsive.css">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/menu-detail.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>


<body>
  <header class="header">
    <div class="top-header-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <ul class="top-header-information">
              <li class="top-header-list">
                <a href="#" class="top-header-connect-icon text-decoration-none">

                  <i class="top-header-connect-icon-connect fa-solid fa-phone"></i>
                  <span class="top-header-content">0945 433 678</span>
                </a>

              </li>
              <li class="top-header-list top-header-gmail">
                <a href="#" class="top-header-connect-icon text-decoration-none">
                  <i class="top-header-connect-icon-connect  far fa-envelope-open"></i>
                  <span class="top-header-content">Restura@gmail.com</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-4 pt-3">

            <ul class="navbar-nav mr-auto top-header-social-network d-inline pt-3">
              <?php if (isset($_SESSION['username'])) { ?>
                <li class="nav-item dropdown top-header-social">
                  <a class="nav-link dropdown-toggle top-header-login" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    <?php
                    echo $_SESSION['username'];
                    ?>
                  </a>
                
                  <ul class="dropdown-content">
                    <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                    <li><a class="dropdown-item" href="info_profile.php">Xem thông tin cá nhân</a></li>
                  </ul>
                </li>
              <?php } else { ?>

                <li class="nav-item dropdown top-header-social">
                  <a class="nav-link dropdown-toggle top-header-login" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    Tài khoản
                  </a>
                  <ul class="dropdown-content">
                    <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
                    <li><a class="dropdown-item" href="reg.php">Đăng ký</a></li>
                  </ul>
                </li>
              <?php } ?>

              <li class=" nav-item  top-header-social">
                <a href="view_cart.php" class="position-relative">
                  <i class="top-header-connect-icon-connect fa-solid fa-cart-shopping"></i>
                  <span class="position-absolute cart-notice top-0 start-100 translate-middle badge rounded-pill">
                    <?php echo count($cart) ?>

                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white middle-area p-3">
      <div class="container">
        <a class="navbar-brand nav-logo " href="index.php">
          <img src="./image/logo1.png" alt="" id="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav ml-auto" style="justify-content: space-between;
                   margin-right: 100px;
                   margin-left: 100px;">
            <li class="nav-item nav-underline nav-active">
              <a class="nav-link" href="./index.php">Trang chủ </a>
            </li>

            <!-- <li class="nav-item nav-underline">
              <a class="nav-link" href="./introduce.php">Giới thiệu </a>
            </li> -->
            <li class="nav-item nav-underline">
              <a class="nav-link" href="./book.php?brand=tam+ly">Sách </a>
            </li>
            <!-- <li class="nav-item nav-underline">
              <a class="nav-link" href="./news.php">Tin tức & Khuyến mãi</a>
            </li> -->
            <li class="nav-item nav-underline">
              <a class="nav-link" href="./contact.php">Liên hệ </a>
            </li>
          </ul>
          <form id="search_sp" action="search.php" class="form-inline d-flex justify-content-center ml-1" method="GET">
            <input type="search" placeholder="Tìm kiếm" class="form-control form-search" aria-label="Search" name="key_search">
            <button class="btn  btn-search" type="submit" name="timkiem"><i style="padding:4px" class="fa fa-search fa-fw"></i></button>
          </form>

        </div>
      </div>
    </nav>

  </header>


  <?php
  if (isset($_POST['cmt'])) {
    if (isset($_SESSION['username'])) {
      $username = $_SESSION['username'];
      echo $username;
      $sql_acc = mysqli_query($conn, "SELECT * FROM accounts where username = '$username'");
      $account = mysqli_fetch_assoc($sql_acc);
      $cmt = $_POST['cmt'];
      $sql_cmt = mysqli_query($conn, "INSERT INTO  comments ( id_book, id_account, cmt) VALUES ('" . $id_book . "','" . $account['id_account'] . "','" . $cmt . "');");
      echo '<script language="javascript">alert("Bình luận của bạn đang chờ admin kiểm duyệt!"); window.location="menu-detail.php?id_brand=' . $id_brand . '&id_book=' . $id_book . '";</script>';
    } else {
  ?>
      <div class="alert alert-danger alert-dismissible">

        <button type="button" class="close" data-dismiss="alert">×</button>

        <strong>Cảnh báo!</strong> Bạn nên <a href="login.php" class="alert-link">đăng nhập</a>trước khi bình luận

      </div>
  <?php

    }
  }
  ?>
  <div class="container mt-5">
    <div class="heading-section">
      <h2 style="color: var(--primary-color);">CHI TIẾT SÁCH</h2>
    </div>
    <?php while ($row_detail = mysqli_fetch_array($sql_detail)) { ?>
      <div class="row">
        <div class="col-md-5">
          <img src="image/<?php echo $row_detail['image'] ?>" class="img-fluid img-product" alt="">
        </div>
        <div class="col-md-7 menu_detail-content">
          <div class="">
            <div class="product-info">
              <div class="product-name" style="	font-size: 1.6rem;
    font-weight: 500;
    text-align: center;
    padding: 38px;">
                <?php echo $row_detail['name_book']; ?>
              </div>
              <div class="reviews-counter">
                <div class="rate">
                  <input type="radio" id="star5" name="rate" value="5" checked />
                  <label for="star5" title="text">5 stars</label>
                  <input type="radio" id="star4" name="rate" value="4" checked />
                  <label for="star4" title="text">4 stars</label>
                  <input type="radio" id="star3" name="rate" value="3" checked />
                  <label for="star3" title="text">3 stars</label>
                  <input type="radio" id="star2" name="rate" value="2" />
                  <label for="star2" title="text">2 stars</label>
                  <input type="radio" id="star1" name="rate" value="1" />
                  <label for="star1" title="text">1 star</label>
                </div>
                <span>3 Reviews</span>
              </div>

              <div class="">
                <div class="d-flex m-0 p-0 justify-content-between" style="">
                  <div>
                    <span>
                      Nhà cung cấp:
                      <?php echo $row_detail['publishing_company'] ?>
                    </span>
                  </div>

                  <div>
                    <span>
                      Tác giả:
                      <?php echo $row_detail['author'] ?>
                    </span>
                  </div>


                </div>

                <div class="d-flex m-0 p-0 justify-content-between">
                  <div>
                    <span>
                      Nhà xuất bản:
                      <?php echo $row_detail['publisher'] ?>
                    </span>
                  </div>



                </div>
              </div>


              <form method="GET" action="cart.php">
                <hr>
                <div class="product-count">

                  <input type="hidden" name="id_book" value="<?php echo $row_detail['id_book']; ?>">
                  <div class="d-flex justify-content-center mt-3"><button class="btn-all btn-buy mt-2 btn-detail" type="submit">Thêm giỏ hàng</button></div>

                </div>
                <hr>
              </form>

            </div>
          </div>
        </div>
        <div class="product-info-tabs row">
          <div class="col-md-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Xem thêm</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Bình luận(
                  <?php echo $count_con ?>)
                </a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">

                <div class="item-menu">
                  <div>
                    <h2 class="text-center" style="padding: 29px 0px;
                      color: #de3241;"> SÁCH LIÊN QUAN </h2>
                  </div>
                  <div class="row">

                    <?php foreach ($books as $key => $value) :  ?>
                      <div class="col-sm-12 col-lg-4 mb-5">
                        <div class="product">
                          <div href="" class="thumbnail d-flex justify-content-center">
                            <img src="image/<?php echo $value['image'] ?>" alt="" class="img-fluid" style="height:276px;">
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
                                <a href="cart.php?id_book=<?php echo $value['id_book']  ?>">
                                  <button class="btn-all btn-buy">Thêm giỏ hàng</button>
                                </a>

                              </div>
                              <div class="item-menu-buy">
                                <a href="menu-detail.php?id_brand=<?php echo $id_brand ?>&id_book=<?php echo $value['id_book']  ?>">
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
              <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="review-heading">BÌNH LUẬN</div>
                <?php if ($count_con != 0) {
                  foreach ($listCmt as $key => $value) :
                    $id_account = $value['id_account'];
                    // echo $username;
                    $sql_user = mysqli_query($conn, "SELECT username FROM accounts WHERE `id_account` = $id_account");
                    $user = mysqli_fetch_assoc($sql_user);
                    //  echo $user['username'];

                ?>
                    <div class="mt-4">
                      <span><i class="user-icon fa-solid fa-user"></i></span>
                      <span>
                        <?php echo $user['username'] ?>
                      </span>
                    </div>
                    <div class="mb-4 mt-2" style="border: 3px solid #f3ebeb4f;
                        border-radius: 10px;
                        background-color: #f5efef73;
                        padding: 9px;">
                      <?php echo $value['cmt'] ?>
                    </div>


                  <?php endforeach;
                } else { ?>

                  <p class="mb-20">Không có review nào.</p>

                <?php } ?>
                <form class="review-form" method="POST">
                  <div class="form-group">
                    <label>Sao của bạn</label>
                    <div class="reviews-counter">
                      <div class="rate " style="color:yella">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" style="color: #f9f91a" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" style="color: #f9f91a" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" style="color: #f9f91a" title="text">1 star</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label><i class="fa-solid fa-comment mr-2"></i>Bình luận</label>
                    <textarea class="form-control" name="cmt" rows="10" require></textarea>
                  </div>
                  <button type="submit" class="round-black-btn">Gửi review</button>
                </form>
              </div>
            </div>
          </div>

        </div>

      <?php } ?>
      </div>
  </div>
  <footer class="container-fuild bg-dark mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-4 footer ">
          <div style="color: rgba(255,255,255,.7);" class="footer-list">
            <h2 class="text-white fs-3 footer-title">BOOKLOVER</h2>
            <div class="mb-4">
              <i class="fa-solid fa-location-dot top-header-connect-icon-connect"></i>
              <span>123 Phường Xuân Khánh, Quận Ninh Kiều, Cần Thơ</span>
            </div>
            <p class="mb-4">Hãy kết nối với chúng tôi nhiều hơn qua mạng xã hội</p>
            <ul class="icon-connect pl-3">

              <li><a href="http://facebook"><i class="top-header-icon-social fab fa-facebook-f "></i></a></li>
              <li><a href="http://twitter"> <i class="top-header-icon-social fab fa-twitter"></i></i></a> </li>
              <li><a href="http://pinterest"><i class="top-header-icon-social fab fa-linkedin-in"></i></i></a> </li>
              <li><a href="http://pinterest"> <i class="top-header-icon-social  fab fa-instagram"></i></i></a></li>
            </ul>
          </div>

          <div style="color: rgba(255,255,255,.7);" class="footer-list">
            <h2 class="text-white fs-3 footer-title">Mở cửa</h2>
            <ul class="list-open pl-3  ">
              <li class="d-flex">
                <span style="width:100%">Mỗi ngày</span>
                <span>8:00 AM - 9:00 PM</span>
              </li>
            </ul>

          </div>
        </div>


        <div class="col-md-6 col-lg-4">
          <div style="color: rgba(255,255,255,.7);">
            <h2 class="text-white fs-3 footer-title">Instagram</h2>
            <div class="d-flex col-lg-12 pl-0">
              <a href="#" class="thumb-menu ime"><img class="img-fluid" width="100%" src="../public/image/home/footer1.jpeg" alt=""></a>
              <a href="#" class="thumb-menu ime"><img class="img-fluid" width="100%" src="../public/image/home/footer2.jpeg" alt=""></a>
              <a href="#" class="thumb-menu ime"><img class="img-fluid" width="100%" src="../public/image/home/footer3.jpg" alt=""></a>
            </div>

            <div class="d-flex col-lg-12 pl-0">
              <a href="#" class="thumb-menu ime"><img class="img-fluid" width="100%" src="../public/image/home/footer4.jpg" alt=""></a>
              <a href="#" class="thumb-menu ime"><img class="img-fluid" width="100%" src="../public/image/home/footer5.jpg" alt=""></a>
              <a href="#" class="thumb-menu ime"><img class="img-fluid" width="100%" src="../public/image/home/footer6.jpg" alt=""></a>
            </div>
          </div>
        </div>

        <div class="col-md-6 col-lg-4 ">
          <div style="color: rgba(255,255,255,.7);">
            <h2 class="text-white fs-3 footer-title">Tin tức mới</h2>
            <p class="mb-4">Để lại lại địa chỉ email để có thể nhận tin tức từ chúng tôi sớm nhất</p>
            <form action="#" class="subscribe-form">
              <div class="form-group">
                <input type="email" class="footer-input form-control text-center fs-3" placeholder="Địa chỉ email">
                <input type="submit" value="Đồng ý" class="footer-input form-control text-center footer-submit mt-2 fs-3">
              </div>
            </form>
          </div>
        </div>

        <div><a href="#logo"><img src="image/top.jpg" alt="" height="105px" class="rounded" id="top" style="box-shadow: 3px 388888 !important;"></a> </div>
        <div class="col-lg-12  my-3 footer-p" style="color: rgba(255,255,255,.7);">©2023 bản quyền thuộc về BookLover <i class="fas fa-heart"></i></div>
      </div>
    </div>

  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="	sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="js/menu-detail.js" type="text/javascript"></script>
</body>

</html>