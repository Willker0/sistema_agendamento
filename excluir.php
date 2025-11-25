<?php
require "config.php";
session_start();

if (!isset($_SESSION['id'])) {
    echo "erro";
    exit;
}
$id_usuario = $_SESSION['id'];

$id = intval($_POST['id'] ?? 0);
if ($id <= 0) {
    echo "erro";
    exit;
}

$sql = $conn->prepare("DELETE FROM agendamentos WHERE id = ? AND id_usuario = ?");
$sql->bind_param("ii", $id, $id_usuario);

if ($sql->execute()) {
    echo "ok";
} else {
    echo "erro";
}
?>
