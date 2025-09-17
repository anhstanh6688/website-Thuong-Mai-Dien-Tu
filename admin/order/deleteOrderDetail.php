<?php
include '../../DB/connect.php';

if (!isset($_GET['order_detail_id']) || !isset($_GET['order_id'])) {
    echo "ID chi tiết hoặc ID đơn hàng không hợp lệ.";
    exit();
}

$order_detail_id = intval($_GET['order_detail_id']);
$order_id = intval($_GET['order_id']);

$conn->begin_transaction();

try {
    // Xóa chi tiết đơn hàng
    $sql_delete = "DELETE FROM `order_detail` WHERE order_detail_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $order_detail_id);

    if (!$stmt_delete->execute()) {
        throw new Exception("Lỗi khi xóa chi tiết đơn hàng: " . $stmt_delete->error);
    }

    // Tính lại tổng tiền của đơn hàng
    $sql_update_total = "UPDATE `order` SET total = (SELECT COALESCE(SUM(price), 0) FROM `order_detail` WHERE order_id = ?) WHERE order_id = ?";
    $stmt_update_total = $conn->prepare($sql_update_total);
    $stmt_update_total->bind_param("ii", $order_id, $order_id);

    if (!$stmt_update_total->execute()) {
        throw new Exception("Lỗi khi cập nhật tổng tiền: " . $stmt_update_total->error);
    }

    $conn->commit();
    echo "<script>alert('Xóa chi tiết đơn hàng thành công!'); window.location.href='orderDetail.php?order_id=" . $order_id . "';</script>";

} catch (Exception $e) {
    $conn->rollback();
    echo "<script>alert('" . $e->getMessage() . "'); window.location.href='orderDetail.php?order_id=" . $order_id . "';</script>";
}

$conn->close();
?>