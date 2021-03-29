<?php
$pdo = new PDO(
		'mysql:host=localhost;dbname=bddp14;',
		'root',
		'',
		array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
	);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

$sql = "SELECT * FROM admins";
$pre = $pdo->prepare($sql);
$pre->execute();
$data = $pre->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM admins";
$pre = $pdo->prepare($sql);
$pre->execute();
$data = $pre->fetchAll(PDO::FETCH_ASSOC);
