<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Full-screen container */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        /* Box styles */
        .login-box {
            background-color: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        /* Header style */
        h2 {
            color: #0066cc;
            margin-bottom: 20px;
        }

        /* Textbox styles */
        .textbox {
            margin-bottom: 20px;
        }

        .textbox input {
            width: 100%;
            padding: 12px;
            border: 2px solid #0066cc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
        }

        .textbox input:focus {
            border-color: #004d99;
        }

        /* Submit button styles */
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #004d99;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>

            <!-- Tampilkan pesan error jika ada -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login/authenticate') ?>" method="POST">
                <div class="textbox">
                    <input type="text" placeholder="Username" name="username" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <input type="submit" value="Login" class="btn">
            </form>
        </div>
    </div>
</body>
</html>
