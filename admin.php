<?php
require_once "config.php";
?>
<?php
session_start();
if (isset($_GET['supprime']) and !empty($_GET['supprime'])) {
  $supprime = (int) $_GET['supprime'];

  $req = $pdo->prepare('DELETE FROM articles WHERE id=?');
  $req->execute(array($supprime));
}

$articles = $pdo->query('SELECT * FROM articles ORDER BY id ASC');

if (isset($_POST['article_title'], $_POST['article_content'])) {
  if (!empty($_POST['article_title']) and !empty($_POST['article_content']) and !empty($_POST['article_date'])) {
    $article_title = htmlspecialchars($_POST['article_title']);
    $article_content = htmlspecialchars($_POST['article_content']);
    $article_image = htmlspecialchars($_POST['article_image']);
    $article_date = htmlspecialchars($_POST['article_date']);
    $article_admin = htmlspecialchars($_POST['article_admin']);
    $article_country = htmlspecialchars($_POST['article_country']);

    $ins = $pdo->prepare('INSERT INTO articles (title, content, image, date, admin_id, country_id, date_publication)
    VALUES (?, ?, ?, ?, ?, ?, NOW())');
    $ins->execute(array($article_title, $article_content, $article_image, $article_date, $article_admin, $article_country));
  }
}


if (!empty($_POST['name_country'])) {
  $name_country = htmlspecialchars($_POST['name_country']);
  $admin_id = htmlspecialchars($_POST['admin_id']);

  $ins = $pdo->prepare('INSERT INTO countries (name, admin_id)
  VALUES (?, ?)');
  $ins->execute(array($name_country, $admin_id));
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css" />
  <title>Admin</title>
</head>
<header>
  <nav>
    <ul>
      <li><a href="index.php" target="_self">Retour Accueil</a></li>
    </ul>
  </nav>
</header>
<hr>

<body id="PageInscription">
  <h2>Supprimer Articles:</h2>
  <?php while ($article = $articles->fetch()) { ?>
    <h3><?= $article['id'] ?> : <?= $article['title'] ?> - <a href="admin.php?supprime=<?= $article['id'] ?>">Supprimer</a><?php } ?></h3>

    <hr>
    <h2>Ajouter Articles:</h2>
    <form method="POST">
      <input type="text" name="article_title" placeholder="Titre">
      <input type="text" name="article_content" placeholder="Description">
      <input type="text" name="article_image" placeholder="Image">
      <input type="text" name="article_country" placeholder="id du pays">
      <input type="date" name="article_date" placeholder="Date">
      <input type="text" name="article_admin" placeholder="Id de l'admin">
      <input type="submit" value="Valider">
    </form>

    <hr>
    <h2>Ajouter Pays:</h2>
    <form method="POST">
      <input type="text" name="name_country" placeholder="Nom du pays">
      <input type="text" name="admin_id" placeholder="Id de l'admin">
      <input type="submit" value="Valider">
    </form>
</body>

</html>