<?php 
session_start();
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" href="styles/examples.css">
  <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .content {
      text-align: center;
    }
    .nav {
      text-align: center;
      color: white;
    }
    .nav {
            position: relative;
            width: 200px;
            height: 50px;
            background-color:#ffcf49;
            margin: auto;
            font-weight: bolder;
            color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 20px;
            box-shadow: 0px 2px 5px #fff;
            z-index: 1;
        }
        
    body {
            
            background-color: #000000;
        }

        
  </style>
</head>
<body>
<?php include 'menu.php' ?>
    <br>
    <br>
    <div class="nav">
    <?php
  $total = $_SESSION["sum_price"];
  echo 'จำนวนเงิน : '.$total .' บาท';
  ?>
    </div>
  <div class="form">

    <h1></h1>

    <form name="checkoutForm" method="POST" action="pay.php" class="content">
      
      <script type="text/javascript" src="https://cdn.omise.co/omise.js"
              data-key="pkey_test_5yyd0tsd8nddnvof6ix"
              data-image="https://cdn.omise.co/assets/dashboard/images/omise-logo.png"
              data-amount="<?php echo $total; ?>00"
              data-currency="thb"
              data-button-label="ยืนยันการชำระเงิน"
              data-frame-label="SADMAN STORE"
              data-submit-label="ชำระเงิน"
		data-other-payment-methods="promptpay">
      </script>
      <input type="hidden" name="total" value="<?php echo $total; ?>">
    </form>

  </div>
  <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>

