<?php
// include '../../cart_function.php';
if (isset($_GET['id_borrow'])) {
    $id_borrow = $_GET['id_borrow'];

    $borrow_query = mysqli_query($conn, "SELECT * FROM borrows where id_borrow  = $id_borrow");
    //  $sql_trang = $order_query;
    $borrow = mysqli_fetch_assoc($borrow_query);
    $id_account = $borrow['id_account'];

    $account_query = mysqli_query($conn, "SELECT * FROM accounts where id_account = $id_account");
    $account = mysqli_fetch_assoc($account_query);



    $sql_up = mysqli_query($conn, "UPDATE `borrows` SET `date_borrow`='" . time() . "' WHERE id_borrow = $id_borrow");
    //lấy ds sp trong đơn hàng
    $books = mysqli_query($conn, "SELECT * FROM item_borrow JOIN books 
                                               ON item_borrow.id_book = books.id_book 
                                               WHERE item_borrow.id_borrow = '$id_borrow'");

    $date = date('y-m-d', $borrow['date_borrow']);
    $newdate = strtotime('+1 week', strtotime($date));
    $new = date('d/m/y', $newdate);
}

?>



<style>
    .in {
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tohoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 21cm;
        overflow: hidden;
        min-height: 297mm;
        padding: 2.5cm;
        margin-left: auto;
        margin-right: auto;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 237mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A4;
        margin: 0;
    }

    button {
        width: 100px;
        height: 24px;
    }

    .header {
        overflow: hidden;
    }

    .logo {
        background-color: #FFFFFF;
        text-align: left;
        float: left;
    }

    .company {
        padding-top: 24px;
        text-transform: uppercase;
        background-color: #FFFFFF;
        text-align: right;
        float: right;
        font-size: 16px;
    }

    .title {
        text-align: center;
        position: relative;
        color: #0000FF;
        font-size: 24px;
        top: 1px;
    }

    .footer-left {
        text-align: center;
        text-transform: uppercase;
        padding-top: 24px;
        position: relative;
        height: 150px;
        width: 50%;
        color: #000;
        float: left;
        font-size: 12px;
        bottom: 1px;
    }

    .footer-right {
        text-align: center;
        text-transform: uppercase;
        padding-top: 24px;
        position: relative;
        height: 150px;
        width: 50%;
        color: #000;
        font-size: 12px;
        float: right;
        bottom: 1px;
    }

    .TableData {
        background: #ffffff;
        font: 11px;
        width: 100%;
        border-collapse: collapse;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 12px;
        border: thin solid #d3d3d3;
    }

    .TableData TH {
        background: rgba(0, 0, 255, 0.1);
        text-align: center;
        font-weight: bold;
        color: #000;
        border: solid 1px #ccc;
        height: 24px;
    }

    .TableData TR {
        height: 24px;
        border: thin solid #d3d3d3;
    }

    .TableData TR TD {
        padding-right: 2px;
        padding-left: 2px;
        border: thin solid #d3d3d3;
    }

    .TableData TR:hover {
        background: rgba(0, 0, 0, 0.05);
    }

    .TableData .cotSTT {
        text-align: center;
        width: 10%;
    }

    .TableData .cotTenSanPham {
        text-align: left;
        width: 40%;
    }

    .TableData .cotHangSanXuat {
        text-align: left;
        width: 20%;
    }

    .TableData .cotGia {
        text-align: right;
        width: 120px;
    }

    .TableData .cotSoLuong {
        text-align: center;
        width: 50px;
    }

    .TableData .cotSo {
        text-align: right;
        width: 120px;
    }

    .TableData .tong {
        text-align: right;
        font-weight: bold;
        text-transform: uppercase;
        padding-right: 4px;
    }

    .TableData .cotSoLuong input {
        text-align: center;
    }

    @media print {
        @page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>

<div class="in" onload="window.print();">
    <div id="page" class="page">
        <div class="header">
            <div class="logo"><img style=" hight:23px; width:127px;" /></div>
            <div class="company">Thư viện BookStore</div>
        </div>
        <br />
        <div class="title">
            ĐƠN MƯỢN SÁCH
            <br />
            -------oOo-------
        </div>
        <br />
        <br />
        <div>
            <h5 class="mb-2"><strong>THÔNG TIN KHÁCH HÀNG </strong></h5>
            <div>
                <p> Tên khách hàng: <?php echo $account['username'] ?></p>
                <p> Số điện thoại: <?php echo $borrow['phone'] ?></p>
                <p> Ghi chú: <?php echo $borrow['note'] ?> </p>
                <p> Ngày đăng ký: <?php echo date('d/m/y H:i', $borrow['date_borrow']) ?></p>

                <p><strong>Hạn trả: <?php

                                    if ($borrow['borrowed'] == 5) {
                                        $date = date('y-m-d', $borrow['date_borrow']);
                                        $newdate = strtotime('+2 week', strtotime($date));
                                        $new = date('d/m/y', $newdate);
                                    }

                                    echo $new;
                                    ?> </strong> </p>
                <p>Trạng thái: 
                    <?php if ($borrow['borrowed'] == 0) { ?>
                        <span class="badge bg-warning"> Chưa xử lý </span>
                    <?php } elseif ($borrow['borrowed'] == 1) {
                    ?>
                        <span class="badge bg-secondary"> Đã xử lý </span>
                    <?php } elseif ($borrow['borrowed'] == 2) { ?>
                        <span class="badge bg-primary bg-gradient"> Đã mượn </span>
                    <?php } elseif ($borrow['borrowed'] == 3) {

                    ?>
                        <span class="badge bg-success"> Đã trả </span>
                    <?php } elseif ($borrow['borrowed'] == 4) {

                    ?>
                        <span class="badge bg-danger"> Xin gia hạn </span>
                    <?php } elseif ($borrow['borrowed'] == 5) {

                    ?>
                        <span class="badge bg-success"> Gia hạn </span>
                    <?php } else { ?>
                        <span class="badge bg-danger"> Hủy </span>
                    <?php } ?>
                </p>
            </div>


        </div>
        <h5 class="mt-4 mb-2"><strong>DANH SÁCH CÁC SÁCH MƯỢN </strong></h5>
        <table class="TableData" style="text-align:center;">
            <tr>
                <th>STT</th>
                <th>Tên</th>



            </tr>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($books)) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['name_book']; ?></td>


                </tr>

            <?php } ?>
            <tr>
                <td>Tổng sách</td>
                <td colspan="2"><?php echo $borrow['total_book']; ?></td>
            </tr>
        </table>

    </div>