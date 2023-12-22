
<?php
 include '../partials/header.php';

$username = $_SESSION['username'];
   
if(isset($username)){
    $sql = "SELECT * FROM accounts WHERE username  = '$username'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);    
    $tong=0;
    foreach($cart as $key => $value): $tong += $value['soluong']; 
    endforeach; 
    if(isset($_POST['borrow'])){
        $err= [];
        $id_account= $data['id_account'];
        $note=$_POST['note'];
        $phone= $_POST['phone']; 
    
        if(empty($phone)){
            $err['phone'] = 'Bạn chưa nhập số điện thoại';
        }

        if(empty($err)){
            $query= mysqli_query($conn,"INSERT INTO borrows(id_account,note,phone,total_book,date_borrow) VALUES ('$id_account','$note','$phone', $tong ,'".time()."')");

            if($query){
                $id_borrow= mysqli_insert_id($conn);
    
                foreach($cart as $value){
                    mysqli_query($conn,"INSERT INTO item_borrow(id_borrow,id_book) VALUES ('$id_borrow','$value[id_book]')");
                    
                }
                echo '<script language="javascript">alert("Đăng ký mượn sách thành công!"); window.location="index.php";</script>';
                unset($_SESSION['cart']);
            }    

        }
        
    }    
}

else {
       echo '<script language="javascript">alert("Bạn cần đăng nhập!"); window.location="login.php";</script>';
}

?>


<div class="container">
    
    <?php if(isset($_SESSION['username'])) {?>
    <div>
    <h1 class="tt-text1 text-center" style="color:#de3241;">Đăng Ký Mượn Sách</h1>       
    </div>
    <form action="order.php" method="post">
    <div class="row">
        <div class="col-md-5">
        <h2 class="text-center mb-3">THÔNG TIN KHÁCH HÀNG</h2>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Tên Khách Hàng:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['username'];?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $data['email'];?>" >
                    
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số Điện Thoại:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php if(isset($phone)){echo $phone; };?>">
                    <span class="erro"><?php echo (isset($err['phone']))?$err['phone']:''?></span>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Ghi Chú:</label>
                    <textarea  id="note" cols="50" rows="3" class="form-control" name="note" value="<?php if(isset($note)){echo $note; };?>"></textarea>
                    <!-- <span class="erro"><?php echo (isset($err['ghichu']))?$err['ghichu']:''?></span> -->
                </div>
                
                <div class="row justify-content-md-center">
                <div class="col col-lg-2"></div>
                    <div class="col-md-auto">
                    <button type="submit" name="borrow"class="btn btn-cart">Mượn sách</button>
                    </div>
                    
                    <div class="col col-lg-2"></div>
                </div>
            </form>
        </div>
        <div class="col-md-7">
            <h2 class="text-center mb-3">THÔNG TIN ĐƠN MƯỢN</h2>
            <table class="table table-bordered table-hover text-center">
                    <thead class="thead-light">
                        <tr >
                        <th style="text-align:center;">Tên sách</th>
                        <th style="text-align:center;">Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $tong=0;?>
                    <?php foreach($cart as $key => $value): $tong += $value['soluong'] ?>
                        <tr>
                        <td><?php echo $value['name_book']?></td>
                
                        <td><?php echo $value['soluong']?></td>
                        </tr>
                        
                        <?php endforeach ?>
                            <tr>
                                <td>Tổng sách:</td>
                                <td colspan="5" class="text-center" name="total_book"> <?php  echo $tong ?> </td>
                            </tr>
                        
                    </tbody>
                    
                </table>
                
        </div>

        
            
        </div>
    </div>
    
    
    </form>
    
    <!-- <?php } else {?>
     <div class="alert alert-danger">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <strong>Vui lòng dăng nhập để mua hàng!</strong><a href="login.php?action=order" title="">Đăng nhập</a>
     </div>   
    <?php } ?>  -->

    
</div>

<?php include '../partials/footer.php'  ?>
