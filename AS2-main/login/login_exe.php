<?php
session_start();
require '../bd/conectaBD.php';

// Verifica se recebeu os dados
if (isset($_POST['email']) && isset($_POST['senha'])) {

    // 1. Limpa espaços em branco (Evita erro se copiar/colar com espaço)
    $email_digitado = trim($_POST['email']);
    $senha_digitada = trim($_POST['senha']);

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Falha de conexão: " . $conn->connect_error);
    }

    $sql = "SELECT id_usuario, nome_usuario, senha_hash, nivel_acesso FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_digitado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        
        $usuario = $result->fetch_assoc();
        
        // 3. Verifica a Senha
        if (password_verify($senha_digitada, $usuario['senha_hash'])) {
            
            // Salvar os dados na sessão
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nome'] = $usuario['nome_usuario'];
            $_SESSION['nivel'] = $usuario['nivel_acesso'];
            
            // Sucesso: Vai para o painel
            header("Location: ../painel.php");
            exit();

        } else {
            // Senha errada: Volta pro login
            header("Location: login.php?erro=senha");
            exit();
        }

    } else {
        // Usuário não encontrado: Volta pro login
        header("Location: login.php?erro=usuario_nao_encontrado");
        exit();
    }

    $stmt->close();
    $conn->close();

} else {
    // Se tentar abrir o arquivo direto
    header("Location: login.php");
    exit();
}
?>