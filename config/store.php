<?php
require 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $media = $_FILES['media']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($media);

    move_uploaded_file($_FILES["media"]["tmp_name"], $target_file);

    $sql = "INSERT INTO posts (title, content, media) VALUES (:title, :content, :media)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'content' => $content, 'media' => $target_file]);

    // header("Location: blog.php");
    header('Location: blog.php?message=Événement ajouté avec succès&status=success');

}
