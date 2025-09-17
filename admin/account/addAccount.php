<?php
include '../../DB/connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $role = $_POST['role'];

    // Mã hóa mật khẩu (nên dùng password_hash() trong thực tế)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Chèn dữ liệu vào DB
    $sql_insert = "INSERT INTO `thanhvien` (username, password, level, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ssis", $username, $password, $level, $role);

    if ($stmt->execute()) {
        $message = "Thêm tài khoản thành công!";
    } else {
        $message = "Lỗi khi thêm tài khoản: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm Tài Khoản Mới</h2>
        <?php if ($message): ?>
            <div class="alert <?php echo strpos($message, 'thành công') !== false ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="addAccount.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="level" class="form-label">Level:</label>
                <input type="number" class="form-control" id="level" name="level" required min="0">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Quyền:</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
            <a href="../index.php?pageLayout=taiKhoan" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>