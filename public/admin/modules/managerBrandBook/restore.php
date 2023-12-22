<?php  
   $id_brand = $_GET['id_brand'];
   $sql = "UPDATE `brands` SET `status_brand`= 0 WHERE id_brand = $id_brand";
   $query = mysqli_query($conn,$sql);
   $query_book = mysqli_query($conn, "UPDATE `books` SET `status_book`= 0 WHERE books.id_brand = $id_brand");
   echo '<script language="javascript">alert("Bạn đã khôi phục danh mục thành công!"); window.location="index.php?action=quan-ly-danh-muc-sach&query=danh-sach";</script>';

?>