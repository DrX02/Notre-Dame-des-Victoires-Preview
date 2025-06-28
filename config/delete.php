<?php
require 'config.php';

$id = $_GET['id'];
$sql = 'DELETE FROM posts WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

// header("Location: blog.php");
header('Location: blog.php?message=Événement supprimé avec succès&status=success');
