<?php
include '../../DB/connect.php';

$message = '';
$order_id = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $total = 0; // Khởi tạo tổng tiền là 0

    // Chèn dữ liệu vào bảng `order`
    $sql_insert_order = "INSERT INTO `order` (name, phone, address, note, total) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert_order);
    $stmt_insert->bind_param("sssid", $name, $phone, $address, $note, $total);

    if ($stmt_insert->execute()) {
        $order_id = $conn->insert_id;
        // Chuyển hướng đến trang thêm chi tiết đơn hàng, kèm theo order_id
        header("Location: addOrderDetail.php?order_id=" . $order_id);
        exit();
    } else {
        $message = "Lỗi khi tạo đơn hàng mới: " . $stmt_insert->error;
    }
    $stmt_insert->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="icon" href="../project/images/1742374793_67da878a0f466.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tạo Đơn Hàng Mới</h2>
    <?php if ($message): ?>
        <div class="alert alert-danger">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <form action="addOrder.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên khách hàng:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Ghi chú:</label>
            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Tạo Đơn Hàng & Thêm Chi Tiết</button>
        <a href="../index.php?pageLayout=order" class="btn btn-secondary mt-2">Quay lại</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>