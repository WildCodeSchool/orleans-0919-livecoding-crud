<?php
require_once '../connec.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $pdo = new PDO(DSN, USER, PASS);
    $statement = $pdo->prepare("DELETE FROM article WHERE id=:id");
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    $statement->execute();

    header('Location: index.php?delete=ok');
    exit();
}
?>
