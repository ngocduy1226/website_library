<?php

$count_query = mysqli_query($conn, "SELECT COUNT(id_contact) AS NumberCon FROM contacts WHERE contacts.status_cnt = 0;");
$count = mysqli_fetch_assoc($count_query);
//var_dump((int)$count['NumberCon']);
$count_con = (int)$count['NumberCon'];

$contact = mysqli_query($conn, "SELECT * FROM contacts WHERE status_cnt = 0 OR  status_cnt = 1 order by status_cnt ASC LIMIT 1,3");

?>

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
  <img class="animation__shake" src="../public/image/logo1.jpg" alt="AdminLTELogo" height="60" width="60">
</div>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../admin/index.php" class="nav-link">Trang chủ</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../index.php" class="nav-link">Trang khách</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Tìm kiếm" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge"> <?php echo $count_con; ?> </span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

      <?php
                  $i = 1;
                  while ($row = mysqli_fetch_assoc($contact)) {
                  ?>
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <img src="../dist/img/profile_user.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                <?php echo $row['username'] ?>
                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm"><?php echo $row['content'] ?></p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo date('d/m/y', $row['date_send']) ?></p>
            </div>
          </div>
          <!-- Message End -->
        </a>

        <?php  } ?>
        <div class="dropdown-divider"></div>
       
        <a href="?action=quan-ly-ket-noi&query=danh-sach" class="dropdown-item dropdown-footer">See All Messages</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>

  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="../dist/img/profile_user.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">BookLover</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="nav_user m-3">

      <?php if (isset($_SESSION['username'])) {  ?>
        <div class="dropdown show ">

          <a class="btn dropdown-toggle d-flex mt-1" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="image mr-2">
              <img src="../dist/img/user2-160x160.jpg" style="height: 30px" class="img-circle elevation-2" alt="User Image">
            </div>
            <?php
            echo $_SESSION['username'];
            ?>
          </a>

          <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" style="color: #000" href="?action=admin&query=dang-xuat">Đăng xuất</a>
            <a class="dropdown-item" style="color: #000" href="index.php">Xem thông tin cá nhân</a>
          </div>
        </div>
      <?php } else { ?>

        <div class="dropdown show">
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tài khoản
          </a>

          <div class="dropdown-menu text-white" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" style="color: #000" href="reg.php">Đăng ký</a>
            <a class="dropdown-item" style="color: #000" href="login.php">Đăng nhập</a>

          </div>
        </div>

      <?php } ?>





    </div>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="index.php" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Thống kê
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="index.php" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Thống kê 1</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Dashboard v3</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="index.php?action=quan-ly-danh-muc-sach&query=danh-sach" class="nav-link">
          <i class="nav-icon fa-solid fa-list"></i>
            <p>
              Quản lý danh mục sách
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            
            <li class="nav-item">
              <a href="index.php?action=quan-ly-danh-muc-sach&query=danh-sach" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?action=quan-ly-danh-muc-sach&query=them" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?action=quan-ly-danh-muc-sach&query=thung-rac" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thùng rác</p>
              </a>
            </li>
        
            
          </ul>
        </li>
           
        <li class="nav-item">
          <a href="index.php?action=quan-ly-sach&query=danh-sach" class="nav-link">
           
            <i class="nav-icon fa-solid fa-book"></i>
            <p>
              Quản lý sách
              
              <i class=" fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="index.php?action=quan-ly-sach&query=danh-sach" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?action=quan-ly-sach&query=them" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?action=quan-ly-sach&query=thung-rac" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thùng rác</p>
              </a>
            </li>
          
            
          </ul>
        </li>

        <li class="nav-item">
          <a href="index.php?action=quan-ly-thanh-vien&query=danh-sach" class="nav-link">
          <i class="nav-icon fa-solid fa-user"></i>
            <p>
              Quản lý thành viên
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="index.php?action=quan-ly-thanh-vien&query=danh-sach" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?action=quan-ly-thanh-vien&query=them" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm</p>
              </a>
            </li>

         
          </ul>
        </li>

        <li class="nav-item">
          <a href="index.php?action=quan-ly-ket-noi&query=danh-sach" class="nav-link">
          <i class="nav-icon fa-solid fa-address-book"></i>
            <p>
              Quản lý liên hệ
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="index.php?action=quan-ly-ket-noi&query=danh-sach" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
          
            <li class="nav-item">
              <a href="index.php?action=quan-ly-ket-noi&query=thung-rac" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thùng rác</p>
              </a>
            </li>
         
          </ul>
        </li>


        <li class="nav-item">
          <a href="index.php?action=quan-ly-muon-sach&query=danh-sach" class="nav-link">
          <i class="nav-icon fa-sharp fa-solid fa-book-open-reader"></i>
            <p>
              Quản lý mượn sách
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="index.php?action=quan-ly-muon-sach&query=danh-sach" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
      
            <li class="nav-item">
              <a href="index.php?action=quan-ly-muon-sach&query=thung-rac" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thùng rác</p>
              </a>
            </li>
    
           
          </ul>
        </li>

        <li class="nav-item">
          <a href="index.php?action=quan-ly-binh-luan&query=danh-sach" class="nav-link">
        
          <i class="nav-icon fa-solid fa-comments"></i>
            <p>
              Quản lý bình luận
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="index.php?action=quan-ly-binh-luan&query=danh-sach" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?action=quan-ly-binh-luan&query=thung-rac" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thùng rác</p>
              </a>
            </li>
           
          </ul>
        </li>

        <li class="nav-item">
          <a href="index.php?action=quan-ly-nhan-vien&query=danh-sach" class="nav-link">
          <i class="nav-icon fa-solid fa-user-tie"></i>
            <p>
              Quản lý nhân viên
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
              <a href="index.php?action=quan-ly-nhan-vien&query=danh-sach" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh sách</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?action=quan-ly-nhan-vien&query=them" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thêm</p>
              </a>
            </li>
        
            <li class="nav-item">
              <a href="index.php?action=quan-ly-nhan-vien&query=thung-rac" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Đã nghỉ</p>
              </a>
            </li>
           
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

