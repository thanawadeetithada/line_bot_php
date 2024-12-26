<?php
// LINE Messaging API credentials
$channelAccessToken = 'YOUR_CHANNEL_ACCESS_TOKEN';
$channelSecret = 'YOUR_CHANNEL_SECRET';

// รับ Webhook Event
$request = file_get_contents("php://input");
$requestArray = json_decode($request, true);

// ตรวจสอบว่ามี Event หรือไม่
if (isset($requestArray['events'][0])) {
    $event = $requestArray['events'][0];

    // ตรวจสอบประเภท Event
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
        $replyToken = $event['replyToken'];
        $userMessage = $event['message']['text'];

        // สร้างข้อความตอบกลับ
        $responseMessage = "คุณส่งข้อความว่า: " . $userMessage;

        // ส่งข้อความกลับไป
        replyMessage($replyToken, $responseMessage, $channelAccessToken);
    }
}

// ฟังก์ชันสำหรับส่งข้อความ
function replyMessage($replyToken, $message, $accessToken) {
    $apiUrl = 'https://api.line.me/v2/bot/message/reply';

    // ข้อมูลที่ต้องการส่ง
    $postData = [
        'replyToken' => $replyToken,
        'messages' => [[
            'type' => 'text',
            'text' => $message
        ]]
    ];

    // ตั้งค่า HTTP Header
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
    ];

    // ใช้ cURL ในการส่งข้อมูล
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    $result = curl_exec($ch);
    curl_close($ch);

    // ตรวจสอบผลลัพธ์
    if ($result) {
        error_log("Reply Success: " . $result);
    } else {
        error_log("Reply Error");
    }
}
?>
