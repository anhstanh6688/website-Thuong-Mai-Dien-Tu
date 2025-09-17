<?php
include '../../DB/connect.php';

$message = '';

if (!isset($_GET['order_id'])) {
    echo "ID đơn hàng không hợp lệ.";
    exit();
}

$order_id = intval($_GET['order_id']);

// Lấy thông tin đơn hàng hiện tại để điền vào form
$sql_select = "SELECT * FROM `order` WHERE order_id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $order_id);
$stmt_select->execute();
$result = $stmt_select->get_result();

if ($result->num_rows === 0) {
    echo "Không tìm thấy đơn hàng.";
    exit();
}
$order_data = $result->fetch_assoc();
$stmt_select->close();

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];

    $sql_update = "UPDATE `order` SET name = ?, phone = ?, address = ?, note = ? WHERE order_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssi", $name, $phone, $address, $note, $order_id);

    if ($stmt_update->execute()) {
        $message = "Cập nhật đơn hàng thành công!";
        // Cập nhật lại dữ liệu hiển thị trên form
        $order_data['name'] = $name;
        $order_data['phone'] = $phone;
        $order_data['address'] = $address;
        $order_data['note'] = $note;
    } else {
        $message = "Lỗi khi cập nhật: " . $stmt_update->error;
    }
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Đơn Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Sửa Đơn Hàng ID: <?php echo $order_id; ?></h2>
    <?php if ($message): ?>
        <div class="alert <?php echo strpos($message, 'thành công') !== false ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <form action="editOrder.php?order_id=<?php echo $order_id; ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Tên khách hàng:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($order_data['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($order_data['phone']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($order_data['address']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Ghi chú:</label>
            <textarea class="form-control" id="note" name="note" rows="3"><?php echo htmlspecialchars($order_data['note']); ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="../index.php?pageLayout=order" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>