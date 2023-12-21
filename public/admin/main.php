<div class="main">
     <?php
     if (isset($_GET['action']) && isset($_GET['query'])) {
          $tam = $_GET['action'];
          $query = $_GET['query'];
     } else {
          $tam = '';
          $query = '';
     }
     if ($tam == 'quan-ly-danh-muc-sach' && $query == 'danh-sach') {
          include("modules/managerBrandBook/list.php");
     } elseif ($tam == 'quan-ly-danh-muc-sach' && $query == 'them') {
          include("modules/managerBrandBook/create.php");
     } elseif ($tam == 'quan-ly-danh-muc-sach' && $query == 'sua') {
          include("modules/managerBrandBook/update.php");
     } elseif ($tam == 'quan-ly-danh-muc-sach' && $query == 'xoa') {
          include("modules/managerBrandBook/delete.php");
     } elseif ($tam == 'quan-ly-danh-muc-sach' && $query == 'thung-rac') {
          include("modules/managerBrandBook/bin.php");
     } elseif ($tam == 'quan-ly-danh-muc-sach' && $query == 'khoi-phuc') {
          include("modules/managerBrandBook/restore.php");
     } elseif ($tam == 'quan-ly-sach' && $query == 'danh-sach') {
          include("modules/managerBook/list.php");
     } elseif ($tam == 'quan-ly-sach' && $query == 'them') {
          include("modules/managerBook/create.php");
     } elseif ($tam == 'quan-ly-sach' && $query == 'sua') {
          include("modules/managerBook/update.php");
     } elseif ($tam == 'quan-ly-sach' && $query == 'xoa') {
          include("modules/managerBook/delete.php");
     } elseif ($tam == 'quan-ly-sach' && $query == 'thung-rac') {
          include("modules/managerBook/bin.php");
     } elseif ($tam == 'quan-ly-sach' && $query == 'khoi-phuc') {
          include("modules/managerBook/restore.php");
     } elseif ($tam == 'quan-ly-thanh-vien' && $query == 'danh-sach') {
          include("modules/account/list.php");
     } elseif ($tam == 'quan-ly-thanh-vien' && $query == 'them') {
          include("modules/account/create.php");
     } elseif ($tam == 'quan-ly-thanh-vien' && $query == 'sua') {
          include("modules/account/update.php");
     } elseif ($tam == 'quan-ly-muon-sach' && $query == 'danh-sach') {
          include("modules/borrow/list.php");
     } elseif ($tam == 'quan-ly-muon-sach' && $query == 'xem') {
          include("modules/borrow/item_borrow.php");
     } elseif ($tam == 'quan-ly-muon-sach' && $query == 'xoa') {
          include("modules/borrow/delete.php");
     } elseif ($tam == 'quan-ly-muon-sach' && $query == 'thung-rac') {
          include("modules/borrow/bin.php");
     } elseif ($tam == 'quan-ly-muon-sach' && $query == 'khoi-phuc') {
          include("modules/borrow/restore.php");
     } elseif ($tam == 'quan-ly-muon-sach' && $query == 'xoa-sach') {
          include("modules/borrow/delete_item_book.php");
     } elseif ($tam == 'quan-ly-ket-noi' && $query == 'danh-sach') {
          include("modules/contact/list.php");
     } elseif ($tam == 'quan-ly-ket-noi' && $query == 'xem') {
          include("modules/contact/seen.php");
     } elseif ($tam == 'quan-ly-ket-noi' && $query == 'xoa') {
          include("modules/contact/delete.php");
     } elseif ($tam == 'quan-ly-ket-noi' && $query == 'thung-rac') {
          include("modules/contact/bin.php");
     } elseif ($tam == 'quan-ly-ket-noi' && $query == 'khoi-phuc') {
          include("modules/contact/restore.php");
     } elseif ($tam == 'quan-ly-binh-luan' && $query == 'danh-sach') {
          include("modules/comment/list.php");
     } elseif ($tam == 'quan-ly-binh-luan' && $query == 'xoa') {
          include("modules/comment/delete.php");
     } elseif ($tam == 'quan-ly-binh-luan' && $query == 'thung-rac') {
          include("modules/comment/bin.php");
     } elseif ($tam == 'quan-ly-binh-luan' && $query == 'khoi-phuc') {
          include("modules/comment/restore.php");
     } elseif ($tam == 'quan-ly-nhan-vien' && $query == 'danh-sach') {
          include("modules/staff/list.php");
     } elseif ($tam == 'quan-ly-nhan-vien' && $query == 'them') {
          include("modules/staff/create.php");
     } elseif ($tam == 'quan-ly-nhan-vien' && $query == 'sua') {
          include("modules/staff/update.php");
     } elseif ($tam == 'quan-ly-nhan-vien' && $query == 'xoa') {
          include("modules/staff/delete.php");
     } elseif ($tam == 'quan-ly-nhan-vien' && $query == 'off') {
          include("modules/staff/off.php");
     } elseif ($tam == 'quan-ly-nhan-vien' && $query == 'on') {
          include("modules/staff/on.php");
     } elseif ($tam == 'quan-ly-muon-sach' && $query == 'in') {
          include("modules/borrow/print.php");
     } elseif ($tam == 'admin' && $query == 'dang-xuat') {
          include("logout.php");
     } elseif ($tam == 'admin' && $query == 'thong-ke') {
          include("modules/dashbroad1.php");
     } elseif ($tam == 'profile' && $query == 'xem') {
          include("info_profile.php");
     } elseif ($tam == 'profile' && $query == 'up') {
          include("up_profile.php");
     } else {
          include("modules/dashbroad.php");
     }
     ?>
</div>