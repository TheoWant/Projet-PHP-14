<?php require_once "config.php"; ?>

<?php
    if (isset($_POST['pseudo'], $_POST['comment'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $comment = htmlspecialchars($_POST['comment']);
    $id = htmlspecialchars($_POST['id']);
    $ins = $pdo->prepare('INSERT INTO comments (poster_name, content, article_id)
    VALUES (:pseudo, :comment, :id)');
    $ins->bindParam(':pseudo', $pseudo, PDO::PARAM_STR, 20);
    $ins->bindParam(':id', $id, PDO::PARAM_INT);
    $ins->bindParam(':comment', $comment, PDO::PARAM_STR, 300);
    $ins->execute();
  }
  ?>