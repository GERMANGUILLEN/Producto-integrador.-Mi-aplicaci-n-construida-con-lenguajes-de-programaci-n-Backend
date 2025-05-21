<?php
session_start();
require 'db.php';

if ($_SESSION["user_id"] && isset($_FILES["image"])) {
    $user_id = $_SESSION["user_id"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO images (user_id, image_path) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $target_file]);

        echo "Imagen subida exitosamente.";
    } else {
        echo "Error al subir imagen.";
    }
}
?>