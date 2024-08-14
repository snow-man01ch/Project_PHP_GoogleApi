<?php

$total = $_POST['total'] . '00';

// Omise API Key และ Secret Key
$public_key = 'pkey_test_5yyd0tsd8nddnvof6ix';
$secret_key = 'skey_test_5yyd00jozx3f8g5fu5l';

// สร้าง header สำหรับการติดต่อกับ Omise API
$headers = [
    'Authorization: Basic ' . base64_encode($secret_key . ':'),
    'Content-Type: application/json',
];

// ข้อมูลการทำรายการ
$transaction_data = [
    'amount' => $total, // จำนวนเงินในเซนต์ 
    'currency' => 'thb',
    'card' => $_POST['omiseToken'],
];

// เรียกใช้ Omise API เพื่อทำรายการชำระเงิน
$ch = curl_init('https://api.omise.co/charges');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($transaction_data));

$response = curl_exec($ch);
curl_close($ch);

// แปลงข้อมูล response เป็น array
$response_array = json_decode($response, true);
$status = ($response_array['status']);


if ($status == 'successful') {
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "ชำระเงินสำเร็จ",
         text: "กรุณารอตรวจสอบการชำระเงินจาก ทางร้าน",
         type: "success"
     }, function() {
         window.location = "fr_user_test.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
} else {
    echo '<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';

    echo '<script>
    setTimeout(function() {
     swal({
         title: "เกิดข้อผิดพลาด",
         text: "กรุณาชำระใหม่อีกครั้ง",
         type: "error"
     }, function() {
         window.location = "fr_user_test.php"; //หน้าที่ต้องการให้กระโดดไป
     });
 }, 1000);
</script>';
}
