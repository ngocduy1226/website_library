<?php
include '../partials/mysqli_connect.php';

if(isset($_SESSION['username'])  &&  isset($_GET['id_book'])){
    $id_book= $_GET['id_book'];


    $action = (isset($_GET['action']))? $_GET['action'] : 'add';
    $soluong = 1;
    $query= mysqli_query($conn,"SELECT * FROM books WHERE id_book = $id_book");
    if($query){
        $book = mysqli_fetch_assoc($query);
    }

    $item= [
        'id_book'=>$book['id_book'],
        'image'=>$book['image'],
        'name_book'=>$book['name_book'],
        'soluong'=> $soluong
    ];
    if($action == 'add'){
        if(isset($_SESSION['cart'][$id_book])){
            $_SESSION['cart'][$id_book]['soluong'] = 1;
        }else{
        $_SESSION['cart'][$id_book] =$item;
        }
    }

    // if($action == 'update'){
    //     $_SESSION['cart'][$id_book]['soluong']=$soluong;
    // }
    if($action == 'delete'){
        
        unset($_SESSION['cart'][$id_book]);
    }
    header('location: view_cart.php');

  }
    else {

        echo '<script language="javascript">alert("Bạn chưa đăng nhập!"); window.location="login.php";</script>';
    }

?>