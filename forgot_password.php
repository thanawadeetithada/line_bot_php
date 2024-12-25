use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path_to_phpmailer/PHPMailer.php';
require 'path_to_phpmailer/SMTP.php';
require 'path_to_phpmailer/Exception.php';

include 'config.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format.']);
        exit();
    }

    $sql = "SELECT * FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $update_sql = "UPDATE Users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sss", $token, $expiry, $email);
        $stmt->execute();

        $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'email@gmail.com';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('no-reply@yourwebsite.com', 'Your Website');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the link below to reset your password:<br><br>
                           <a href='$reset_link'>$reset_link</a><br><br>
                           This link will expire in 1 hour.";

            $mail->SMTPDebug = 2; // เปิด Debugging
            $mail->Debugoutput = 'html'; // แสดงผลการดีบักใน HTML

            $mail->send();
            echo json_encode(['status' => 'success', 'message' => 'Password reset email sent.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send email: ' . $mail->ErrorInfo]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email not found.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
