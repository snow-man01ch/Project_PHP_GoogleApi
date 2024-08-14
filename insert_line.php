<?php
session_start();
include 'condb.php';
    $cusName=$_POST['cus_name'];
    $cusAddress=$_POST['cus_add'];
    $cusTel=$_POST['cus_tel'];

    $sql="insert into tb_order(cus_name,address,telephone,total_price,order_status)
    values('$cusName','$cusAddress','$cusTel','" . $_SESSION["sum_price"] . "','1')";
    mysqli_query($conn,$sql);

    $orderID = mysqli_insert_id($conn);
    $_SESSION["order_id"] = $orderID;

    for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
        if (isset($_SESSION["strProductID"][$i]) && $_SESSION["strProductID"][$i] != "") {
            //ดึงข้อมูลสินค้า
            $sql1="select * from product where pro_id ='" . $_SESSION["strProductID"][$i] . "' ";
            $result1=mysqli_query($conn,$sql1);
            $row1=mysqli_fetch_array($result1);
            $price = $row1['price']; 
            $qty = isset($_SESSION["strQty"][$i]) ? intval($_SESSION["strQty"][$i]) : 0;
            $total = $qty * $price;

            

            $sql2="insert into order_detail(orderID,pro_id,orderPrice,orderQty,Total)
            values('$orderID','" .$_SESSION["strProductID"][$i] . "','$price',
            '" . $_SESSION["strQty"][$i] . "','$total')";

            if(mysqli_query($conn,$sql2)){
                //ตัดสต็อกสินค้า
                $sql3="update product set amount= amount - '". $_SESSION["strProductID"][$i] . "'
                where pro_id='". $_SESSION["strProductID"][$i] . "'";
                mysqli_query($conn,$sql3);
                // echo "<script> alert('บันทึกข้อมูลเรียบร้อยแล้ว') </script>";
                echo "<script> window.location = 'print_order.php';</script>";
            }
        }

    }
    //------line notify-------
    if(isset($_POST['submit'])){
        $date = date("d-m-y");
    
        $sToken = "rEid5RMv0W0M0novlXn8SQwUKTn77OG5klhCr7cKFZV";
        $sMessage .= "วันที่". $date . "\n";
        $sMessage .= "มีรายการสั่งซื้อสินค้า \n";
        $sMessage .= "เลขที่ใบสั่งซื้อ: " . $_SESSION["order_id"] . " \n";
        $sMessage .= "ชื่อลูกค้า: ". $cusName ."\n";
        $sMessage .= "ที่อยู่: ". $cusAddress."\n";
        $sMessage .= "เบอร์โทรศัพท์: ". $cusTel ."\n";
    
        
        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 
     
        if($result){
            $_SESSION['success'] = "ชำระเงินสำเร็จ";
            header("location: print_order.php");
        }else{
            $_SESSION['success'] = "ชำระเงินผิดพลาด";
            header("location: print_order.php");
        }
        curl_close( $chOne ); 
    }

    mysqli_close($conn);
    unset($_SESSION["intLine"]);
    unset($_SESSION["strProductID"]);
    unset($_SESSION["strQTY"]);
    unset($_SESSION["sum_price"]);
?>