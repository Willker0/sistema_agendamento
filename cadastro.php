<?php
require "config.php";

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if (!$nome || !$email || !$senha) {
    echo "erro";
    exit;
}

// checar se email já existe
$check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$r = $check->get_result();
if ($r->num_rows > 0) {
    echo "email_existe";
    exit;
}

$hash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $hash);

if ($stmt->execute()) {
    echo "ok";
} else {
    echo "erro";
}
?>
