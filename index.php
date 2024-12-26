<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['email'];
    $pass = $_POST['password']; // อย่าแฮชตรงนี้ ให้ใช้ password_verify ในการตรวจสอบ

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();

        // ใช้ password_verify เพื่อเปรียบเทียบรหัสผ่าน
        if (password_verify($pass, $user_data['password'])) {
            $_SESSION['email'] = $user;
            header("Location: dashboard.php"); // เปลี่ยนเส้นทางไปยัง dashboard.php
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error_message = "รหัสผ่านไม่ตรงกัน!";
        $name_input = $name;
        $email_input = $email;
        echo "<script>
            $(document).ready(function() {
                $('#registerModal').modal('show');
            });
        </script>";
    } else {
        $query = "SELECT * FROM Users WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $error_message = "อีเมลนี้มีการลงทะเบียนแล้ว!";
            $name_input = $name;
            $email_input = $email;
            echo "<script>
                $(document).ready(function() {
                    $('#registerModal').modal('show');
                });
            </script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>
                    alert('ลงทะเบียนสำเร็จแล้ว!');
                    window.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>alert('Error: Could not register.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

     <style>
     body {
    font-family: math;
    background-color: #F2F2F2;
    margin: 0;
}

 .container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100vh;
}

.card.login {
    padding: 2.5rem;
    border-radius: 1rem;
}

.card {
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
    width: 80%;
    box-sizing: border-box;
    text-align: center;
    overflow: hidden;
    margin-bottom: 20px;
}

.card p {
    margin: 0px;
    color: #4caf50;
}

h2 {
        padding: 1rem 2rem;
}

input {
       border-radius: 1rem;
    padding: 0.2rem 1rem;
    font-weight: 400;
    border: 1px solid #ced4da;
    margin: 0.7rem;
    width: 80%;
}

input:focus {
    outline: none;
}

.btn {
    width: 40%;
    display: inline-block;
}

.text-right a {
     margin-right: 1.5rem;
}

.form-group input {
    width: 95%;
}

.form-group label {
   margin-left: 1rem;
   margin-bottom: 0px;
}


     </style>
</head>
<body>

 <div class="container">
        <div class="card login" style="max-width: 400px;">
            <h2 class="title text-center">Login</h2>
             <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
             <form method="POST" action="">
                <label for="email"></label>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <label for="password"></label>
                <input type="password" id="password" name="password" placeholder="Password"  required>
                <p class="text-right">
                    <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Forgot password?</a>
                </p>
                <button type="submit" class="btn btn-primary btn-block rounded-pill mt-3">Login</button>
                <p class="text-center mt-3 mb-0">
                    <a href="#" data-toggle="modal" data-target="#registerModal">Don't have an account? Register</a>
                </p>
    </form>
        </div>
    </div>

    <!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm">
                    <div class="form-group">
                        <label for="forgotEmail">กรุณาใส่อีเมล</label>
                        <input type="email" class="form-control rounded-pill" id="forgotEmail" name="forgotEmail" placeholder="Email" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block rounded-pill">ส่งไปยังอีเมล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content registor">
            <div class="modal-header align-items-center">
                <h5 class="modal-title mx-auto" id="registerModalLabel">Register</h5>
            </div>
            <form method="POST" action="">
                <div class="modal-body px-4">
                    <!-- Error Message -->
                    <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <!-- Name Input -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control rounded-pill"
                            placeholder="Enter your name"
                            value="<?php echo isset($name_input) ? htmlspecialchars($name_input) : ''; ?>" required>
                    </div>

                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control rounded-pill"
                            placeholder="Enter your email"
                            value="<?php echo isset($email_input) ? htmlspecialchars($email_input) : ''; ?>" required>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="registerPassword">Password</label>
                        <input type="password" name="password" id="registerPassword" class="form-control rounded-pill"
                            placeholder="Enter your password" required>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirmPassword"
                            class="form-control rounded-pill" placeholder="Confirm your password" required>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer registor">
                <div class="d-flex flex-column align-items-center w-100">
                    <button type="submit" name="register" class="btn btn-primary rounded-pill">Register</button>
   <p class="text-center mt-3">
                        <a href="#" class="login-link" data-dismiss="modal">Have an Account? Login Here</a>
                    </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#forgotPasswordForm').on('submit', function (event) {
            event.preventDefault(); // หยุดการส่งฟอร์มปกติ
            const email = $('#forgotEmail').val();

            // ส่งคำขอ AJAX ไปยัง forgot_password.php
            $.ajax({
                url: 'forgot_password.php', // ไฟล์ PHP สำหรับจัดการลิงก์รีเซ็ตรหัสผ่าน
                type: 'POST',
                data: { email: email },
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message); // แจ้งเตือนเมื่อสำเร็จ
                        $('#forgotPasswordModal').modal('hide');
                    } else {
                        alert(response.message); // แจ้งเตือนเมื่อเกิดข้อผิดพลาด
                    }
                },
                error: function () {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>

</body>

</html>
