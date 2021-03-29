<?php
require_once "config.php";
$sql = "SELECT * FROM admins WHERE email='".$_POST['email']."' AND password='".$_POST['password']."'";
$pre = $pdo->prepare($sql);
$pre->execute();
$admins = current($pre->fetchAll(PDO::FETCH_ASSOC));
if(empty($admins)){
     echo "Utilisateur ou mot de passe incorrect !";
}else{
     session_start();
     $_SESSION['admins'] = $admins;
     header('Location:admin.php');
}
