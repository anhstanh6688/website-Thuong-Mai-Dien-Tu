<?php
include "../DB/connect.php";
include "../config.php";

$this_id = $_GET["this_id"];

$sql = "SELECT * FROM sanpham WHERE product_id = '$this_id' ";
$querry = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($querry);

if (isset($_POST["btn_Sua"])) {
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
    if ($image != "") {
        move_uploaded_file($image_tmp_name, '../project/images/' . $image);
    } else {
        // giữ lại ảnh cũ
        $image = $row['image'];
    }

    // update sản phẩm
    $sql = "UPDATE sanpham 
        SET product_type = '$type' ,product_name = '$name', description = '$description', 
        price = '$price', old_price = '$old_price', discount_percent = '$discount_percent', gift = '$gift', 
        rating = '$rating', sold_count = '$sold_count', image = '$image', video_url = '$video_url'
        WHERE product_id = '$this_id' ";
    mysqli_query($conn, $sql);

    // header("location:" . BASE_URL . "/project/products/$type/index1.php");
    echo "<script>alert('Sửa sản phẩm thành công !'); window.location.href='../admin/index.php?pageLayout=sanPham';</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f4f6f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 40px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-item {
            display: flex;
            flex-direction: column;
        }

        .form-item label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #444;
        }

        .form-item input,
        .form-item select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            width: 100%;
            transition: all 0.3s;
        }

        .form-item input:focus,
        .form-item select:focus {
            border-color: #2980b9;
            outline: none;
            box-shadow: 0 0 5px rgba(41, 128, 185, 0.5);
        }

        .form-item img {
            margin-bottom: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .btn-submit {
            grid-column: span 2;
            margin-top: 20px;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #3498db;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
        }

        .btn-submit:hover {
            background: #2980b9;
        }
    </style>


</head>

<body>
    <div class="container">
        <h2>Sản phẩm đang được chỉnh sửa <?php echo "có ID " . $this_id; ?></h2>
        <form method="post" enctype="multipart/form-data" class="form-grid">

            <!-- cột trái -->
            <div class="form-group">
                <div class="form-item">
                    <label>Product Type:</label>
                    <select name="type">
                        <option value="chuachon" <?php if ($row["product_type"] == "chuachon") echo "selected"; ?>>Chưa
                            chọn</option>
                        <option value="tu_lanh" <?php if ($row["product_type"] == "tu_lanh") echo "selected"; ?>>Tủ lạnh
                        </option>
                        <option value="may_giat" <?php if ($row["product_type"] == "may_giat") echo "selected"; ?>>Máy
                            giặt</option>
                        <option value="tivi" <?php if ($row["product_type"] == "tivi") echo "selected"; ?>>Tivi</option>
                        <option value="dieu_hoa" <?php if ($row["product_type"] == "dieu_hoa") echo "selected"; ?>>Điều
                            hòa</option>
                        <option value="loa" <?php if ($row["product_type"] == "loa") echo "selected"; ?>>Loa</option>
                    </select>
                </div>

                <div class="form-item">
                    <label>Product Name:</label>
                    <input type="text" name="name" value="<?php echo $row["product_name"]; ?>">
                </div>

                <div class="form-item">
                    <label>Description:</label>
                    <input type="text" name="description" value="<?php echo $row["description"]; ?>">
                </div>

                <div class="form-item">
                    <label>Rating:</label>
                    <input type="text" name="rating" placeholder="1->5" value="<?php echo $row["rating"]; ?>">
                </div>

                <div class="form-item">
                    <label>Sold count:</label>
                    <input type="text" name="sold_count" value="<?php echo $row["sold_count"]; ?>">
                </div>
            </div>

            <!-- cột phải -->
            <div class="form-group">
                <div class="form-item">
                    <label>Price:</label>
                    <input type="text" name="price" value="<?php echo $row["price"]; ?>">
                </div>

                <div class="form-item">
                    <label>Old Price:</label>
                    <input type="text" name="old_price" value="<?php echo $row["old_price"]; ?>">
                </div>

                <div class="form-item">
                    <label>Discount percent:</label>
                    <input type="text" name="discount_percent" value="<?php echo $row["discount_percent"]; ?>">
                </div>

                <div class="form-item">
                    <label>Gift:</label>
                    <input type="text" name="gift" value="<?php echo $row["gift"]; ?>">
                </div>

                <div class="form-item">
                    <label>Image: </label>
                    <span>
                        <img src="../project/images/<?php echo $row["image"]; ?>" width="50px" height="50px"
                            alt="Anh dep">
                    </span>
                    <input type="file" name="image">
                </div>

                <div class="form-item">
                    <label>Video url: </label>
                    <input type="text" name="video_url" placeholder="e.g: https://www.youtube.com/embed/djegwb8W73k"
                        value="<?php echo $row["video_url"]; ?>">
                </div>
            </div>

            <!-- Nút submit -->
            <button type="submit" name="btn_Sua" class="btn-submit">Thay đổi</button>
        </form>
    </div>

</body>

</html>