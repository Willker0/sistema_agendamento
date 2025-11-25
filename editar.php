<?php
require "config.php";
session_start();

if (!isset($_SESSION['id'])) {
    echo "erro";
    exit;
}
$id_usuario = $_SESSION['id'];

$id = intval($_POST['id'] ?? 0);
$titulo = $_POST["titulo"] ?? '';
$cliente = $_POST["cliente"] ?? '';
$servico = $_POST["servico"] ?? '';
$data = $_POST["data"] ?? '';
$inicio = $_POST["inicio"] ?? '';
$fim = $_POST["fim"] ?? '';
$local = $_POST["local"] ?? '';
$status = $_POST["status"] ?? '';
$obs = $_POST["observacoes"] ?? '';

if ($id <= 0) {
    echo "erro";
    exit;
}

$sql = $conn->prepare("UPDATE agendamentos SET titulo=?, cliente_nome=?, servico_nome=?, data_agendamento=?, hora_agendamento=?, fim=?, local=?, observacoes=?, status=? WHERE id=? AND id_usuario=?");
$sql->bind_param("ssssssssiii", $titulo, $cliente, $servico, $data, $inicio, $fim, $local, $obs, $status, $id, $id_usuario);

if ($sql->execute()) {
    echo "ok";
} else {
    echo "erro";
}
?>
