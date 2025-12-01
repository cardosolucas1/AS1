<?php
$page_title = "Painel Administrativo - Inflatoy";
require_once 'bd/verifica_sessao.php';
require_once 'bd/conectaBD.php';

$nome_usuario = $_SESSION['nome'];
$nivel_acesso = $_SESSION['nivel'];

// Contar registros
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");

$sql_usuarios = "SELECT COUNT(*) as total FROM usuarios";
$result_usuarios = $conn->query($sql_usuarios);
$total_usuarios = $result_usuarios->fetch_assoc()['total'];

$sql_brinquedos = "SELECT COUNT(*) as total FROM brinquedos WHERE ativo = 1";
$result_brinquedos = $conn->query($sql_brinquedos);
$total_brinquedos = $result_brinquedos->fetch_assoc()['total'];

$sql_reservas = "SELECT COUNT(*) as total FROM reservas";
$result_reservas = $conn->query($sql_reservas);
$total_reservas = $result_reservas->fetch_assoc()['total'];

$sql_categorias = "SELECT COUNT(*) as total FROM categorias";
$result_categorias = $conn->query($sql_categorias);
$total_categorias = $result_categorias->fetch_assoc()['total'];

// Buscar usuários para listagem
$sql = "SELECT id_usuario, nome_usuario, email, nivel_acesso FROM usuarios ORDER BY nome_usuario";
$result = $conn->query($sql);
$conn->close();

require_once 'includes/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-speedometer2"></i> Painel de Controle</h2>
        <div>
            <span class="badge bg-primary">Olá, <span class="text-capitalize-words"><?php echo htmlspecialchars(ucwords(strtolower($nome_usuario))); ?></span>!</span>
            <span class="badge bg-secondary"><?php echo ucfirst($nivel_acesso); ?></span>
        </div>
    </div>

    <!-- Cards de Resumo -->
    <div class="row g-4 mb-5">
        <div class="col-6 col-md-3">
            <div class="card shadow-custom h-100 animate__animated animate__fadeInUp border card-border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0" style="color: var(--color-text);"><?php echo $total_usuarios; ?></h3>
                            <p class="mb-0" style="color: var(--color-text-muted);"><i class="bi bi-people" style="color: var(--color-primary);"></i> Usuários</p>
                        </div>
                        <i class="bi bi-people-fill" style="font-size: 3rem; color: var(--color-primary); opacity: 0.2;"></i>
                    </div>
                </div>
                <div class="card-footer" style="background: var(--color-bg-light); border-top: 1px solid var(--color-border);">
                    <a href="admin/brinquedos.php" class="text-decoration-none" style="color: var(--color-primary);">
                        Gerenciar <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card shadow-custom h-100 animate__animated animate__fadeInUp border card-border-primary" style="animation-delay: 0.1s;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0" style="color: var(--color-text);"><?php echo $total_brinquedos; ?></h3>
                            <p class="mb-0" style="color: var(--color-text-muted);"><i class="bi bi-cube" style="color: var(--color-primary);"></i> Brinquedos</p>
                        </div>
                        <i class="bi bi-cube-fill" style="font-size: 3rem; color: var(--color-primary); opacity: 0.2;"></i>
                    </div>
                </div>
                <div class="card-footer" style="background: var(--color-bg-light); border-top: 1px solid var(--color-border);">
                    <a href="admin/brinquedos.php" class="text-decoration-none" style="color: var(--color-primary);">
                        Gerenciar <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card shadow-custom h-100 animate__animated animate__fadeInUp border card-border-accent" style="animation-delay: 0.2s;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0" style="color: var(--color-text);"><?php echo $total_categorias; ?></h3>
                            <p class="mb-0" style="color: var(--color-text-muted);"><i class="bi bi-tags" style="color: var(--color-accent);"></i> Categorias</p>
                        </div>
                        <i class="bi bi-tags-fill" style="font-size: 3rem; color: var(--color-accent); opacity: 0.2;"></i>
                    </div>
                </div>
                <div class="card-footer" style="background: var(--color-bg-light); border-top: 1px solid var(--color-border);">
                    <a href="admin/categorias.php" class="text-decoration-none" style="color: var(--color-accent);">
                        Gerenciar <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-6 col-md-3">
            <div class="card shadow-custom h-100 animate__animated animate__fadeInUp border card-border-primary" style="animation-delay: 0.3s;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0" style="color: var(--color-text);"><?php echo $total_reservas; ?></h3>
                            <p class="mb-0" style="color: var(--color-text-muted);"><i class="bi bi-calendar-check" style="color: var(--color-primary);"></i> Reservas</p>
                        </div>
                        <i class="bi bi-calendar-check-fill" style="font-size: 3rem; color: var(--color-primary); opacity: 0.2;"></i>
                    </div>
                </div>
                <div class="card-footer" style="background: var(--color-bg-light); border-top: 1px solid var(--color-border);">
                    <a href="admin/reservas.php" class="text-decoration-none" style="color: var(--color-primary);">
                        Gerenciar <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <hr class="divider">

    <!-- Menu Rápido -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card shadow-custom h-100 border">
                <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
                    <h5 class="mb-0" style="color: var(--color-text);"><i class="bi bi-cube" style="color: var(--color-primary);"></i> Brinquedos</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Gerencie o catálogo de brinquedos infláveis</p>
                    <a href="admin/brinquedos.php" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-right-circle"></i> Gerenciar Brinquedos
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-custom h-100 border">
                <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
                    <h5 class="mb-0" style="color: var(--color-text);"><i class="bi bi-tags" style="color: var(--color-primary);"></i> Categorias</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Organize os brinquedos por categorias</p>
                    <a href="admin/categorias.php" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-right-circle"></i> Gerenciar Categorias
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-custom h-100 border">
                <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
                    <h5 class="mb-0" style="color: var(--color-text);"><i class="bi bi-calendar-check" style="color: var(--color-primary);"></i> Reservas</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Visualize e gerencie as reservas</p>
                    <a href="admin/reservas.php" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-right-circle"></i> Gerenciar Reservas
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <hr class="divider">

    <!-- Lista de Usuários -->
    <div class="card shadow-custom border">
        <div class="card-header" style="background: var(--color-bg-gray); border-bottom: 1px solid var(--color-border);">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="color: var(--color-text);"><i class="bi bi-people" style="color: var(--color-primary);"></i> Usuários Cadastrados</h5>
                <a href="login/cadastrar_usuario.php" class="btn btn-sm btn-primary">
                    <i class="bi bi-person-plus"></i> Novo Usuário
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Nível</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_usuario']; ?></td>
                                    <td><strong class="text-capitalize-words"><?php echo htmlspecialchars(ucwords(strtolower($row['nome_usuario']))); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $row['nivel_acesso'] == 'admin' ? 'danger' : 'secondary'; ?>">
                                            <?php echo ucfirst($row['nivel_acesso']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Nenhum usuário encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
