<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Product - SHOP</title>


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


        /* NAVBAR */

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


        nav a {
            color: white;

            text-decoration: none;

            padding: 8px 14px;

            border-radius: 8px;
        }


        nav a:hover {
            background: rgba(255,255,255,0.15);
        }


        /* CARD */

        .container {
            width: 90%;

            max-width: 600px;

            margin: 45px auto;

            background: white;

            padding: 35px;

            border-radius: 20px;

            box-shadow: 0 8px 25px rgba(118, 83, 166, 0.10);
        }


        h1 {
            margin: 0;

            color: #7653a6;

            font-size: 27px;
        }


        .subtitle {
            color: #888;

            font-size: 14px;

            margin-bottom: 25px;
        }


        /* FORM */

        .form-group {
            margin-bottom: 18px;
        }


        label {
            display: block;

            margin-bottom: 7px;

            color: #65458f;

            font-weight: bold;

            font-size: 14px;
        }


        input,
        textarea {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #ddd;

            border-radius: 10px;

            font-size: 14px;

            outline: none;

            font-family: Arial, sans-serif;
        }


        textarea {
            min-height: 110px;

            resize: vertical;
        }


        input:focus,
        textarea:focus {
            border-color: #8e6bbf;

            box-shadow: 0 0 0 3px rgba(142,107,191,0.12);
        }


        /* BUTTON AREA */

        .button-group {
            display: flex;

            gap: 10px;

            margin-top: 25px;
        }


        .btn {
            flex: 1;

            padding: 12px 18px;

            border-radius: 10px;

            text-align: center;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;

            border: none;

            cursor: pointer;

            transition: 0.2s;
        }


        .btn-save {
            background: #d98fc5;

            color: white;
        }


        .btn-save:hover {
            background: #c779b2;

            transform: translateY(-1px);
        }


        .btn-cancel {
            background: #eee5fa;

            color: #7653a6;
        }


        .btn-cancel:hover {
            background: #e1d4f3;
        }


        /* ERROR */

        .error {
            background: #ffe8f0;

            color: #b34b70;

            padding: 12px;

            border-radius: 10px;

            margin-bottom: 20px;

            font-size: 14px;
        }

    </style>

</head>


<body>


<nav>

    <div class="logo">
        SHOP
    </div>


    <a href="<?= site_url('/products'); ?>">
        Products
    </a>

</nav>


<div class="container">


    <h1>
        Add Product
    </h1>


    <p class="subtitle">
        Add a new product to your inventory
    </p>


    <?php if (!empty($error)): ?>

        <div class="error">

            <?= htmlspecialchars($error); ?>

        </div>

    <?php endif; ?>


    <form
        method="POST"
        action="<?= site_url('/products/create'); ?>"
    >


        <div class="form-group">

            <label for="product_name">
                Product Name
            </label>

            <input
                type="text"
                id="product_name"
                name="product_name"
                placeholder="Enter product name"
                required
            >

        </div>


        <div class="form-group">

            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
                placeholder="Enter product description"
                required
            ></textarea>

        </div>


        <div class="form-group">

            <label for="price">
                Price
            </label>

            <input
                type="number"
                id="price"
                name="price"
                step="0.01"
                min="0"
                placeholder="0.00"
                required
            >

        </div>


        <div class="form-group">

            <label for="quantity">
                Quantity
            </label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                min="0"
                placeholder="Enter quantity"
                required
            >

        </div>


        <div class="button-group">

            <a
                href="<?= site_url('/products'); ?>"
                class="btn btn-cancel"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="btn btn-save"
            >
                Add Product
            </button>

        </div>


    </form>

</div>


</body>

</html>