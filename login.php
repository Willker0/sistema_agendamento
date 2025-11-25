<?php
require "config.php";
session_start();

$email = $_POST["email"] ?? '';
$senha = $_POST["senha"] ?? '';

if (!$email || !$senha) {
    echo "erro";
    exit;
}

$sql = "SELECT id, nome, senha FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$r = $stmt->get_result();

if ($r->num_rows == 0) {
    echo "erro";
    exit;
}

$u = $r->fetch_assoc();

if (password_verify($senha, $u["senha"])) {
    $_SESSION['id'] = $u['id'];
    $_SESSION['nome'] = $u['nome'];
    echo "ok";
} else {
    echo "erro";
}
?>
