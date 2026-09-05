<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Data</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #F8D7E8, #E9DDF7);
            color: #66536F;
            min-height: 100vh;
        }

        nav {
            height: 65px;
            padding: 0 8%;
            background: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 50px auto;
        }

        .heading {
            margin-bottom: 25px;
        }

        h2 {
            color: #9575B8;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .description {
            color: #77677E;
            font-size: 15px;
        }

        .table-wrapper {
            background: #FFFFFF;
            border: 1px solid #E8D9F0;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 5px 18px rgba(130, 100, 150, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th {
            background: #E9DDF7;
            color: #6F5A80;
            text-align: left;
            padding: 15px 18px;
            font-size: 14px;
            font-weight: 600;
        }

        td {
            padding: 15px 18px;
            border-top: 1px solid #F0E7F4;
            color: #66536F;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #FFF6FA;
        }

        td:first-child {
            color: #B486C5;
            font-weight: 600;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #9A8BA1;
        }

        .back-button {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 20px;
            background: #CDB4E9;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.2s;
        }

        .back-button:hover {
            background: #EFB6D3;
        }

        @media (max-width: 600px) {

            nav {
                padding: 0 5%;
            }

            .container {
                width: 92%;
                margin: 35px auto;
            }

            h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

    <nav>
        <div class="logo">Activity System</div>

        <a href="/">Home</a>
    </nav>

    <div class="container">

        <div class="heading">
            <h2>My Data</h2>

            <p class="description">
                View your registered activity records below.
            </p>
        </div>

        <div class="table-wrapper">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($users)): ?>

                        <?php foreach ($users as $user): ?>

                            <tr>
                                <td><?= html_escape($user['id'] ?? ''); ?></td>
                                <td><?= html_escape($user['firstname'] ?? ''); ?></td>
                                <td><?= html_escape($user['lastname'] ?? ''); ?></td>
                                <td><?= html_escape($user['email'] ?? ''); ?></td>
                                <td><?= html_escape($user['username'] ?? ''); ?></td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="5" class="empty">
                                No users found in the database.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>
            </table>

        </div>

        <a href="/" class="back-button">← Back to Home</a>

    </div>

</body>
</html>