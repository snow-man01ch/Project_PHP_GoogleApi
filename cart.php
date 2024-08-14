<?php
session_start();
include 'condb.php';
// $id = $_GET['id'];
// $sql = "SELECT * FROM product WHERE pro_id = '$id' ";
// $result = mysqli_query($conn, $sql);
// $row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .font {
            color: white;
        }

        .red {
            color: #00ab84;
        }

        .nav-color {
            background-color: #ffcf49;
        }

        .text-color {
            color: #000000;
        }

        body {
            background-color: #131509;
        }
        
        
        
    </style>

</head>

<body>
    <?php include 'menu.php' ?>
    <br>
    <br>
    <div class="container">
        <form id="form1" method="POST" action="insert_cart.php">
            <div class="row">
                <div class="col-md-10">
                    <table class="table ">
                        <nav class="navbar navbar-light  fw-bolder  mx-auto" style="background-color: #ffc55b; color: #000000;">
                            ORDER DETAIL
                        </nav>
                </div>
                <tr class="font">
                    <th>NO</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Amout</th>
                    <th>Total</th>
                    <th>เพิ่ม - ลด</th>
                    <th>Delete</th>
                </tr>
                <?php
                $Total = 0;
                $sumPrice = 0;
                $m = 1;

                for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                    if (isset($_SESSION["strProductID"][$i]) && $_SESSION["strProductID"][$i] != "") {
                        $sql1 = "select * from product where pro_id = '" . $_SESSION["strProductID"][$i] . "' ";
                        $result1 = mysqli_query($conn, $sql1);
                        $row_pro = mysqli_fetch_array($result1);

                        if ($row_pro) {
                            $_SESSION["price"] = $row_pro['price'];
                            $Total = $_SESSION["strQty"][$i];

                            if (isset($row_pro['price'])) {
                                $sum = $Total * $row_pro['price'];
                                $sumPrice = $sumPrice + $sum;
                                $_SESSION["sum_price"] = $sumPrice;

                ?>
                                <tr class="font">
                                    <td><?= $m ?></td>
                                    <td>
                                        <img src="img/<?= $row_pro['image'] ?>" width="100" height="100" class="border" style="border-radius: 10px;">
                                        <?= $row_pro['pro_name'] ?>
                                    </td>
                                    <td><?= $row_pro['price'] ?></td>
                                    <td><?= $_SESSION["strQty"][$i] ?></td>
                                    <td><?= $sum ?></td>
                                    <td>
                                        <a href="order.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-info"><strong>+</strong></a>
                                        <?php if ($_SESSION["strQty"][$i] > 1) { ?>
                                            <a href="order_del.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-warning"><strong>-</strong></a>
                                        <?php } ?>
                                    </td>


                                    <td><a href="pro_delete.php?Line=<?= $i ?>"> <img src="img/delete.png" width="30"> </a></td>
                                </tr>
                <?php
                                $m = $m + 1;
                            }
                        }
                    }
                }
                ?>
                <tr>
                    <td class="text-end fw-bolder font" colspan="4">Total Price</td>
                    <td class="red"><?= $sumPrice ?></td>
                    <td class="text-start font">บาท</td>
                </tr>

                </table>
                <div style="text-align: right;">
                    <a href="show_product.php"> <button type="button" class="btn btn-outline-warning">เลือกสินค้า</button> </a>
                    <a href="payment.php"> <button type="button" class="btn btn-outline-warning">ชำระเงิน</button> </a>
                   
                    <!-- <button type="button" class="btn btn-outline-warning">  จ่ายเงิน</button> -->
                      
                            

                           
                       
                    <!-- <button type="submit" name="submit" class="btn btn-outline-info">ยืนยันการสั่งซื้อ</button> -->

                </div>
                <!-- <br>
                <div class="row font">
                    <div class="col-md-7">
                        <div class="alert nav-color" h4 role="alert">
                            <span class="text-color">ข้อมูลสำหรับจัดส่งสินค้า</span>
                        </div>
                        ชื่อ-นามสกุล:
                        <input type="text" name="cus_name" class="form-control" required placeholder="ชื่อ-นามสกุล ..."><br>
                        ที่อยู่จัดส่งสินค้า:
                        <textarea class="form-control" required placeholder="ที่อยู่ ..." name="cus_add" rows="3"></textarea><br>
                        เบอร์โทรศัพท์:
                        <input type="number" name="cus_tel" class="form-control" required placeholder="เบอร์โทรศัพท์ ..."><br>
                        <br><br><br>
                    </div>
                </div>
        </form> -->


    </div>



    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>