<?php

// Kết nối cơ sở dữ liệu
include '../partials/mysqli_connect.php';
  
?>

<!doctype html>
<html lang="en">
  <head>
    <title>BookLovers</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
       
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/login.css">

    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/myProfile.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   
    

  </head>
  <body>
  <header class="header">
      <div class="top-header-area">
        <div class="container">
         <div class="row">
            <div class="col-lg-8">
                <ul class="top-header-information" >
                    <li class="top-header-list">
                      <a href="#" class="top-header-connect-icon text-decoration-none" >
                    
                        <i class="top-header-connect-icon-connect fa-solid fa-phone"></i>
                        <span class="top-header-content">0945 433 678</span> 
                      </a>
                        
                    </li>
                    <li class="top-header-list top-header-gmail">
                        <a href="#" class="top-header-connect-icon text-decoration-none">
                            <i class="top-header-connect-icon-connect  far fa-envelope-open"></i>
                          <span class="top-header-content">booklover@gmail.com</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 pt-3">
                
                <ul class="navbar-nav mr-auto top-header-social-network d-inline pt-3">
                        <?php  if (isset($_SESSION['username'])){  ?>
                            <li class="nav-item dropdown top-header-social">
                              <a class="nav-link dropdown-toggle top-header-login" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                      <?php 
                                            echo $_SESSION['username'] ;
                                        ?> 
                              </a>
                              <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="logout.php">Đăng xuất</a>
                                
                              </div> -->
                              <ul class="dropdown-content">
                                <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                                <li><a class="dropdown-item" href="info_profile.php">Xem thông tin cá nhân</a></li>
                              </ul>
                            </li>
                         <?php }else{ ?>
                                
                          <li class="nav-item dropdown top-header-social">
                              <a class="nav-link dropdown-toggle top-header-login" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                Tài khoản
                              </a>
                              <ul class="dropdown-content">
                                <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="register.php">Đăng ký</a></li>
                              </ul>
                            </li>
                         <?php }?>
                         
                         <li class=" nav-item  top-header-social">
                            <a href="view_cart.php" class="position-relative">
                            <i class="top-header-connect-icon-connect fa-solid fa-cart-shopping"></i>
                            <span class="position-absolute cart-notice top-0 start-100 translate-middle badge rounded-pill" >
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
          <img src="../public/image/home/logo-1.webp"  alt=""  id ="logo">
        </a>
         <!-- <img src="./image/logo1.png"  alt=""  id ="logo"> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"  ></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
           <ul class="navbar-nav ml-auto"
            style="justify-content: space-between;
                   margin-right: 100px;
                   margin-left: 100px;">
            <li class="nav-item nav-underline nav-active">
              <a class="nav-link" href="./index.php" >Trang chủ </a>
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
          <form id="search_sp" action="search.php" class="form-inline d-flex justify-content-center ml-1"  method="GET" >
                <input type="search" placeholder="Tìm kiếm" class="form-control form-search" aria-label="Search" name="key_search">
                <button  class="btn  btn-search"   type="submit" name="timkiem"><i style="padding:4px" class="fa fa-search fa-fw"></i></button>
         </form>
                          
        </div>
       </div>
      </nav>
     
   </header>