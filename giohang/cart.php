<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Gio Hang</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleCart.css">
</head>

<body>
    <?php
        include '../DB/connect.php';
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case "add":
                    foreach ($_POST['quantity'] as $id => $quantity) {
                        $_SESSION["cart"][$id] = $quantity;
                    }
                    break;
            }
        }
        // if (!empty($_SESSION["cart"])) {
        //     $products = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE `product_id` IN (".implode(",", array_keys($_SESSION["cart"])).")");
        // }

        if (!empty($_SESSION["cart"])) {
            $ids = array_keys($_SESSION["cart"]);
            $idList = implode(",", array_map('intval', $ids));
            $products = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE `product_id` IN ($idList)");
        } else {
            $products = false;
}
        

    ?>

    <div class="container">
        <a href="../trangchu/index.php">Trang chủ</a>
        <h1>Giỏ hàng</h1>
        <form id="cart-form" action="cart.php?action=submit" method="POST">
            <table>
                <tr>
                    <th class="product-number">STT</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="product-img">Ảnh sản phẩm</th>
                    <th class="product-price">Đơn giá</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="total-money">Thành tiền</th>
                    <th class="product-delete">Xóa</th>
                </tr>
                <?php 
                    $num = 1;
                    while ($row = mysqli_fetch_array($products)) { ?>

                <tr>
                    <td class="product-number"><?=$num++;?></td>
                    <td class="product-name"><?=$row['product_name']?></td>
                    <td class="product-img"><img src="../project/images/<?=$row['image']?>" /></td>
                    <td class="product-price"><?=$row['price']?></td>
                    <!-- lấy ra số lượng sản phẩm -->
                    <td class="product-quantity"><input type="text" value="<?=$_SESSION["cart"][$row['product_id']]?>"
                            name="quantity[<?=$row['product_id']?>]" /></td>
                    <!-- thành tiền -->
                    <td class="total-money"><?= $row['price'] * $_SESSION["cart"][$row['product_id']] ?></td>
                    <td class="product-delete">Xóa</td>
                </tr>

                <?php } ?>
                <tr id="row-total">
                    <td class="product-number">&nbsp;</td>
                    <td class="product-name">Tổng tiền</td>
                    <td class="product-img">&nbsp;</td>
                    <td class="product-price">&nbsp;</td>
                    <td class="product-quantity">&nbsp;</td>
                    <td class="total-money">2.500.000</td>
                    <td class="product-delete">Xóa</td>
                </tr>



            </table>
            <div id="form-button">
                <input type="submit" name="update_click" value="Cập nhật" />
            </div>
            <hr>
            <div><label>Người nhận: </label><input type="text" value="" name="name" /></div>
            <div><label>Điện thoại: </label><input type="text" value="" name="phone" /></div>
            <div><label>Địa chỉ: </label><input type="text" value="" name="address" /></div>
            <div><label>Ghi chú: </label><textarea name="note" cols="50" rows="7"></textarea></div>
            <input type="submit" name="order_click" value="Đặt hàng" />
        </form>
    </div>
</body>

</html>