<?php
$page_title = "Login - Inflatoy";
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
                                <i class="bi bi-box-arrow-in-right" style="color: var(--color-primary);"></i> Acesso ao Sistema
                            </h3>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <?php
                        if (isset($_GET['erro'])) {
                            $erro = $_GET['erro'];
                            $mensagem_erro = '';
                            if ($erro == "senha") {
                                $mensagem_erro = "Senha incorreta! Tente novamente.";
                            } elseif ($erro == "usuario_nao_encontrado") {
                                $mensagem_erro = "E-mail não cadastrado.";
                            } elseif ($erro == "dados_insuficientes") {
                                $mensagem_erro = "Preencha todos os campos.";
                            }
                            
                            if ($mensagem_erro) {
                                echo '<div class="alert alert-danger"><i class="bi bi-exclamation-triangle"></i> ' . $mensagem_erro . '</div>';
                            }
                        }
                        ?>

                        <form action="login_exe.php" method="post">
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i> E-mail *
                                </label>
                                <input type="email" class="form-control" name="email" id="email" 
                                       placeholder="seu@email.com" required>
                            </div>

                            <div class="mb-4">
                                <label for="senha" class="form-label">
                                    <i class="bi bi-lock"></i> Senha *
                                </label>
                                <input type="password" class="form-control" name="senha" id="senha" 
                                       placeholder="Sua senha" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-right"></i> Entrar
                                </button>
                            </div>
                        </form>
                        
                        <hr class="divider mt-4">
                        
                        <div class="text-center">
                            <p class="mb-0">Ainda não tem conta? <a href="cadastrar_usuario.php" style="color: var(--color-primary);">Cadastre-se aqui</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>
