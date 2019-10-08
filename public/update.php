<?php
require_once '../connec.php';

$pdo = new PDO(DSN, USER, PASS);
$id = $_GET['id'] ?? $_POST['id'] ?? '';

$statement = $pdo->prepare("SELECT * FROM article WHERE id=:id");
$statement->bindValue(':id', $id, PDO::PARAM_INT);

$statement->execute();

$article = $statement->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // clean $_POST
    $data = array_map('trim', $_POST);

    // validate data
    $errors = [];
    if (empty($data['title'])) {
        $errors['title'][] = 'Le champ ne doit etre vide';
    }
    if (empty($data['author'])) {
        $errors['author'][] = 'L\'auteur ne doit etre vide';
    }
    if (empty($data['content'])) {
        $errors['content'][] = 'Le contenu ne doit etre vide';
    }
    if($data['title'] > 255) {
         $errors['title'][] = 'Le titre ne doit pas depasser 255 caractères';
    }
    if(empty($article)) {
        $errors['article'][] = 'L\article pour cet id n\'existe pas';
    }

    // if no error
    if (empty($errors)) {
        // UPDATE request
        $query = "UPDATE article SET title=:title, author=:author, content=:content WHERE id=:id";

        $statement = $pdo->prepare($query);
        $statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $statement->bindValue(':author', $data['author'], PDO::PARAM_STR);
        $statement->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $statement->bindValue(':id', $data['id'], PDO::PARAM_INT);

        $statement->execute();

        // redirection
        header('Location: article.php?id='. $data['id'].'&success=ok');
        exit();
    }
}

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
    <title>update article</title>
</head>
<body>
<h1>Update article <?= htmlentities($article['title']) ?></h1>

<main class="container">
    <div class="row">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $article['id'] ?>">

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" id="title" name="title" value="<?= $article['title'] ?>"/>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input class="form-control" type="text" id="author" name="author" value="<?= $article['author'] ?>"/>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content"><?= $article['content'] ?></textarea>
            </div>

            <button class="btn btn-success">Add article</button>
        </form>

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