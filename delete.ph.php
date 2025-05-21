<?php
session_start();
require 'db.php';

if ($_SESSION["user_id"] && isset($_GET["image_id"])) {
    $user_id = $_SESSION["user_id"];
    $image_id = $_GET["image_id"];

    //Verificación de propiedad de imagen o privilegios de administrador//
    $sql = "SELECT image_path FROM images WHERE id = ? AND (user_id = ? OR ? = 'admin')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$image_id, $user_id, $_SESSION["role"]]);
    $image = $stmt->fetch();

    if ($image) {
        unlink($image["image_path"]); //Eliminar archivo del servidor//
        $sql = "DELETE FROM images WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$image_id]);
        echo "Imagen eliminada.";
    } else {
        echo "No tienes permiso para eliminar esta imagen.";
    }
}
?>