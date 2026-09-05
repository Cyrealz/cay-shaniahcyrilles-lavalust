<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Activity Management System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #E9DDF7, #F8D7E8);
            color: #66536F;
        }

        nav {
            height: 65px;
            padding: 0 8%;
            background: #FFFFFF;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #E8D9F0;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #9A7CBD;
        }

        nav a {
            text-decoration: none;
            color: #9A7CBD;
            font-weight: 600;
        }

        nav a:hover {
            color: #D58BAE;
        }

        .hero {
            min-height: calc(100vh - 65px);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
        }

        .hero-content {
            background: #FFFFFF;
            padding: 50px;
            border-radius: 18px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 8px 25px rgba(130, 100, 150, 0.10);
        }

        h1 {
            font-size: 36px;
            color: #9575B8;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #77677E;
        }

        .data-button {
            display: inline-block;
            padding: 12px 28px;
            background: #CDB4E9;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.2s;
        }

        .data-button:hover {
            background: #EFB6D3;
        }

        @media (max-width: 600px) {
            .hero-content {
                padding: 35px 25px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo">Activity System</div>

        <a href="/users">My Data</a>
    </nav>

    <section class="hero">

        <div class="hero-content">

            <h1>Activity Management System</h1>

            <p>
                Manage and view your activity records
                in one convenient place.
            </p>

            <a href="/users" class="data-button">
                View My Data
            </a>

        </div>

    </section>

</body>
</html>