<?php
require "config.php";
session_start();

if (!isset($_SESSION['id'])) {
    echo "erro";
    exit;
}

$id_usuario = $_SESSION['id'];

$titulo = $_POST["titulo"] ?? '';
$cliente = $_POST["cliente"] ?? '';
$data = $_POST["data"] ?? '';
$inicio = $_POST["inicio"] ?? '';
$fim = $_POST["fim"] ?? '';
$local = $_POST["local"] ?? '';
$status = $_POST["status"] ?? '';
$obs = $_POST["observacoes"] ?? '';
$servico = $_POST["titulo"] ?? $titulo;

if (!$data || !$inicio) {
    echo "erro";
    exit;
}

// checar conflito para o mesmo usuário no mesmo dia/hora
$check = $conn->prepare("SELECT id FROM agendamentos WHERE data_agendamento = ? AND hora_agendamento = ? AND id_usuario = ?");
$check->bind_param("ssi", $data, $inicio, $id_usuario);
$check->execute();
$re = $check->get_result();

if ($re->num_rows > 0) {
    echo "ocupado";
    exit;
}

$sql = $conn->prepare("INSERT INTO agendamentos (titulo, cliente_nome, servico_nome, data_agendamento, hora_agendamento, fim, local, observacoes, status, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$sql->bind_param("ssssssssi", $titulo, $cliente, $servico, $data, $inicio, $fim, $local, $obs, $status, $id_usuario);

if ($sql->execute()) {
    echo "ok";
} else {
    echo "erro";
}
?>
