<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Method Not Allowed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #f8f9fa;
        }

        h1 {
            font-size: 2.5em;
            color: #e74c3c;
        }

        p {
            font-size: 1.2em;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>405 Method Not Allowed</h1>
    <p>The request method is not supported by this server</p>
    <p><a href="<?= BASE_URL; ?>/">Go back to home</a></p>
</body>

</html>