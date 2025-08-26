<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>


<body>
    <h1>Đây là trang logout</h1>

    <?php 
        include "../DB/connect.php";
        include "../config.php";
        session_start();

        if(isset($_SESSION["mySession"])) {
            unset($_SESSION["mySession"]);
            header("location: " . BASE_URL . "auth/login.php");
        }


    ?>

</body>

</html>