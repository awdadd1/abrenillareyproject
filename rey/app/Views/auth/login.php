<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://www.allurasalonsuites.com/wp-content/uploads/2020/07/Hair-Barber-Services@2x-1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Move content to the left */
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-left: 130px; /* Create space from the left edge */
        }

        .login-form {
            display: flex;
            flex-direction: column;
        }

        h1 {
            margin-bottom: 25px;
            font-weight: 600;
            color: #333;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .input-group input {
            width: 80%;
            padding: 14px 45px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #007BFF;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
            outline: none;
        }

        .submit-btn {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .register-link {
            margin-top: 15px;
        }

        .register-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php if(session()->getFlashdata('error')): ?>
    <div style="color:red; margin-bottom:15px;">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>
    <div style="color:green; margin-bottom:15px;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
   <div class="container">
  <form method="post" action="<?= base_url('login') ?>" class="login-form">
        <h1>Login</h1>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="submit-btn">Login</button>
        <p class="register-link">Don't have an account? <a href="<?= base_url('register') ?>">Register</a></p>
    </form>
</div>

</body>
</html>
