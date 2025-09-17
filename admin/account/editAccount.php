<?php
include '../../DB/connect.php';

$message = '';
if (!isset($_GET['id'])) {
    echo "ID tài khoản không hợp lệ.";
    exit();
}
$id = intval($_GET['id']);

// Lấy thông tin tài khoản hiện tại
$sql_select = "SELECT * FROM `thanhvien` WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows === 0) {
    echo "Không tìm thấy tài khoản.";
    exit();
}
$user_data = $result_select->fetch_assoc();
$stmt_select->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $role = $_POST['role'];

    // Nếu người dùng nhập mật khẩu mới, thì cập nhật
    if (!empty($password)) {
        $sql_update = "UPDATE `thanhvien` SET username = ?, password = ?, level = ?, role = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssisi", $username, $password, $level, $role, $id);
    } else {
        // Nếu không, chỉ cập nhật các trường còn lại
        $sql_update = "UPDATE `thanhvien` SET username = ?, level = ?, role = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sisi", $username, $level, $role, $id);
    }
    
    if ($stmt_update->execute()) {
        $message = "Cập nhật tài khoản thành công!";
        // Cập nhật lại dữ liệu hiển thị trên form
        $user_data['username'] = $username;
        $user_data['level'] = $level;
        $user_data['role'] = $role;
    } else {
        $message = "Lỗi khi cập nhật tài khoản: " . $stmt_update->error;
    }
    $stmt_update->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điện máy xanh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Sửa Tài Khoản ID: <?php echo $user_data['id']; ?></h2>
    <?php if ($message): ?>
        <div class="alert <?php echo strpos($message, 'thành công') !== false ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form action="editAccount.php?id=<?php echo $user_data['id']; ?>" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu (để trống nếu không đổi):</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Level:</label>
            <input type="number" class="form-control" id="level" name="level" value="<?php echo htmlspecialchars($user_data['level']); ?>" required min="0">
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Quyền:</label>
            <select class="form-select" id="role" name="role" required>
                <option value="user" <?php echo ($user_data['role'] === 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo ($user_data['role'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="../index.php?pageLayout=taiKHoan" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>