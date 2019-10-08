<?php
require_once '../connec.php';

$pdo = new PDO(DSN, USER, PASS);
$statement = $pdo->query('SELECT * FROM article');
$articles = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>mon super blog</title>
</head>
<body>
<h1>Mon super blog</h1>

<main class="container">
    <?php if (!empty($_GET['success'])) : ?>
        <div class="alert alert-success">L'article a bien été ajouté</div>
    <?php endif; ?>
    <?php if (!empty($_GET['delete'])) : ?>
        <div class="alert alert-danger">L'article a bien été supprimé</div>
    <?php endif; ?>
    <div class="row mb-3">
        <a class="btn btn-primary" href="add.php">Add an article</a>
    </div>
    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title"><?= htmlentities($article['title']) ?></h2>
                        <p class="card-text"><?= htmlentities($article['author']) ?></p>
                        <a class="btn btn-link" href="article.php?id=<?= $article['id'] ?>" class="card-link">Show article</a>
                        <a class="btn btn-info" href="update.php?id=<?= $article['id'] ?>" class="card-link">Update article</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>