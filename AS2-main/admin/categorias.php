<?php
$page_title = "Gerenciar Categorias - Inflatoy";
require_once '../bd/verifica_sessao.php';
require_once '../bd/conectaBD.php';

$mensagem = '';
$tipo_mensagem = '';

// Processar ações
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
        
        if ($acao === 'adicionar' || $acao === 'editar') {
            $nome = trim($_POST['nome'] ?? '');
            $descricao = trim($_POST['descricao'] ?? '');
            
            $conn = new mysqli($servername, $username, $password, $database);
            $conn->set_charset("utf8mb4");
            
            if ($acao === 'adicionar') {
                $sql = "INSERT INTO categorias (nome, descricao) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $nome, $descricao);
            } else {
                $id = intval($_POST['id']);
                $sql = "UPDATE categorias SET nome=?, descricao=? WHERE id_categoria=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssi", $nome, $descricao, $id);
            }
            
            if ($stmt->execute()) {
                $mensagem = $acao === 'adicionar' ? 'Categoria adicionada com sucesso!' : 'Categoria atualizada com sucesso!';
                $tipo_mensagem = 'success';
            } else {
                $mensagem = 'Erro ao salvar categoria.';
                $tipo_mensagem = 'danger';
            }
            $stmt->close();
            $conn->close();
        }
    }
}

// Processar exclusão
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Verificar se há brinquedos usando esta categoria
    $sql_check = "SELECT COUNT(*) as total FROM brinquedos WHERE id_categoria=?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();
    
    if ($row_check['total'] > 0) {
        $mensagem = 'Não é possível excluir esta categoria pois existem brinquedos vinculados a ela.';
        $tipo_mensagem = 'warning';
    } else {
        $sql = "DELETE FROM categorias WHERE id_categoria=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $mensagem = 'Categoria excluída com sucesso!';
            $tipo_mensagem = 'success';
        } else {
            $mensagem = 'Erro ao excluir categoria.';
            $tipo_mensagem = 'danger';
        }
        $stmt->close();
    }
    $stmt_check->close();
    $conn->close();
}

// Buscar categoria para edição
$categoria_editar = null;
if (isset($_GET['editar'])) {
    $id = intval($_GET['editar']);
    $conn = new mysqli($servername, $username, $password, $database);
    $conn->set_charset("utf8mb4");
    $sql = "SELECT * FROM categorias WHERE id_categoria=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $categoria_editar = $result->fetch_assoc();
    }
    $stmt->close();
    $conn->close();
}

// Listar categorias
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8mb4");
$sql = "SELECT c.*, COUNT(b.id_brinquedo) as total_brinquedos 
        FROM categorias c 
        LEFT JOIN brinquedos b ON c.id_categoria = b.id_categoria 
        GROUP BY c.id_categoria 
        ORDER BY c.nome";
$result = $conn->query($sql);
$conn->close();

require_once '../includes/header.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-tags"></i> Gerenciar Categorias</h2>
        <a href="../painel.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar ao Painel
        </a>
    </div>

    <?php if ($mensagem): ?>
        <div class="alert alert-<?php echo $tipo_mensagem; ?> alert-dismissible fade show animate__animated animate__fadeInDown">
            <?php echo $mensagem; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Formulário -->
    <div class="card shadow-custom mb-4">
        <div class="card-header" style="background: var(--color-bg); border-bottom: 2px solid var(--color-primary);">
            <h5 class="mb-0" style="color: var(--color-text);">
                <i class="bi bi-<?php echo $categoria_editar ? 'pencil' : 'plus-circle'; ?>" style="color: var(--color-primary);"></i>
                <?php echo $categoria_editar ? 'Editar' : 'Adicionar'; ?> Categoria
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <?php if ($categoria_editar): ?>
                    <input type="hidden" name="id" value="<?php echo $categoria_editar['id_categoria']; ?>">
                    <input type="hidden" name="acao" value="editar">
                <?php else: ?>
                    <input type="hidden" name="acao" value="adicionar">
                <?php endif; ?>
                
                <div class="mb-3">
                    <label class="form-label">Nome da Categoria *</label>
                    <input type="text" class="form-control" name="nome" 
                           value="<?php echo htmlspecialchars($categoria_editar['nome'] ?? ''); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3"><?php echo htmlspecialchars($categoria_editar['descricao'] ?? ''); ?></textarea>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <?php if ($categoria_editar): ?>
                        <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr class="divider">
    
    <!-- Lista de Categorias -->
    <div class="card shadow-custom">
        <div class="card-header" style="background: var(--color-bg-gray); border-bottom: 1px solid var(--color-border);">
            <h5 class="mb-0" style="color: var(--color-text);"><i class="bi bi-list-ul" style="color: var(--color-primary);"></i> Lista de Categorias</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Brinquedos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id_categoria']; ?></td>
                                    <td><strong><?php echo htmlspecialchars($row['nome']); ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['descricao'] ?? '-'); ?></td>
                                    <td>
                                        <span class="badge bg-info"><?php echo $row['total_brinquedos']; ?></span>
                                    </td>
                                    <td>
                                        <a href="?editar=<?php echo $row['id_categoria']; ?>" 
                                           class="btn btn-sm btn-warning" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="?excluir=<?php echo $row['id_categoria']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Tem certeza que deseja excluir esta categoria?');" 
                                           title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Nenhuma categoria cadastrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>

