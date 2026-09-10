<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f0ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(118, 83, 166, 0.15);
        }

        .login-title {
            text-align: center;
            color: #7653a6;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .login-subtitle {
            text-align: center;
            color: #999;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #7653a6;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #b99bdd;
            box-shadow: 0 0 0 3px #f0e8fa;
        }

        .login-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: #d98fc5;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .login-button:hover {
            background: #c97db6;
            transform: translateY(-1px);
        }

        .error-message {
            background: #ffe8f0;
            color: #b65b7d;
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="login-card">

        <h1 class="login-title">Welcome</h1>

        <p class="login-subtitle">
            Login to access your product management system
        </p>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?= html_escape($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= site_url('/login') ?>">

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role">Role</label>

                <select id="role" name="role" required>
                    <option value="">Select your role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Login -->
            <button type="submit" class="login-button">
                Login
            </button>

        </form>

        <div class="footer-text">
            Product Management System
        </div>

    </div>

</div>

</body>
</html>