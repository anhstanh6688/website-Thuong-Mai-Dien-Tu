<?php
include '../../DB/connect.php';

if (isset($_GET['comment_id'])) {
    $comment_id = intval($_GET['comment_id']);

    $sql = "DELETE FROM `binhluan` WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute()) {
        echo "<script>alert('Xóa bình luận thành công!'); window.location.href='../index.php?pageLayout=binhLuan';</script>";
    } else {
        echo "<script>alert('Lỗi khi xóa bình luận: " . $stmt->error . "'); window.location.href='../index.php?pageLayout=binhLuan';</script>";
    }
    $stmt->close();
} else {
    echo "<script>alert('ID bình luận không hợp lệ!'); window.location.href='../index.php?pageLayout=binhLuan';</script>";
}

$conn->close();
?>