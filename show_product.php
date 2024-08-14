<?php include 'condb.php' ?>
<?php
require 'config.php';
if(!isset($_SESSION['login_id'])){
    header('Location: login.php');
    exit;
}
$id = $_SESSION['login_id'];
$get_user = mysqli_query($db_connection, "SELECT * FROM `users` WHERE `google_id`='$id'");
if(mysqli_num_rows($get_user) > 0){
    $user = mysqli_fetch_assoc($get_user);
}
else{
    header('Location: logout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Product</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-text {
            color: purple;
            /* เปลี่ยนสีเป็นม่วงหรือสีที่คุณต้องการ */
            font-family: 'Your Desired Font', sans-serif;
          
        }
        .font {
            color: white;
        }
        body {
            background-color:#131509;
        }

    </style>

</head>

<body>
    <?php include 'menu.php' ?>

    <div class="container">
        <br><br>
        <div class="row">
            <h2 class="text-center fw-bolder mt-10 font"> WRISTWATCH PRODUCT </h2>
            <?php
            $sql = "SELECT * FROM product ORDER BY pro_id";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
            ?>

                <div class="col-sm-4 ">
                    <div class="text-center fw-normal mt-10">
                        <?php
                        $image = "img/" . $row['image'];
                        if (file_exists($image)) {
                            echo "<img src=\"$image\" width=\"300px\" height=\"300px\" class=\"mt-5 p-2 my-2 border rounded\">";
                        } else {
                            echo "รูปภาพไม่พบ";
                        }
                        ?>
                        <br>
                        <!-- ID:<?= $row['pro_id'] ?> <br> -->
                        <h6 class=" fw-bolder custom-text"><?= $row['pro_name'] ?> <br></h6>
                        <h6 class="font">ราคา<span class="text-danger fw-bold"> <?= $row['price'] ?></span> บาท</h6> <br>
                        <a class="btn btn-outline-warning mt-2" href="sh-pd-detial.php?id=<?= $row['pro_id'] ?>"> รายละเอียด </a>
                    </div>
                    <br><br>
                </div>

            <?php
            }
            mysqli_close($conn);
            ?>

        </div>
    </div>





    <!-- Bootstrap JS -->
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>