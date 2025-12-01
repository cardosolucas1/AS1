<?php
$page_title = "Cadastro de Usuário - Inflatoy";
// Conecta ao banco usando seu arquivo existente
require '../bd/conectaBD.php';

$mensagem = '';
$erro = '';

// Se o usuário clicou no botão "Cadastrar" (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Configura o MySQL para avisar se der erro
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $database);
        $conn->set_charset("utf8mb4");

        // Recebe os dados do formulário
        $nome = trim($_POST['nome_usuario'] ?? ''); 
        $email = trim($_POST['email'] ?? '');
        $senha_original = $_POST['senha'] ?? '';

        // Validação: Não deixa salvar se estiver vazio
        if (empty($nome) || empty($email) || empty($senha_original)) {
            throw new Exception("Por favor, preencha todos os campos!");
        }
        
        // Criptografa a senha
        $senha_hash = password_hash($senha_original, PASSWORD_DEFAULT);
        
        // Define nível operador (para o banco aceitar)
        $nivel_acesso = 'operador';

        // Tenta inserir no banco
        $sql = "INSERT INTO usuarios (nome_usuario, email, senha_hash, nivel_acesso) VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $senha_hash, $nivel_acesso);
        $stmt->execute();
        
        // Se funcionou:
        $mensagem = "Cadastro realizado com sucesso! Tente logar agora.";
        $stmt->close();
        $conn->close();

    } catch (mysqli_sql_exception $e) {
        // Se der erro de duplicidade
        if ($e->getCode() == 1062) {
            if (strpos($e->getMessage(), 'email') !== false) {
                $erro = "Erro: Este e-mail já está em uso.";
            } else {
                $erro = "Erro: Já existe um usuário com este nome.";
            }
        } else {
            $erro = "Erro no banco: " . $e->getMessage();
        }
    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}

require_once '../includes/header.php';
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-custom-lg border animate__animated animate__fadeInUp">
                    <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
                        <div class="text-center">
                            <h3 class="mb-0" style="color: var(--color-text);">
                                <i class="bi bi-person-plus" style="color: var(--color-primary);"></i> Novo Usuário
                            </h3>
                            <p class="text-muted mb-0 mt-2">Crie sua conta de acesso</p>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Mensagem de Sucesso -->
                        <?php if ($mensagem): ?>
                            <div class="alert alert-success">
                                <h5><i class="bi bi-check-circle"></i> Sucesso!</h5>
                                <p class="mb-3"><?php echo $mensagem; ?></p>
                                <a href="login.php" class="btn btn-primary w-100">
                                    <i class="bi bi-box-arrow-in-right"></i> Ir para Login
                                </a>
                            </div>
                        <?php endif; ?>

                        <!-- Mensagem de Erro -->
                        <?php if ($erro): ?>
                            <div class="alert alert-danger">
                                <i class="bi bi-exclamation-triangle"></i> <?php echo $erro; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Formulário -->
                        <?php if (!$mensagem): ?>
                            <form method="POST" action="cadastrar_usuario.php">
                                
                                <div class="mb-3">
                                    <label class="form-label"><i class="bi bi-person"></i> Nome Completo *</label>
                                    <input class="form-control" type="text" name="nome_usuario" required 
                                           value="<?php echo isset($nome) ? htmlspecialchars($nome) : ''; ?>"
                                           placeholder="Seu nome completo">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label"><i class="bi bi-envelope"></i> E-mail *</label>
                                    <input class="form-control" type="email" name="email" required 
                                           value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                                           placeholder="seu@email.com">
                                </div>

                                <div class="mb-4">
                                    <label class="form-label"><i class="bi bi-lock"></i> Senha *</label>
                                    <input class="form-control" type="password" name="senha" required 
                                           placeholder="Mínimo 6 caracteres" minlength="6">
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" type="submit">
                                        <i class="bi bi-check-circle"></i> Cadastrar
                                    </button>
                                </div>
                            </form>
                            
                            <hr class="divider mt-4">
                            
                            <div class="text-center">
                                <p class="mb-0">Já tem uma conta? <a href="login.php" style="color: var(--color-primary);">Faça Login</a></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>
