<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $media = $_FILES['media']['name'];

    if ($media) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($media);
        move_uploaded_file($_FILES["media"]["tmp_name"], $target_file);
        $sql = "UPDATE posts SET title = :title, content = :content, media = :media WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $title, 'content' => $content, 'media' => $target_file, 'id' => $id]);
    } else {
        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);
    }

    header("Location: blog.php");
}
