<?php include 'condb.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Product Detail</title>
    <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-text {
            color: purple;
          
            font-family: 'Your Desired Font', sans-serif;
          
        }
        .text {
            color: white;
        }
        .font {
            color: #ffcf49;
        }
        body {
            background-color:#131509;
        }

    </style>
</head>

<body>
<?php include 'menu.php' ?>
    <div class="container">
        <div class="row">
            <?php
            $ids =$_GET['id'];
            $sql = "SELECT * FROM product, types WHERE  product.type_id= types.type_id and  product.pro_id ='$ids' ";
            $result = mysqli_query($conn,$sql);        
            $row = mysqli_fetch_array($result);

            ?>
            
            <div class="col-md-4">
            <?php
            $image = "img/" . $row['image']; 
                    if (file_exists($image)) {
                        echo "<img src=\"$image\" width=\"350px\" height=\"350px\" class=\"mt-3 p-2 my-2 border rounded\">";
                    } else {
                        echo "รูปภาพไม่พบ";
                    }
                    ?>
            </div>
            
            <div class="col-md-6 mt-5">
                <!-- ID : <?=$row['pro_id'] ?> <br> -->
                <h6 class="custom-text fw-bolder "><?= $row['pro_name'] ?> <br></h6> <br>
               <strong class="font"> ประเภทสินค้า :</strong> <span class="text"><?=$row['type_name']?></span> <br><br>
               <strong class="font"> รายละเอียด :</strong> <span class="text"><?= $row['detail'] ?></span>   <br><br>
               <strong class="font"> ราคา <span class="text-danger fw-bold"> <?= $row['price'] ?></span> บาท</strong> <br>
                <a  class="btn btn-outline-success mt-3" href="order.php?id=<?=$row['pro_id'] ?>"> Add cart</a>        

            </div>
    </div>
    </div>
        <?php
            mysqli_close($conn);
        ?>





    <!-- Bootstrap JS -->
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>