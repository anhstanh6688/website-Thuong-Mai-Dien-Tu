<?php
include '../../DB/connect.php';

$message = '';

if (!isset($_GET['comment_id'])) {
    echo "ID bình luận không hợp lệ.";
    exit();
}

$comment_id = intval($_GET['comment_id']);

// Lấy thông tin bình luận hiện tại để điền vào form
$sql_select = "SELECT * FROM `binhluan` WHERE comment_id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $comment_id);
$stmt_select->execute();
$result = $stmt_select->get_result();

if ($result->num_rows === 0) {
    echo "Không tìm thấy bình luận.";
    exit();
}
$comment_data = $result->fetch_assoc();
$stmt_select->close();

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $sql_update = "UPDATE `binhluan` SET rating = ?, comment = ? WHERE comment_id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("isi", $rating, $comment, $comment_id);

    if ($stmt_update->execute()) {
        $message = "Cập nhật bình luận thành công!";
        // Cập nhật lại dữ liệu hiển thị trên form
        $comment_data['rating'] = $rating;
        $comment_data['comment'] = $comment;
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
    <title>Sửa Bình luận</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Sửa Bình luận ID: <?php echo $comment_id; ?></h2>
    <?php if ($message): ?>
        <div class="alert <?php echo strpos($message, 'thành công') !== false ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <form action="editComment.php?comment_id=<?php echo $comment_id; ?>" method="post">
        <div class="mb-3">
            <label for="rating" class="form-label">Đánh giá:</label>
            <input type="number" class="form-control" id="rating" name="rating" value="<?php echo htmlspecialchars($comment_data['rating']); ?>" required min="1" max="5">
        </div>
        <div class="mb-3">
            <label for="comment" class="form-label">Nội dung:</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required><?php echo htmlspecialchars($comment_data['comment']); ?></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="../index.php?pageLayout=binhLuan" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>