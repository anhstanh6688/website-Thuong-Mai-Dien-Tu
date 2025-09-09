<?php 
    include "../DB/connect.php";
    include "../config.php";

 
    if(isset($_POST["dangky"])) {
        $id = "";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $level = 2;

        if(empty($username) || empty($password) || empty($confirmPassword)){
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
        } elseif(strlen($username) < 4){
            echo "<script>alert('Tên đăng nhập phải từ 4 ký tự trở lên!');</script>";
        } elseif(strlen($password) < 6){
            echo "<script>alert('Mật khẩu phải từ 6 ký tự trở lên!');</script>";
        } elseif($password !== $confirmPassword){
            echo "<script>alert('Mật khẩu xác nhận không khớp!');</script>";
        } else {
            // Check username trùng
            $check = "SELECT * FROM thanhvien WHERE username='$username'";
            $result = mysqli_query($conn, $check);
            if(mysqli_num_rows($result) > 0){
                echo "<script>alert('Tên đăng nhập đã tồn tại!');</script>";
            } else {
                $sql = "INSERT INTO thanhvien (id, username, password, level)
                        VALUES ('$id', '$username', '$hashedPassword', '$level')";
                mysqli_query($conn, $sql);

                header("location:" . BASE_URL . "auth/login.php");
                exit();
        }
    }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng ký</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f7fa;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* chiếm hết chiều cao màn hình */
        margin: 0;
    }

    .container {
        background: #fff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 350px;
    }

    .container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #444;
    }

    .container input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: border-color 0.3s;
    }

    .container input:focus {
        border-color: #007bff;
    }

    .btn {
        margin: 0 auto;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    .btn .btnDangNhap {
        padding: 10px;
        text-decoration: none;
        color: black;
        font-size: 16px;
        background-color: #6FEC98;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn .btnDangNhap:hover {
        background-color: #05eb52ff;
    }

    .btn button {
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn button:hover {
        background: #0056b3;
    }
    </style>
</head>



<body>
    <div class="container">
        <h2>Đăng ký</h2>
        <form action="signup.php" method="post">
            <label>Username</label>
            <input type="text" name="username">
            <br>
            <label>Password</label>
            <input type="password" name="password">
            <br>
            <label>Confirm password</label>
            <input type="password" name="confirmPassword">
            <br>
            <div class="btn">
                <button type="submit" name="dangky">Đăng ký</button>
                <div class="dangnhap">
                    <a href="login.php" class="btnDangNhap">Đăng nhập</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>