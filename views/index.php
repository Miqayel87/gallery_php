<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
<h2>Articles</h2>
<ul>
    <?php foreach ($articles as $article): ?>
        <li>
            <h3><?php echo $article['title']; ?></h3>
            <p><?php echo $article['content']; ?></p>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
