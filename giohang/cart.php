<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Giỏ Hàng</title>
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

    $error = false;
    $success = false;
    if (isset($_GET['action'])) {
        function update_cart($add = false)
        {
            foreach ($_POST['quantity'] as $id => $quantity) {
                // số lương = 0 thì xóa
                if ($quantity == 0) {
                    unset($_SESSION["cart"][$id]);
                } else {
                    if ($add) {
                        $_SESSION["cart"][$id] += $quantity;
                    } else {
                        $_SESSION["cart"][$id] = $quantity;
                    }
                }
            }
        }

        switch ($_GET['action']) {
            case "add":
                update_cart(true);
                // add xong về lại trang cart cho đẹp
                header("location: ./cart.php");
                break;

            case "delete":
                // tồn tại id thì xóa session
                if (isset($_GET["id"])) {
                    unset($_SESSION["cart"][$_GET["id"]]);
                }
                // xóa xong về lại trang cart cho đẹp
                header("location: ./cart.php");
                break;

            case "submit":
                // xử lý 2 button 
                if (isset($_POST["update_click"])) { // cập nhật số lượng SP
                    // echo "Cập nhật"; exit;
                    update_cart();
                    header("location: ./cart.php");
                } elseif ($_POST["order_click"]) { // đặt hàng SP
                    // echo "Đặt hàng"; exit;

                    // validate 
                    if (empty($_POST["name"])) {
                        $error = "Bạn chưa nhập tên người nhận";
                    } elseif (empty($_POST["phone"])) {
                        $error = "Bạn chưa nhập số điện thoại";
                    } elseif (empty($_POST["address"])) {
                        $error = "Bạn chưa nhập địa chỉ";
                    } elseif (empty($_POST["quantity"])) {
                        $error = "Giỏ hàng rỗng";
                    }

                    // lấy dữ liệu đưa lên DB
                    if ($error == false && !empty($_POST["quantity"])) {
                        $ids = array_keys($_SESSION["cart"]);
                        $idList = implode(",", array_map('intval', $ids));
                        $products = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE `product_id` IN ($idList)");

                        // lấy tổng tiền
                        $total = 0;
                        $orderProducts = array();

                        while ($row = mysqli_fetch_array($products)) {
                            $orderProducts[] = $row;
                            $total += $row["price"] * $_POST["quantity"][$row["product_id"]];
                        }
                        // var_dump($total); exit();

                        // lưu vào DB
                        $name = $_POST["name"];
                        $phone = $_POST["phone"];
                        $address = $_POST["address"];
                        $note = $_POST["note"];

                        $sql = "INSERT INTO `order` (`order_id`, `name`, `phone`, `address`, `note`, `total`) 
                                VALUES (NULL, '$name', '$phone', '$address', '$note', '$total')";
                        $inserOrder = mysqli_query($conn, $sql);
                        // var_dump($inserOrder);
                        // exit();


                        // insert order vào order_detail

                        $orderID = $conn->insert_id; // lấy ra được id của bảng order
                        $insertString = "";
                        // INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) 
                        //  VALUES (NULL, '4', '21', '3', '9480000'), ;

                        // var_dump($orderProducts);
                        // exit();
                        foreach ($orderProducts as $key => $products) {
                            $insertString .= "(NULL, '$orderID', '" . $products["product_id"] . "', '" . $_POST['quantity'][$products['product_id']] . "', '" . $products["price"] . "')";

                            // xóa dấu phẩy cuối
                            if ($key != count($orderProducts) - 1) {
                                $insertString .= ",";
                            }
                        }
                        // var_dump($insertString);
                        // exit();

                        $insertOrder = mysqli_query($conn, "INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `product_id`, `quantity`, `price`) 
                        VALUES " . $insertString . ";");
                        $success = "Đặt hàng thành công";

                        // mua xong bỏ hết giỏ hàng cũ
                        unset($_SESSION["cart"]);
                    }
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
        <?php if (!empty($error)) { ?>
            <div id="notify-msg">
                <!-- cú pháp JS để back -->
                <?= $error; ?> . <a href="javascript:history.back()">Quay lại</a>
            </div>
        <?php } elseif (!empty($success)) { ?>
            <div id="notify-msg">
                <?= $success; ?> . <a href="../trangchu/index.php">Tiếp tục mua hàng</a>
            </div>
        <?php } else { ?>
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
                    if (!empty($products)) {
                        $total = 0;
                        $num = 1;
                        while ($row = mysqli_fetch_array($products)) { ?>
                            <tr>
                                <td class="product-number"><?= $num++; ?></td>
                                <td class="product-name"><?= $row['product_name'] ?></td>
                                <td class="product-img"><img src="../project/images/<?= $row['image'] ?>" /></td>
                                <td class="product-price"><?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                                <!-- lấy ra số lượng sản phẩm -->
                                <td class="product-quantity"><input type="text" value="<?= $_SESSION["cart"][$row['product_id']] ?>"
                                        name="quantity[<?= $row['product_id'] ?>]" /></td>
                                <!-- thành tiền -->
                                <td class="total-money">
                                    <?php echo number_format($row['price'] * $_SESSION["cart"][$row['product_id']], 0, ',', '.'); ?>
                                </td>
                                <!-- xóa -->
                                <td class="product-delete"><a href="cart.php?action=delete&id=<?= $row['product_id']; ?>">Xóa</a>
                                </td>
                            </tr>

                        <?php
                            $total += $row['price'] * $_SESSION["cart"][$row['product_id']];
                            $num++;
                        }
                        ?>
                        <tr id="row-total">
                            <td class="product-number">&nbsp;</td>
                            <td class="product-name">Tổng tiền</td>
                            <td class="product-img">&nbsp;</td>
                            <td class="product-price">&nbsp;</td>
                            <td class="product-quantity">&nbsp;</td>
                            <!-- Tổng tiền -->
                            <td class="total-money"><?php echo number_format($total, 0, ',', '.'); ?></td>
                            <td class="product-delete">Xóa</td>
                        </tr>
                    <?php
                    }
                    ?>


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
        <?php } ?>
    </div>
</body>

</html>