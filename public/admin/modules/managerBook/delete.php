<?php  
   $id_book = $_GET['id_book'];
   $sql = "UPDATE `books` SET `status_book`= 1 WHERE id_book = $id_book";
   $query = mysqli_query($conn,$sql);
//   header('location: index.php?action=qlsanpham&query=danhsach'); 
   echo '<script language="javascript">alert("Bạn đã xóa sách thành công!"); window.location="index.php?action=quan-ly-sach&query=danh-sach";</script>';

?>