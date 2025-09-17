<?php
session_start();
include '../DB/connect.php';

// Lấy sản phẩm trong giỏ
$products = false;
$total = 0;
if (!empty($_SESSION["cart"])) {
    $ids = array_keys($_SESSION["cart"]);
    $idList = implode(",", array_map('intval', $ids));
    $products = mysqli_query($conn, "SELECT * FROM sanpham WHERE product_id IN ($idList)");
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thanh toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
        }

        h1,
        h2 {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #f9f9f9;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 6px;
            display: block;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #27ae60;
            box-shadow: 0 0 5px rgba(39, 174, 96, 0.5);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }


        .actions {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
        }

        /* nút quay lại */
        .btn.back {
            background: #ccc;
            color: #000;
        }

        .btn.back:hover {
            background: #aaa;
        }

        /* nút thanh toán */
        .btn.pay {
            background: #27ae60;
            color: #fff;
        }

        .btn.pay:hover {
            background: #219150;
        }


        .payment-method {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            background: #fafafa;
            margin-bottom: 20px;
        }

        .payment-method label {
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Thanh toán</h1>

        <h2>Thông tin đơn hàng</h2>
        <table>
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products): ?>
                    <?php while ($row = mysqli_fetch_assoc($products)):
                        $qty = $_SESSION['cart'][$row['product_id']];
                        $lineTotal = $qty * $row['price'];
                        $total += $lineTotal;
                    ?>
                        <tr>
                            <td>
                                <img src="../project/images/<?= $row['image'] ?>"
                                    alt="<?= htmlspecialchars($row['product_name']) ?>" width="80">
                            </td>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td><?= $qty ?></td>
                            <td><?= number_format($row['price'], 0, ',', '.') ?> đ</td>
                            <td><?= number_format($lineTotal, 0, ',', '.') ?> đ</td>
                        </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="4"><b>Tổng tiền</b></td>
                        <td><b><?= number_format($total, 0, ',', '.') ?> đ</b></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


        <h2>Thông tin giao hàng</h2>
        <div class="form-group">
            <label>Người nhận</label>
            <input type="text" name="name">
        </div>
        <div class="form-group">
            <label>Điện thoại</label>
            <input type="text" name="phone">
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" name="address">
        </div>
        <div class="form-group">
            <label>Ghi chú</label>
            <textarea name="note"></textarea>
        </div>


        <h2>Phương thức thanh toán</h2>
        <div class="payment-method">
            <label><input type="radio" name="payment" value="cod" checked> Thanh toán khi nhận hàng</label><br>
            <label><input type="radio" name="payment" value="bank"> Chuyển khoản ngân hàng</label><br>
            <label><input type="radio" name="payment" value="credit"> Trả góp qua thẻ tín dụng</label>
        </div>


        <div class="actions">
            <a href="cart.php" class="btn back">Quay lại giỏ hàng</a>
            <button class="btn pay" onclick="thanhToan()">Thanh toán</button>
        </div>
    </div>
</body>

<script>
    function thanhToan() {
        alert("Thanh toán thành công!");
        window.location.href = "../trangchu/index.php";
    }
</script>

</html>