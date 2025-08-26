<?php
    include "../DB/connect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thêm thông số kỹ thuật</title>
</head>

<body>
    <h2>Thêm thông số kỹ thuật cho sản phẩm </h2>
    <form method="post">
        ID sản phẩm: <input type="text" name="product_id"> <br><br>
        Kiểu tủ: <input type="text" name="kieu_tu"><br><br>
        Dung tích tổng: <input type="text" name="dung_tich_tong"><br><br>
        Dung tích sử dụng: <input type="text" name="dung_tich_su_dung"><br><br>
        Dung tích ngăn đá: <input type="text" name="dung_tich_ngan_da"><br><br>
        Dung tích ngăn lạnh: <input type="text" name="dung_tich_ngan_lanh"><br><br>
        Chất liệu cửa: <input type="text" name="chat_lieu_cua"><br><br>
        Chất liệu khay: <input type="text" name="chat_lieu_khay"><br><br>
        Chất liệu ống: <input type="text" name="chat_lieu_ong"><br><br>
        Năm ra mắt: <input type="text" name="nam_ra_mat"><br><br>
        Sản xuất tại: <input type="text" name="san_xuat_tai"><br><br>

        <button type="submit" name="submit">Thêm thông số </button>
    </form>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $product_id        = $_POST['product_id'];
    $kieu_tu           = $_POST['kieu_tu'];
    $dung_tich_tong    = $_POST['dung_tich_tong'];
    $dung_tich_su_dung = $_POST['dung_tich_su_dung'];
    $dung_tich_ngan_da = $_POST['dung_tich_ngan_da'];
    $dung_tich_ngan_lanh = $_POST['dung_tich_ngan_lanh'];
    $chat_lieu_cua     = $_POST['chat_lieu_cua'];
    $chat_lieu_khay    = $_POST['chat_lieu_khay'];
    $chat_lieu_ong     = $_POST['chat_lieu_ong'];
    $nam_ra_mat        = $_POST['nam_ra_mat'];
    $san_xuat_tai      = $_POST['san_xuat_tai'];

    $sql = "INSERT INTO product_specs(product_id, kieu_tu, dung_tich_tong, dung_tich_su_dung, dung_tich_ngan_da, dung_tich_ngan_lanh, chat_lieu_cua, chat_lieu_khay, chat_lieu_ong, nam_ra_mat, san_xuat_tai)
            VALUES ('$product_id', '$kieu_tu', '$dung_tich_tong', '$dung_tich_su_dung', '$dung_tich_ngan_da', '$dung_tich_ngan_lanh', '$chat_lieu_cua', '$chat_lieu_khay', '$chat_lieu_ong', '$nam_ra_mat', '$san_xuat_tai')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Thêm specs thành công !');</script>";
    } else {
        echo "<script>alert('Lỗi !');</script>" . mysqli_error($conn);
    }
}
?>