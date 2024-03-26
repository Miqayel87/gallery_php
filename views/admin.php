<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: right;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout-btn {
            background-color: #ff6347;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }

        .content {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .art_page {
            color: #f4f4f4;
            font-size: 25px;
            text-decoration: none;
            cursor: pointer;
            padding: 5px 10px;
            border: 2px solid;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <a href="/article/index" class="art_page">Articles Page</a>
        <h1>Admin Dashboard</h1>
        <form method="post" action="<?= BASE_URL ?>auth/logout">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
    <div class="content">
        <p>Welcome to the admin dashboard!</p>
        <p>You can add your dashboard elements and content here.</p>

        <h2>Create Article</h2>
        <form action="<?php echo BASE_URL ?>article/create" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>
            <label for="content">Content:</label><br>
            <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
            <button type="submit">Create</button>
        </form>
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];

            if ($error === 'invalid_input') {
                echo '<p style="color: red;">Invalid input. Title must be at least 3 characters long and content must be at least 8 characters long.</p>';
            } elseif ($error === 'empty_fields') {
                echo '<p style="color: red;">Both title and content are required.</p>';
            }
        }
        ?>
        <h2>Articles</h2>
        <ul>
            <?php foreach ($articles as $article): ?>
                <li>
                    <h3><?php echo $article['title']; ?></h3>
                    <p><?php echo $article['content']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>
</body>
</html>
