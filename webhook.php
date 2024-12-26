<?php
// ตั้งค่า Response Code 200 เพื่อยืนยันว่า Webhook ทำงาน
http_response_code(200);

// บันทึกข้อมูลที่ได้รับจาก Webhook (สำหรับตรวจสอบ)
$data = file_get_contents("php://input");
error_log($data); // ข้อมูลนี้จะถูกบันทึกใน Log ของเซิร์ฟเวอร์

// ตอบกลับข้อความกลับไป
echo json_encode(["status" => "Webhook received"]);
?>
