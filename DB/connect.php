<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "webbanhang";

$conn = new mysqli($server, $user, $password, $database);

// kiểm tra biến đã kết nối được với 4 biến hay chưa và chạy
if ($conn) {
    mysqli_query($conn, "SETNAME 'utf8' ");
    // echo "Đã kết nối DB thành công !";
} else {
    echo "Kết nối DB thất bại !";
}
