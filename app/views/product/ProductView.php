<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Products - SHOP</title>


    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family: Arial, sans-serif;

            background: #f5f0ff;

            color: #333;
        }


        /* =========================
           NAVBAR
        ========================= */

        nav {
            background: #8e6bbf;

            padding: 16px 6%;

            display: flex;

            justify-content: space-between;

            align-items: center;
        }


        .logo {
            color: white;

            font-size: 24px;

            font-weight: bold;
        }


        .nav-links {
            display: flex;

            align-items: center;

            gap: 10px;
        }


        .nav-link {
            color: white;

            text-decoration: none;

            padding: 8px 14px;

            border-radius: 8px;

            font-size: 14px;

            transition: 0.2s;
        }


        .nav-link:hover {
            background: rgba(255,255,255,0.15);
        }


        /* =========================
           MAIN CONTAINER
        ========================= */

        .container {
            width: 90%;

            max-width: 1150px;

            margin: 40px auto;

            background: white;

            padding: 30px;

            border-radius: 20px;

            box-shadow: 0 8px 25px rgba(118, 83, 166, 0.10);
        }


        /* =========================
           HEADER
        ========================= */

        .page-header {
            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;

            margin-bottom: 25px;
        }


        .page-title h1 {
            margin: 0;

            color: #7653a6;

            font-size: 28px;
        }


        .page-title p {
            margin: 6px 0 0;

            color: #888;

            font-size: 14px;
        }


        /* =========================
           BUTTONS
        ========================= */

        .btn {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 6px;

            padding: 10px 16px;

            border-radius: 9px;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;

            cursor: pointer;

            border: none;

            transition: 0.2s;
        }


        /* ADD */

        .btn-add {
            background: #d98fc5;

            color: white;
        }


        .btn-add:hover {
            background: #c779b2;

            transform: translateY(-1px);

            box-shadow: 0 5px 12px rgba(217,143,197,0.25);
        }


        /* EDIT */

        .btn-edit {
            background: #eee5fa;

            color: #7653a6;
        }


        .btn-edit:hover {
            background: #e1d4f3;
        }


        /* DELETE */

        .btn-delete {
            background: #ffe8f0;

            color: #b34b70;
        }


        .btn-delete:hover {
            background: #ffd5e2;
        }


        /* =========================
           TABLE
        ========================= */

        .table-wrapper {
            overflow-x: auto;
        }


        table {
            width: 100%;

            border-collapse: collapse;

            min-width: 750px;
        }


        th {
            background: #eee5fa;

            color: #65458f;

            padding: 14px;

            text-align: left;

            font-size: 13px;
        }


        td {
            padding: 14px;

            border-bottom: 1px solid #eee;

            font-size: 14px;
        }


        tbody tr {
            transition: 0.2s;
        }


        tbody tr:hover {
            background: #faf7ff;
        }


        /* ACTION BUTTONS */

        .actions {
            display: flex;

            gap: 7px;
        }


        /* NOTIFICATION */

        .notification {
            background: #e4f7e8;

            color: #327044;

            padding: 12px 15px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 14px;
        }


        /* EMPTY */

        .empty {
            text-align: center;

            color: #999;

            padding: 30px;
        }


        /* MOBILE */

        @media (max-width: 700px) {

            .container {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;

                align-items: flex-start;
            }

            .btn-add {
                width: 100%;
            }

            nav {
                padding: 15px 5%;
            }

        }

    </style>

</head>


<body>


<!-- NAVBAR -->

<nav>

    <div class="logo">
        SHOP
    </div>


    <div class="nav-links">

        <a
            href="<?= site_url('/products'); ?>"
            class="nav-link"
        >
            Products
        </a>


        <a
            href="<?= site_url('/logout'); ?>"
            class="nav-link"
        >
            Logout
        </a>

    </div>

</nav>


<!-- MAIN -->

<div class="container">


    <?php if (!empty($notification)): ?>

        <div class="notification">

            <?= htmlspecialchars($notification); ?>

        </div>

    <?php endif; ?>


    <!-- HEADER -->

    <div class="page-header">

        <div class="page-title">

            <h1>
                Products
            </h1>

            <p>
                Manage your product inventory
            </p>

        </div>


        <?php if ($user_role === 'admin'): ?>

            <a
                href="<?= site_url('/products/create'); ?>"
                class="btn btn-add"
            >
                + Add Product
            </a>

        <?php endif; ?>

    </div>


    <!-- TABLE -->

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Product Name</th>

                    <th>Description</th>

                    <th>Price</th>

                    <th>Quantity</th>

                    <th>Created At</th>

                    <?php if ($user_role === 'admin'): ?>

                        <th>Actions</th>

                    <?php endif; ?>

                </tr>

            </thead>


            <tbody>

                <?php if (!empty($products)): ?>


                    <?php foreach ($products as $product): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($product['id']); ?>
                            </td>


                            <td>
                                <strong>
                                    <?= htmlspecialchars($product['product_name']); ?>
                                </strong>
                            </td>


                            <td>
                                <?= htmlspecialchars($product['description']); ?>
                            </td>


                            <td>
                                ₱<?= number_format($product['price'], 2); ?>
                            </td>


                            <td>
                                <?= htmlspecialchars($product['quantity']); ?>
                            </td>


                            <td>
                                <?= htmlspecialchars($product['created_at']); ?>
                            </td>


                            <?php if ($user_role === 'admin'): ?>

                                <td>

                                    <div class="actions">

                                        <a
                                            href="<?= site_url('/products/edit/' . $product['id']); ?>"
                                            class="btn btn-edit"
                                        >
                                            Edit
                                        </a>


                                        <a
                                            href="<?= site_url('/products/delete/' . $product['id']); ?>"
                                            class="btn btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this product?');"
                                        >
                                            Delete
                                        </a>

                                    </div>

                                </td>

                            <?php endif; ?>

                        </tr>

                    <?php endforeach; ?>


                <?php else: ?>

                    <tr>

                        <td
                            colspan="7"
                            class="empty"
                        >
                            No products found.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


</body>

</html>