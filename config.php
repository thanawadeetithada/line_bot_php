<?php
// ข้อมูลเชื่อมต่อฐานข้อมูล
$host = "localhost"; // ชื่อโฮสต์ฐานข้อมูล
$username = "root";  // ชื่อผู้ใช้งานฐานข้อมูล
$password = "";    // รหัสผ่านฐานข้อมูล
$database = "linebot"; // ชื่อฐานข้อมูล

// สร้างการเชื่อมต่อ
$conn = new mysqli($host, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>