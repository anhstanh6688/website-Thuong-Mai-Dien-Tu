<?php 
    include "../DB/connect.php";
    include "../config.php";

    $this_id = $_GET["this_id"];

    $sql = "SELECT * FROM sanpham WHERE product_id = '$this_id' ";
    $querry = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($querry);

    if(isset($_POST["btn_Sua"])) {
        $type = $_POST["type"];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $old_price = $_POST['old_price'];
        $discount_percent = $_POST['discount_percent'];
        $gift = $_POST['gift'];
        $rating = $_POST['rating'];
        $sold_count = $_POST['sold_count'];
        $video_url = $_POST['video_url'];

        
        $image = $_FILES["image"]["name"]; 
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        if($image != "") {
            move_uploaded_file($image_tmp_name, '../project/images/' . $image); 
        } else {
            // giữ lại ảnh cũ
            $image = $row['image'];
        }

        // update sản phẩm
        $sql = "UPDATE sanpham 
        SET product_type = '$type' ,product_name = '$name', description = '$description', price = '$price', old_price = '$old_price', discount_percent = '$discount_percent', gift = '$gift', 
        rating = '$rating', sold_count = '$sold_count', image = '$image', video_url = '$video_url'
        WHERE product_id = '$this_id' ";
        mysqli_query($conn, $sql);

        // header("location:" . BASE_URL . "/project/products/$type/index1.php");
        echo "<script>alert('Sửa sản phẩm thành công !');</script>";
        
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
</head>

<body>
    <h2>Sản phẩm đang được chỉnh sửa <?php echo "có id là: ". $this_id; ?></h2>
    <form method="post" enctype="multipart/form-data">
        <label>Product Type:</label>
        <select name="type">
            <option value="chuachon" <?php if($row["product_type"] == "chuachon") echo "selected"; ?>>Chưa chọn</option>
            <option value="tu_lanh" <?php if($row["product_type"] == "tu_lanh") echo "selected"; ?>>Tủ lạnh</option>
            <option value="may_giat" <?php if($row["product_type"] == "may_giat") echo "selected"; ?>>Máy giặt</option>
            <option value="tivi" <?php if($row["product_type"] == "tivi") echo "selected"; ?>>Tivi</option>
            <option value="dieu_hoa" <?php if($row["product_type"] == "dieu_hoa") echo "selected"; ?>>Điều hòa</option>
            <option value="loa" <?php if($row["product_type"] == "loa") echo "selected"; ?>>Loa</option>
        </select>

        <br><br>

        <label>Product Name:</label>
        <input type="text" name="name" value="<?php echo $row["product_name"]; ?>">
        <br><br>

        <label>Description:</label>
        <input type="text" name="description" value="<?php echo $row["description"]; ?>">
        <br><br>

        <label>Price:</label>
        <input type=" text" name="price" value="<?php echo $row["price"]; ?>">
        <br><br>

        <label>Old Price:</label>
        <input type="text" name="old_price" value="<?php echo $row["old_price"]; ?>">
        <br><br>

        <label>Discount percent:</label>
        <input type="text" name="discount_percent" value="<?php echo $row["discount_percent"]; ?>">
        <br><br>

        <label>Gift:</label>
        <input type="text" name="gift" value="<?php echo $row["gift"]; ?>">
        <br><br>

        <label>Rating:</label>
        <input type="text" name="rating" placeholder="1->5" value="<?php echo $row["rating"]; ?>">
        <br><br>

        <label>Sold count:</label>
        <input type="text" name="sold_count" value="<?php echo $row["sold_count"]; ?>">
        <br><br>

        <label>Image: </label>
        <span><img src="../project/images/<?php echo $row["image"]; ?>" width="50px" height="50px" alt="Anh dep"></span>
        <input type="file" name="image">
        <br><br>

        <label>Video url: </label>
        <input type="text" name="video_url" placeholder="e.g: https://www.youtube.com/embed/djegwb8W73k"
            value="<?php echo $row["video_url"]; ?>">
        <br><br>

        <button type="submit" name="btn_Sua">Thay đổi</button>
    </form>
</body>

</html>