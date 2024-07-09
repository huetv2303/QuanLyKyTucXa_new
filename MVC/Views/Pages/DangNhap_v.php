<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>
<style>
    body {
        background-color: #f7b49f;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .login-card {
        background-color: #171539;
        color: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    .avatar {
        margin-bottom: 20px;
    }

    .avatar img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    h2 {
        margin: 10px 0;
    }

    p {
        margin: 10px 0 20px;
        font-size: 14px;
        color: #bbb;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        color: #bbb;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #252b56;
        color: white;
    }

    .forgot-password {
        text-align: right;
        margin-bottom: 20px;
    }

    .forgot-password a {
        color: #d8b4e2;
        text-decoration: none;
        font-size: 12px;
    }

    .forgot-password a:hover {
        text-decoration: underline;
    }

    .btn {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #bb86fc;
        color: white;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #a676e5;
    }

    .signup-link {
        margin-top: 20px;
        font-size: 14px;
    }

    .signup-link a {
        color: #bb86fc;
        text-decoration: none;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }
    .success-message {
    color: green;
    font-weight: bold;
    margin-top: 10px;
}

</style>

<body>
    <!-- <form action="http://localhost/qlktx_test/DangNhap/Authenticate" method="POST">
        Email input
        <div>
            <input type="text" name="email" id="email" required />
            <label for="email">Email address</label>
        </div>
        
       Password input 
        <div>
            <input type="password" id="password" name="password" required />
            <label for="password">Password</label>
        </div>

        Submit button 
        <button type="submit">Sign in</button>
        
        <?php if (isset($data['error'])) : ?>
            <p><?php echo $data['error']; ?></p>
        <?php endif; ?>
    </form> -->
    <div class="login-container">
        <div class="login-card">
            <div class="avatar">
                <img src="https://utt.edu.vn/home/images/stories/logo-utt-border.png" alt="Avatar">
            </div>
            <h2>WELCOME</h2>
            <p>Đăng nhập thông tin của bạn ở bên dưới!</p>
            <form action="http://localhost/QuanLyKyTucXa_new/DangNhap/Authenticate" method="POST">
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="username" id="username" required value="admin">
                    <!-- <input type="text" name="username" id="username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"> -->
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" required value="123456">
                    <!-- <input type="password" id="password" name="password" required value="<?php echo isset($POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?> "> -->
                </div>
                <button type="submit" class="btn">Đăng nhập</button>
                <?php if (isset($data['error'])) : ?>
                    <p style="color: dark;"><?php echo $data['error']; ?></p>
                <?php endif; ?>
             
            </form>
        </div>
    </div>


</body>

</html>