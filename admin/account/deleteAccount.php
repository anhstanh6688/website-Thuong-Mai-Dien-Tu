<?php
include '../../DB/connect.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM `thanhvien` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Xóa tài khoản thành công!'); window.location.href='../index.php?pageLayout=taiKhoan';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa tài khoản: " . $stmt->error . "'); window.location.href='../index.php?pageLayout=taiKHoan';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID tài khoản không hợp lệ!'); window.location.href='../index.php?pageLayout=taiKhoan';</script>";
}

$conn->close();
?>