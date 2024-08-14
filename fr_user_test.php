<?php 
session_start();
include('condb.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line NOtify</title>
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
        h4 {
            color: white;
        }
        
        
        
    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="insert_line.php"> 
            <h4>แจ้งเตือน Line Notify</h4>
            <br>
            <?php if(isset($_SESSION['success'])){ ?>
                    <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success']; 
                    unset($_SESSION['success']);
                ?>
                  </div>
                  <?php } ?>

            <?php if(isset($_SESSION['error'])){ ?>
                    <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                ?>
                  </div>
            <?php } ?>
<br>
                <div class="row font">
                    <div class="col-md-7">
                        <div class="alert nav-color" h4 role="alert">
                            <span class="text-color">กรุณากรอกข้อมูลที่อยู่เพื่อจัดส่งสินค้า</span>
                        </div>
                        ชื่อ-นามสกุล:
                        <input type="text" name="cus_name" class="form-control" required placeholder="ชื่อ-นามสกุล ..."><br>
                        ที่อยู่จัดส่งสินค้า:
                        <textarea class="form-control" required placeholder="ที่อยู่ ..." name="cus_add" rows="3"></textarea><br>
                        เบอร์โทรศัพท์:
                        <input type="number" name="cus_tel" class="form-control" required placeholder="เบอร์โทรศัพท์ ..."><br>
                        <br>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-outline-info">ยืนยันการสั่งซื้อ</button>
        </form>
    </div>
</body>
</html>