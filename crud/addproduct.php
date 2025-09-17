<?php
include "../DB/connect.php";
include "../config.php";

if (isset($_POST["btn_Them"])) {
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
    // xử lý validate
    $errors = [];

    if (empty($type)) {
        $errors[] = "Chưa chọn loại sản phẩm";
    }

    if (empty($description)) {
        $errors[] = "Chưa mô tả sản phẩm";
    }

    if (empty($name)) {
        $errors[] = "Tên sản phẩm không được để trống";
    }

    if ((empty($price) || !is_numeric($price)) || (empty($old_price) || !is_numeric($old_price))) {
        $errors[] = "Giá phải là số";
    }

    if (empty($discount_percent)) {
        $errors[] = "Chưa có giảm giá sản phẩm";
    }

    if (empty($gift)) {
        $errors[] = "Chưa ghi quà tặng";
    }

    if (empty($sold_count)) {
        $errors[] = "Chưa có tổng số lượng đã bán";
    }

    if (!empty($rating) && ($rating < 1 || $rating > 5)) {
        $errors[] = "Rating chỉ được từ 1 đến 5";
    }

    // có lỗi thì in ra và dừng
    if (!empty($errors)) {
        foreach ($errors as $err) {
            echo "<p style='color:red'>$err</p>";
        }
    } else {
        // xử lý image
        $image = $_FILES["image"]["name"];
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        move_uploaded_file($image_tmp_name, '../project/images/' . $image);




        $sql = "INSERT INTO sanpham(product_type, product_name, description, price, old_price, discount_percent, gift, rating, sold_count, image, video_url)
                    VALUES ('$type', '$name', '$description', '$price', '$old_price', '$discount_percent', '$gift', '$rating', '$sold_count', '$image', '$video_url') ";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            // lấy id sản phẩm vừa thêm
            $product_id = mysqli_insert_id($conn);
            header("location: ../crud/addSpecs.php?product_id=$product_id");
        } else {
            echo "<script> alert('Lỗi !'); </script>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang thêm sản phẩm</title>

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
        <h2>Thêm sản phẩm </h2>
        <form action="addproduct.php" method="post" enctype="multipart/form-data" class="form-grid">
            <!-- cột trái -->
            <div class="form-group">
                <div class="form-item">
                    <label>Product Type:</label>
                    <select name="type">
                        <option value="chuachon">Chưa chọn</option>
                        <option value="tu_lanh">Tủ lạnh</option>
                        <option value="may_giat">Máy giặt</option>
                        <option value="tivi">Tivi</option>
                        <option value="dieu_hoa">Điều hòa</option>
                        <option value="loa">Loa</option>
                    </select>
                    <br><br>

                    <label>Product Name:</label>
                    <input type="text" name="name">
                    <br><br>

                    <label>Description:</label>
                    <input type="text" name="description">
                    <br><br>

                    <label>Price:</label>
                    <input type="text" name="price">
                    <br><br>

                    <label>Old Price:</label>
                    <input type="text" name="old_price">
                    <br><br>

                    <label>Discount percent:</label>
                    <input type="text" name="discount_percent">
                    <br><br>
                </div>
            </div>
            <!-- cột phải -->
            <div class="form-group">
                <div class="form-item">
                    <label>Gift:</label>
                    <input type="text" name="gift">
                    <br><br>

                    <label>Rating:</label>
                    <input type="text" name="rating" placeholder="1->5">
                    <br><br>

                    <label>Sold count:</label>
                    <input type="text" name="sold_count">
                    <br><br>

                    <label>Image: </label>
                    <input type="file" name="image">
                    <br><br>

                    <label>Video url: </label>
                    <input type="text" name="video_url" placeholder="e.g: https://www.youtube.com/embed/djegwb8W73k">
                </div>
            </div>
            <button type="submit" name="btn_Them" class="btn-submit">Thêm</button>
        </form>
    </div>
</body>

</html>