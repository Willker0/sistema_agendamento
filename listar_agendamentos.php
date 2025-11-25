<?php
require "config.php";
session_start();

if (!isset($_SESSION['id'])) {
    echo json_encode([]);
    exit;
}
$id_usuario = $_SESSION['id'];

$stmt = $conn->prepare("SELECT * FROM agendamentos WHERE id_usuario = ? ORDER BY data_agendamento, hora_agendamento");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$lista = array();
while ($l = $result->fetch_assoc()) {
    $lista[] = $l;
}

echo json_encode($lista);
?>
