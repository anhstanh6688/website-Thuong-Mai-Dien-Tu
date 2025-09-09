<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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

    .btn .btnDangKy {
        padding: 10px;
        text-decoration: none;
        color: black;
        font-size: 16px;
        background-color: #6FEC98;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn .btnDangKy:hover {
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

<?php 
    include "../DB/connect.php";
    include "../config.php";
    session_start();


    if(isset($_POST["dangnhap"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(empty($username) || empty($password)){
            echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
        } else {
            // check
            $sql = "SELECT * FROM thanhvien WHERE username = '$username' AND password = '$password' ";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['member_id'] = $row['id'];
                $_SESSION["mySession"] = $username;
                // echo "Debug: ".$_SESSION['member_id']; // test
                // exit;
                header("location: " .BASE_URL . "trangchu/index.php");
            }else {
                echo "<script>alert('Tài khoản hoặc mật khẩu sai');</script>";
            }
        }
    }
?>

<body>

    <div class="container">
        <h2>Đăng nhập</h2>
        <form action="login.php" method="post">
            <label>Username</label>
            <input type="text" name="username">
            <br>
            <label>Password</label>
            <input type="password" name="password">
            <br>
            <div class="btn">
                <button type="submit" name="dangnhap">Đăng nhập</button>
                <div class="dangky">
                    <a href="signup.php" class="btnDangKy">Đăng ký</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>