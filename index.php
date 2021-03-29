<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css" />
</head>

<body id="PageConnexion">
  <?php require_once "config.php"; ?>

  <aside>
    <h1>Connexion admin</h1>
    <form method="post" action="login.php">
      <input type='email' name='email' placeholder="email"/>
      <input type='password' name='password' placeholder="Mot de passe"/>
      <input type='submit' value='Connexion'/>
    </form>
  </aside>

  <hr>

  <?php
  session_start();
  $_SESSION;
  $articles = $pdo->query('SELECT *, a.id as aid FROM articles a LEFT JOIN countries c ON c.id = a.country_id');
  $articles = $articles->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <!DOCTYPE html>
  <html lang="fr" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <header>
  </header>

  <body>
    <h1>Bienvenue !</h1>
    <hr>
    <?php foreach ($articles as $article) {
    ?>
      <h2><?= $article['title'] ?></h2>
      <h2><?= $article['name'] ?></h2>
      <h3><?= $article['content'] ?></h3> <br> <img src="<?= $article['image'] ?> " width=500px>
      <br>
      <h1>Laisser un commentaire</h1>
      <form method="post" action="envoie.php">
        <input type='hidden' name="id" value="<?php echo $article['aid'] ?>"/>
        <input type='text' name='pseudo' placeholder="Nom ou Pseudonyme" />
        <textarea name='comment' placeholder="Commentaire"></textarea>
        <input type='submit' value='Envoyer' />

      </form>
      <hr>
    <?php } ?>
  </body>

  </html>