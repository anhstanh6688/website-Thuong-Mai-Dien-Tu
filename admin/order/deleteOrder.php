<?php
include '../../DB/connect.php';

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    $sql = "DELETE FROM `order` WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Xóa đơn hàng thành công!'); window.location.href='../index.php?pageLayout=order';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa đơn hàng: " . $stmt->error . "'); window.location.href='../index.php?pageLayout=order';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID đơn hàng không hợp lệ!'); window.location.href='../index.php?pageLayout=order';</script>";
}

$conn->close();
?>